<?php


use Illuminate\Support\Facades\Redirect;
use Iwo\Exceptions\ManagementLoginException;

class ManagementController extends BaseController
{
    protected $page_title;
    protected $workorder;
    protected $user;
    protected $iwo_key;
    protected $validator;
    protected $upload;
    protected $no_perms_message = 'Sorry, you do not have the necessary permissions to do that.';

    public function __construct()
    {
        parent::__construct();

        if(Session::get('iwo_id'))
        {
            $this->workorder = Workorder::find(Session::get('iwo_id'));
            //Get logs ordered latest to oldest
            $this->workorder->logs = Workorder::find(Session::get('iwo_id'))->logs()->orderBy('created_at', 'DESC')->get();
            $this->workorder->notes = Workorder::find(Session::get('iwo_id'))->notes()->orderBy('created_at', 'DESC')->get();
            $this->workorder->iwo_ref = Session::get('iwo_ref');
            $this->workorder->pretty_workorder = pretty_input(unserialize($this->workorder->workorder));
            $this->workorder->workorder = (object) unserialize($this->workorder->workorder);
            //Get the iwo key (edt, unit, etc.)
            $this->workorder->iwo_key = Formtype::where('id', '=', $this->workorder->formtype_id)->pluck('key');

            //Email variables
            $data = [
              'iwo_title' => $this->workorder->title,
              'iwo_ref' => $this->workorder->id,
            ];

        }

        $this->user = Auth::user();

        //Set default page title
        $this->page_title = "IWO Management";
    }

	/**
	 * Displays login screen if not already logged in.
	 *
	 * @return \Illuminate\View\View
	 */
	public function getIndex()
    {
        if(Session::get('iwo_id'))
        {
            return Redirect::to('manage/view');
        }

        return View::make('manage.login')->with('page_title', $this->page_title);
    }

	/**
	 * Checks for correct login details and logs in if user found.
	 *
	 * @throws ManagementLoginException
	 */
	public function postIndex()
    {
        $email = Input::get('email');
        //Find the core reference, stripping off any letters from the end
        $user_iwo_ref = get_original_ref(Input::get('iwo_ref'));
        //Get IWO id
        $iwo_id = Iwo_ref::where('iwo_ref', 'LIKE', $user_iwo_ref . '%')->pluck('iwo_id');
	    //Get the current IWO reference code
	    $iwo_ref = Iwo_ref::where('iwo_id', '=', $iwo_id)->pluck('iwo_ref');
        //Check to see if user exists
        if($user = User::where('email', '=', $email)->where('iwo_id', '=', $iwo_id)->first())
        {
            //If user found, log the user in, add some useful session variables
            //and redirect to view IWO
            User::login_user($user->id, $iwo_id, $iwo_ref);

            return Redirect::to('manage/view');
        }
	    else
        {
            //    If no user found, throw an exception and redirect back with errors
            throw new ManagementLoginException('Login failed', 'Incorrect login details entered. Please try again.');
        }
    }

	/**
	 * Displays current IWO data with event log and actions available to the current user.
	 *
	 * @return \Illuminate\View\View
	 */
	public function getView()
    {
        if( ! $this->check_permission('read')) { return Redirect::to('manage/view')->withErrors($this->no_perms_message); }

        return View::make('manage.view_iwo')->with(['page_title' => $this->page_title, 'workorder' => $this->workorder, 'user' => $this->user]);
    }

	/**
	 * Add a note to the current IWO.
	 *
	 * @return \Illuminate\View\View
	 */
	public function getNote()
    {
        $this->check_permission('comment');

        return View::make('manage.add_note')->with(['page_title' => $this->page_title, 'workorder' => $this->workorder, 'user' => Auth::user()]);
    }

	/**
	 * Process note entry form data.
	 *
	 * @return mixed
	 */
	public function postNote()
    {
        if( ! $this->check_permission('comment')) { return Redirect::to('manage/view')->withErrors($this->no_perms_message); }

	    $note = trim(htmlspecialchars(Input::get('note')));

        if($note != "")
        {
            Note::add_note($note);
            Logger::add_log('New note added.');

            //Send a notification email to lead and sub units
            //Include copy contacts if the work order is confirmed
	        $data['iwo_ref'] = $this->workorder->iwo_ref;
	        $data['iwo_title'] = $this->workorder->title;
	        //Get all email addresses linked to this work order along with copy contacts so we can email them about the update
	        $data['recipient'] = $this->get_all_emails($this->workorder->id, $this->workorder->formtype_id);
	        $data['note'] = $note;
	        $data['user_name'] = $this->user->name;
            Queue::push('\Iwo\Workers\SendEmail@iwo_note_added', $data);

            return Redirect::to('manage/view')->with('message', 'Note added.');
        }
        else
        {
            return Redirect::to('manage/view')->with('message', 'Blank note not added.');
        }

    }

	/**
	 * Display correct IWO form for editing of current IWO.
	 *
	 * @return \Illuminate\View\View
	 */
	public function getEdit()
    {
        if( ! $this->check_permission('edit')) { return Redirect::to('manage/view')->withErrors($this->no_perms_message); }

        return View::make('forms.' . $this->workorder->iwo_key)->with(['page_title' => 'Editing "' . $this->workorder->title . '"', 'workorder' => $this->workorder, 'iwo_key' => $this->workorder->iwo_key]);
    }

	/**
	 * Display confirmation screen for edits made to current IWO.
	 *
	 * @return \Illuminate\View\View
	 */
	public function postConfirmupdates()
    {
        if( ! $this->check_permission('edit')) { return Redirect::to('manage/view')->withErrors($this->no_perms_message); }

        $validator_name = ucfirst($this->workorder->iwo_key) . "WorkOrderValidator";
        $controller_name = ucfirst($this->workorder->iwo_key) . "WorkOrderController";
        $this->validator = App::make('\\Iwo\\Validation\\' . $validator_name);

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
        Session::set('file_names', $file_names['new_file_names']);

        // If there is a problem, upload_files throws a FormFileUploadException.
        // Otherwise redirect to the confirm page with the file names

        // Use the pretty_input() function to make form input data user friendly and pretty for display
        //But first, for display purposes, remove the 'editing' flag if it exists
        //(It will still stay in the input array for use in getSave)
        $input = Input::except($controller_name::$hidden_from_user);
        $input = pretty_input($input);

        // Reflash the input data for another request so it can be used in the next stage,
        // whether that be submitting the form or going back to the form to make changes
        Input::flash();
        // Display the confirmation page
        return View::make('confirm', compact('input'))->with(['page_title' => '"' . $this->workorder->title . '": Update and Re-submit', 'iwo_key' => $this->workorder->iwo_key]);

    }

	/**
	 * Process edits made to current IWO.
	 *
	 * @return mixed
	 */
	public function getUpdate()
    {
        if( ! $this->check_permission('edit')) { return Redirect::to('manage/view')->withErrors($this->no_perms_message); }

        //If a token exists, input has been passed through and it is safe to process the update
        if(Input::old('_token'))
        {
            //Find the workorder to be updated in the DB
            $updated_workorder = $this->get_input_for_db();
            //If the workorder is exactly the same as the entry in the DB, redirect to the view page
            //with a message, as no updates have been made
            if($updated_workorder == $this->workorder->workorder)
            {
                return Redirect::to('manage/view')->with('message', 'No updates made.');
            }
            //Otherwise, carry on wih the update
	        $new_workorder = Workorder::find(Session::get('iwo_id'));
            $new_workorder->workorder = $this->get_input_for_db();
            $new_workorder->updated_at = date_time_now();
            $new_workorder->expiry_date = Input::old('internal_work_order_expiry_date') ? date("Y-m-d", strtotime(Input::old('internal_work_order_expiry_date'))) : '2999-01-01';

	        if($new_workorder->confirmed == 1)
	        {
		        $new_workorder->confirmed = 0;
		        //Add an event log entry for this update
		        Logger::add_log('Work order unconfirmed.');
	        }

            $new_workorder->save();

            $iwo_ref = Iwo_ref::where('iwo_id', '=', Session::get('iwo_id'))->first();
            $iwo_ref->iwo_ref = update_iwo_ref(Session::get('iwo_ref'));
            $iwo_ref->save();

            //Update the iwo_ref in the session, as it has changed above
            Session::set('iwo_ref', $iwo_ref->iwo_ref);

            //Add an event log entry for this update
            Logger::add_log('Work order updated.', 'update');

	        /**
	         * FORMAT FORM DATA FOR EMAILS
	         */
	        $data = [
		        // Use the pretty_input() helper to make form input data user friendly and pretty for display in emails
		        'form_data' => pretty_input(unserialize($new_workorder->workorder)),
		        //Get the "pretty" version of the IWO key
		        'form_type' => Formtype::where('id', '=', $new_workorder->formtype_id)->pluck('label'),
		        //The confirmed/unconfirmed status of the IWO
		        'status' => ($new_workorder->confirmed == 0) ? 'unconfirmed' : 'confirmed',
		        //IWO reference
		        'iwo_ref' => Session::get('iwo_ref'),
		        //IWO key
		        'iwo_key' => Formtype::where('id', '=', $new_workorder->formtype_id)->pluck('key'),
		        //    Workorder title
		        'iwo_title' => $new_workorder->title,
		        //    Workorder id
		        'iwo_id' => $new_workorder->id,
		        //    Confirmation code
		        'confirmation_code' => Confirmation_code::where('iwo_id', '=', $new_workorder->id)->pluck('code'),
	        ];

	        //Get the old reference code
	        $data['old_ref'] = get_original_ref(Session::get('iwo_ref'));

	        //Get all email addresses linked to this work order
	        $users = $this->get_associated_users(true);

	        //Send an email to all users linked to this IWO with customised content to their role
	        foreach($users as $user)
	        {
		        $data['recipient'] = $user->email;

		        if($user->hasRole('Lead'))
		        {
			        //Send Lead Unit an email
			        Queue::push('\Iwo\Workers\SendEmail@iwo_updated_lead', $data);
		        }
		        elseif($user->hasRole('Sub'))
		        {
			        //Send Sub Unit an email
			        Queue::push('\Iwo\Workers\SendEmail@iwo_updated_sub', $data);
		        }
		        else
		        {
			        //recipient must be in an array, due to the way the iwo_updated_copy method works
			        $data['recipient'] = [$user->email];
			        //Send user-entered copy contact an email
			        Queue::push('\Iwo\Workers\SendEmail@iwo_updated_copy', $data);
		        }
	        }

	        //Get all copy contacts for this form type and send them an email about the update
	        $data['recipient'] = $this->get_copy_emails($new_workorder->formtype_id);
	        Queue::push('\Iwo\Workers\SendEmail@iwo_updated_copy', $data);

            return Redirect::to('manage/updatecomplete');
        }
    else
        {
            //If token doesn't exist, no input received. Redirect to the view page with an error message
            return Redirect::to('manage/view')->with('message', 'Error: you cannot access that page.');
        }
    }

	/**
	 * Display 'update complete' page once edits have been saved for the current IWO.
	 *
	 * @return \Illuminate\View\View
	 */
	public function getUpdatecomplete()
    {
        if( ! $this->check_permission('edit')) { return Redirect::to('manage/view')->withErrors($this->no_perms_message); }

        return View::make('manage.update_complete')->with('page_title', 'Work Order Re-submitted');
    }

	/**
	 * Confirm the current IWO.
	 *
	 * @return mixed
	 */
	public function getConfirm()
    {
        if( ! $this->check_permission('confirm')) { return Redirect::to('manage/view')->withErrors($this->no_perms_message); }

	    $new_workorder = Workorder::find(Session::get('iwo_id'));
        $new_workorder->confirmed = 1;
        $new_workorder->updated_at = date_time_now();
        $new_workorder->save();

	    /**
	     * FORMAT FORM DATA FOR EMAILS
	     */
	    $data = [
		    'form_data' => $this->workorder->pretty_workorder,
		    //IWO reference
		    'iwo_ref' => Session::get('iwo_ref'),
		    //    Workorder title
		    'iwo_title' => $this->workorder->title,
		    //    Workorder id
		    'iwo_id' => $this->workorder->id
	    ];

        //Send an email to lead and sub units plus copy contacts now the work order is confirmed
        $data['recipient'] = $this->get_all_emails($this->workorder->id, $this->workorder->formtype_id);
        Queue::push('\Iwo\Workers\SendEmail@iwo_confirmed', $data);

        Logger::add_log('Work order confirmed.', 'success');

        return Redirect::to('manage/view')->with('message', 'Work order confirmed.');
    }

	/**
	 * Unconfirm the current IWO.
	 *
	 * @return mixed
	 */
	public function getUnconfirm()
    {
        //Return false temporarily until this feature is available
        return false;
        if( ! $this->check_permission('confirm')) { return Redirect::to('manage/view')->withErrors($this->no_perms_message); }

        $this->workorder = Workorder::find(Session::get('iwo_id'));
        $this->workorder->confirmed = 0;
        $this->workorder->updated_at = date_time_now();
        $this->workorder->save();

	    $data['iwo_ref'] = $this->workorder->iwo_ref;
	    $data['iwo_title'] = $this->workorder->title;
        //Send an email to lead and sub units plus copy contacts now the work order is un-confirmed
        $data['recipient'] = $this->get_all_emails($workorder->id, $workorder->formtype_id);
        Queue::push('\Iwo\Workers\SendEmail@iwo_unconfirmed', $data);

        Logger::add_log('Work order un-confirmed.', 'warning');

        return Redirect::to('manage/view')->with('message', 'Work order un-confirmed.');
    }

	/**
	 * Cancel the current IWO.
	 *
	 * @return mixed
	 */
	public function getCancel()
    {
        if( ! $this->check_permission('cancel')) { return Redirect::to('manage/view')->withErrors($this->no_perms_message); }

        $new_workorder = Workorder::find(Session::get('iwo_id'));
        $new_workorder->cancelled = 1;
        $new_workorder->updated_at = date_time_now();
        $new_workorder->save();

	    $data['iwo_ref'] = $this->workorder->iwo_ref;
	    $data['iwo_title'] = $this->workorder->title;
	    //Send an email to lead and sub units plus copy contacts now the work order is confirmed
	    $data['recipient'] = $this->get_all_emails($new_workorder->id, $new_workorder->formtype_id);
        Queue::push('\Iwo\Workers\SendEmail@iwo_cancelled', $data);

        Logger::add_log('Work order cancelled.', 'alert');

        return Redirect::to('manage/view')->with('message', 'Work order cancelled.');
    }

	/**
	 * Display form for re-sending emails to users associated with the current IWO.
	 *
	 * @return \Illuminate\View\View
	 */
	public function getResend()
	{
		if( ! $this->check_permission('edit')) { return Redirect::to('manage/view')->withErrors($this->no_perms_message); }
		//Get all users for the current IWO.
		$users = $this->get_associated_users();
		//Pass users through and display the view.
		return View::make('manage.resend')->with(['page_title' => $this->page_title, 'users' => $users]);
	}

	/**
	 * Process email re-send form.
	 *
	 * @return mixed
	 */
	public function postResend()
	{
		//Array of user ids passed in?
		if(Input::has('users'))
		{
			/**
			 * FORMAT FORM DATA FOR EMAILS
			 */
			$data = [
				// Use the pretty_input() helper to make form input data user friendly and pretty for display in emails
				'form_data' => $this->workorder->pretty_workorder,
				//Get the "pretty" version of the IWO key
				'form_type' => Formtype::where('id', '=', $this->workorder->formtype_id)->pluck('label'),
				//The confirmed/unconfirmed status of the IWO
				'status' => ($this->workorder->confirmed == 0) ? 'unconfirmed' : 'confirmed',
				//IWO reference
				'iwo_ref' => Session::get('iwo_ref'),
				//IWO key
				'iwo_key' => $this->workorder->iwo_key,
				//    Workorder title
				'iwo_title' => $this->workorder->title,
				//    Workorder id
				'iwo_id' => $this->workorder->id,
				//    Confirmation code
				'confirmation_code' => Confirmation_code::where('iwo_id', '=', $this->workorder->id)->pluck('code'),
				//This is a re-send of a previous email, so make the re-send message appear in the emails sent out
				'resend' => true
			];

			$collected_emails = [];
			foreach(Input::get('users') as $user_id)
			{
				$user = User::find($user_id);
				$collected_emails[] = $user->email;
				$data['recipient'] = $user->email;

				if($user->hasRole('Lead'))
				{
					//Send Lead Unit an email
					Queue::push('\Iwo\Workers\SendEmail@iwo_created_lead', $data);
				}

				if($user->hasRole('Sub'))
				{
					//Send Sub Unit an email
					Queue::push('\Iwo\Workers\SendEmail@iwo_created_sub', $data);
				}

				if($user->hasRole('Viewer'))
				{
					//recipient must be in an array, due to the way the iwo_created_copy method works
					$data['recipient'] = [$user->email];
					//Send user-entered copy contact an email
					Queue::push('\Iwo\Workers\SendEmail@iwo_created_copy', $data);
				}
			}

			$message = 'Email(s) re-sent to ' . $this->format_email_list($collected_emails) . '.';
			Logger::add_log($message);

			return Redirect::to('manage/view')->with('message', $message);
		}
		else
		{
			return Redirect::to('manage/view')->withErrors('No users selected.');
		}

	}

	/**
	 * Log user out of management section.
	 *
	 * @return mixed
	 */
	public function getLogout()
    {
        Auth::logout();
        Session::flush();

        return Redirect::to('/')->with('message', 'You have been logged out.');
    }

	/**
	 * Check if a user has a necessary permission to continue with an action.
	 *
	 * @param $permission
	 *
	 * @return bool
	 */
	private function check_permission($permission)
    {
        if( ! $this->user->can($permission))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

	/**
	 * Get all users associated with the current IWO.
	 *
	 * @return array
	 */
	private function get_associated_users($return_users = false)
	{
		$users = User::where('iwo_id', '=', Session::get('iwo_id'))->orderBy('id')->get();

		if($return_users) return $users;

		$data = [];
		$i = 0;
		foreach($users as $user)
		{
			$data[$i]['id'] = $user->id;
			//If the user name equals the user's email address, this is a copy recipient entered by the user
			//when the IWO was submitted (other recipients are named)
			$data[$i]['name'] = ($user->name == $user->email) ? 'User-entered copy recipient' : $user->name;
			$data[$i]['email'] = $user->email;
			$data[$i]['roles'] = '';
			foreach($user->roles as $role)
			{
				$data[$i]['roles'] .= $role->name . ', ';
			}
			$data[$i]['roles'] = substr($data[$i]['roles'], 0, -2);
			$i++;
		}

		return $data;
	}

	/**
	 * Create a nicely worded and formatted list of email addresses.
	 *
	 * @param array $emails
	 *
	 * @return string
	 */
	private function format_email_list($emails = [])
	{
		//If only one email address was passed through, no further manipulation is needed
		//so just return the email address.
		if(count($emails) == 1)
		{
			return '<strong>' . $emails[0] . '</strong>';
		}

		//Otherwise, loop through $emails array and add to $formatted_emails with a comma
		//Except for the final email, so this can be added after ' and '.
		$formatted_emails = '';
		for($i = 0; $i < (count($emails) - 1); $i++)
		{
			$formatted_emails .= '<strong>' . $emails[$i] . '</strong>, ';
		}

		//Remove the final comma and space
		$formatted_emails = substr($formatted_emails, 0, -2);
		//Add the final email address after ' and '.
		$formatted_emails .= ' and <strong>' . $emails[$i] . '</strong>';

		return $formatted_emails;
	}
}