<?php

use Iwo\Mailer\Mailer;
use Iwo\FileUpload\FileUpload;
use Iwo\Workers\Generate;
use Iwo\Workers\SendEmail;

class BaseController extends Controller {

	// Copy email contacts retreived from the database
	protected $email_recipients;
	// Path to the email view to use if different from 'emails.<iwo_key>'
	protected $email_view;
    // Page title used on the front-end
    protected $page_title;
    // Instance of FileUpload
    public function __construct()
    {
        if(isset($this->iwo_key_label))
        {
            // Get the default page title from the DB
            $this->page_title = $this->iwo_key_label . " Internal Work Order";
        }
        if(isset($this->iwo_key))
        {
            // Get the list of email recipients for this particular form from the DB
            $this->email_recipients = Formtype::where('key', $this->iwo_key)->first()->emailrecipients;
        }
    }

    protected $upload;

	public function getIndex()
	{
		return View::make('forms.' . $this->iwo_key)->with('page_title', $this->page_title);
	}

	public function postIndex()
	{
        //dd(Input::all());
		// Use $this->validator set in the sub class to use the validation rules
		// specific to this form
		$this->validator->validate(Input::all());
		// If fails, throws a FormValidationException and redirects back to the form
		// If passes, move on to dealing with any files uploaded
		
		// Resolve the FileUpload class out of the IoC container
		$this->upload = App::make('FileUpload');
		// upload_files method returns an array of the original file names and
		// the new file names after any space removal has taken place
		$file_names = $this->upload->upload_files(Input::file('file'));
		// If there is a problem, upload_files throws a FormFileUploadException.
		// Otherwise redirect to the confirm page with the file names
		return Redirect::to($this->iwo_key . '/confirm')->with('file_names', $file_names['new_file_names'])->withInput(Input::except($this->hidden_from_user));
	}

	public function getConfirm()
	{
		// Use the pretty_input() function to make form input data user friendly and pretty for display
		$input = pretty_input(Input::old());

		// Reflash the input data for another request so it can be used in the next stage,
		// whether that be submitting the form or going back to the form to make changes
		Session::reflash();
		// Display the confirmation page
		return View::make('confirm', compact('input'))->with(['page_title' => $this->page_title . ": Confirmation", 'iwo_key' => $this->iwo_key]);
	}

	public function getSave()
	{
        /**
         * SET UP EMAIL ADDRESSES
         */
        // $data will hold all data to be sent to the SendEmail worker used to queue sending of the emails
        $data = [];

		// Get the lead email address entered on the form
		$data['lead_email'] = Input::old('lead_email_address');
        // If sub email was entered, include that in the $data array, otherwise set as empty string
        $data['sub_email'] = (Input::old('sub_email_address')) ? Input::old('sub_email_address') : "";
		// Get all copy email recipients for this form type
		//$recipients = Formtype::where('key', $this->iwo_key)->first()->copy_contacts;
		// If they exist, extract copy email addresses and place in array
        //$data['copies_email'] = ($recipients->first()) ? email_addresses_to_array($recipients) : $data['copies_email'] = [];

        /**
         * SET UP EMAIL VIEWS AND DATA
         */
        // If an email view was set in the sub class for the lead unit email, use that. Otherwise use the default email view
        $data['view_lead'] = (isset($this->email_views['lead-unit'])) ? 'emails.' . $this->email_views['lead-unit'] : 'emails.default';
        // If an email view was set in the sub class for the sub unit email, use that. Otherwise use the default email view
        $data['view_sub'] = (isset($this->email_views['sub-unit'])) ? 'emails.' . $this->email_views['sub-unit'] : 'emails.default';
        // If an email view was set in the sub class for other emails (i.e. default), use that. Otherwise use the default email view
        //$data['view_copies'] = (isset($this->email_views['copies'])) ? 'emails.' . $this->email_views['copies'] : 'emails.default';
		// If an email subject was set in the sub class, use that. Otherwise use the page title
		$data['subject'] = (isset($this->email_subject)) ? $this->email_subject : $this->page_title;

        /**
         * FORMAT FORM DATA FOR EMAILS
         */
        // Use the pretty_input() helper to make form input data user friendly and pretty for display in emails
        $data['form_data'] = pretty_input(Input::old());
		// Get the list of file names if they exist, for attaching
		$data['file_names'] = Session::get('file_names');
		// Extra content for use in the email views
		$data['formtype'] = $this->iwo_key_label;

        //Get input array
        $input_data = Input::old();
        //Remove the workorder title and reference
        //(these will be saved separately)
        unset($input_data['workorder_title']);
        unset($input_data['workorder_reference']);
        //Convert the work order to a serialised array
        $input_data = serialize($input_data);

        //Insert work order in the DB
        $workorder = new Workorder;
        $workorder->workorder = $input_data;
        $workorder->title = trim(Input::old('workorder_title'));
        $workorder->confirmed = ($this->confirmed) ? $this->confirmed : 0;
        $workorder->formtype_id = Formtype::where('key', $this->iwo_key)->pluck('id');
        $workorder->created_at = date("Y-m-d H:i:s");
        $workorder->updated_at = date("Y-m-d H:i:s");
        $workorder->save();

        //Insert work order reference in the DB
        $iwo_ref = new Iwo_ref;
        $ref_code = (trim(Input::old('workorder_reference'))) ? trim(Input::old('workorder_reference')) : $iwo_ref->generate_ref();
        $iwo_ref->iwo_id = $workorder->id;
        $iwo_ref->iwo_ref = $ref_code;
        $iwo_ref->created_at = date("Y-m-d H:i:s");
        $iwo_ref->updated_at = date("Y-m-d H:i:s");
        $iwo_ref->save();

        //Insert contact email addresses in the DB
        $lead_contact = new User;
        $lead_contact->name = ($this->user_names['lead']) ? Input::old($this->user_names['lead']) : 'Lead User';
        $lead_contact->iwo_id = $workorder->id;
        $lead_contact->email = $data['lead_email'];
        $lead_contact->save();

        if($data['sub_email'])
        {
            $sub_contact = new User;
            $sub_contact->name = ($this->user_names['sub']) ? Input::old($this->user_names['sub']) : 'Sub User';
            $sub_contact->iwo_id = $workorder->id;
            $sub_contact->email = $data['sub_email'];
            $sub_contact->save();
        }

        //Assign roles to users
        $user_lead = User::find($lead_contact->id);
        $user_lead->attachRole(Role::where('name', 'Lead')->pluck('id'));

        if($data['sub_email'])
        {
            $user_sub = User::find($sub_contact->id);
            $user_sub->attachRole(Role::where('name', 'Sub')->pluck('id'));
        }

        //Add the reference code to the $data array for use in emails
        $data['iwo_ref'] = $ref_code;

        /**
         * QUEUE SENDING OF EMAILS USING SendEmail WORKER
         * AND QUEUE DELETION OF UPLOADED ATTACHMENTS
         */
        Queue::push('\Iwo\Workers\SendEmail@SendToLead', $data);
        if($data['sub_email']) { Queue::push('\Iwo\Workers\SendEmail@SendToSub', $data); }
        //Queue::push('\Iwo\Workers\SendEmail@SendCopies', $data);

        // Once emails are sent, delete files uploaded for security.
        Queue::push('\Iwo\Workers\DeleteUploads', $data['file_names']);

        // Redirect to the complete/success page
        return Redirect::route('complete')->with('iwo_ref', $ref_code);
    }

	public function missingMethod($parameters = [])
	{
		return Redirect::route('home');
	}

}