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
    protected $upload;

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

	public function getIndex()
	{
		return View::make('forms.' . $this->iwo_key)->with('page_title', $this->page_title);
	}

	public function postIndex()
	{
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
		return Redirect::to($this->iwo_key . '/confirm')->with('file_names', $file_names['new_file_names'])->withInput(Input::except($this::$hidden_from_user));
	}

	public function getConfirm()
	{
		// Use the pretty_input() function to make form input data user friendly and pretty for display
        //But first, for display purposes, remove the 'editing' flag if it exists
        //(It will still stay in the input array for use in getSave)
		$input = Input::old();
        $input = pretty_input($input);

		// Reflash the input data for another request so it can be used in the next stage,
		// whether that be submitting the form or going back to the form to make changes
		Session::reflash();
		// Display the confirmation page
		return View::make('confirm', compact('input'))->with(['page_title' => $this->page_title . ": Confirmation", 'iwo_key' => $this->iwo_key]);
	}

	public function getSave()
	{
        //Get input array
        $input_data = $this->get_input_for_db();

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
        $ref_code = $iwo_ref->generate_ref();
        $iwo_ref->iwo_id = $workorder->id;
        $iwo_ref->iwo_ref = $ref_code;
        $iwo_ref->created_at = date("Y-m-d H:i:s");
        $iwo_ref->updated_at = date("Y-m-d H:i:s");
        $iwo_ref->save();

        //Add lead contact as a new user
        $lead_contact = new User;
        $lead_contact->name = ($this->user_names['lead']) ? Input::old($this->user_names['lead']) : 'Lead User';
        $lead_contact->iwo_id = $workorder->id;
        $lead_contact->email = Input::old('lead_email_address');
        $lead_contact->save();

        //Assign Lead role to user
        $user_lead = User::find($lead_contact->id);
        $user_lead->attachRole(Role::where('name', 'Lead')->pluck('id'));

        //If the form came through with a sub unit contact, add them as an additional user
        if(Input::old('sub_email_address'))
        {
            $sub_contact = new User;
            $sub_contact->name = ($this->user_names['sub']) ? Input::old($this->user_names['sub']) : 'Sub User';
            $sub_contact->iwo_id = $workorder->id;
            $sub_contact->email = Input::old('sub_email_address');
            $sub_contact->save();

            //Assign Sub role to user
            $user_sub = User::find($sub_contact->id);
            $user_sub->attachRole(Role::where('name', 'Sub')->pluck('id'));
        }

        /**
         * FORMAT FORM DATA FOR EMAILS
         */
        $data = [
            // Use the pretty_input() helper to make form input data user friendly and pretty for display in emails
            'form_data' => pretty_input(Input::old()),
            // Get the list of file names if they exist, for attaching
            'file_names' => Session::get('file_names'),
            //Get the "pretty" version of the IWO key
            'form_type' => $this->iwo_key_label,
            //The confirmed/unconfirmed status of the IWO
            'status' => ($workorder->confirmed == 0) ? 'unconfirmed' : 'confirmed',
            //IWO reference
            'iwo_ref' => $iwo_ref->iwo_ref,
            //IWO key
            'iwo_key' => $this->iwo_key,
        ];

        /**
         * QUEUE SENDING OF EMAILS USING SendEmail WORKER
         * AND QUEUE DELETION OF UPLOADED ATTACHMENTS
         */

        $emailer = App::make('Mailer');

        //Send Lead Unit an email
        $data['recipient'] = $lead_contact->email;
        //$emailer->sendTo($data['recipient'], $data['subject'], "emails." . $data['iwo_key'] . ".lead", $data);
        Queue::push('\Iwo\Workers\SendEmail@iwo_created_lead', $data);



        //Send Sub Unit an email if they exist
        if(isset($sub_contact->email))
        {
            $data['recipient'] = $sub_contact->email;
            //$emailer->sendTo($data['recipient'], $data['subject'], "emails." . $data['iwo_key'] . ".sub", $data, $data['file_names']);
            Queue::push('\Iwo\Workers\SendEmail@iwo_created_sub', $data);
        }


        //If this type of IWO is set to 'confirmed' by default, send an
        //email to the copy contacts for this form type
        if($workorder->confirmed > 0)
        {
            $data['recipient'] = $this->get_copy_emails($workorder->formtype_id);
            //$emailer->sendTo($data['recipient'], $data['subject'], "emails." . $data['iwo_key'] . ".auto_confirm", $data, $data['file_names']);
            Queue::push('\Iwo\Workers\SendEmail@iwo_auto_confirmed', $data);
        }

        // Redirect to the complete/success page
        return Redirect::route('complete')->with('iwo_ref', $iwo_ref->iwo_ref);

        // Once emails are sent, delete files uploaded for security.
        //Queue::push('\Iwo\Workers\DeleteUploads', $data['file_names']);

    }

	public function missingMethod($parameters = [])
	{
		return Redirect::route('home');
	}

    //Process form input for insertion into the DB
    protected function get_input_for_db()
    {
        //Get input array
        $input_data = Input::old();
        //Remove the workorder title and reference from the pretty version
        //of the input array (these will be saved separately if adding, not required if updating)
        unset($input_data['workorder_title']);
        unset($input_data['workorder_reference']);
        //Also remove the token and person_count fields
        unset($input_data['_token']);
        unset($input_data['person_count']);
        //Convert the work order to a serialised array
        $input_data = serialize($input_data);

        return $input_data;
    }

    protected function get_user_emails($iwo_id = 0)
    {
        return User::where('iwo_id', '=', $iwo_id)->lists('email');
    }
    protected function get_copy_emails($formtype = 0)
    {
        return Copy_contact::where('formtype_id', '=', $formtype)->lists('email');
    }

}