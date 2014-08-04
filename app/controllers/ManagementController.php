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
            $this->iwo_key = Formtype::where('id', '=', $this->workorder->formtype_id)->pluck('key');

        }

        $this->user = Auth::user();

        //Set default page title
        $this->page_title = "IWO Management";
    }

    public function getIndex()
    {
        if(Session::get('iwo_id'))
        {
            return Redirect::to('manage/view');
        }

        return View::make('manage.login')->with('page_title', $this->page_title);
    }

    public function postIndex()
    {
    //    Attempt to find user in DB
        $email = Input::get('email');
        $iwo_ref = Input::get('iwo_ref');
        //Get IWO id
        $iwo_id = Iwo_ref::where('iwo_ref', $iwo_ref)->pluck('iwo_id');
        //Check to see if user exists
        if($user = User::where('email', '=', $email)->where('iwo_id', '=', $iwo_id)->first())
        {
            //    If user found, log the user in, add some useful session variables
            //and redirect to view IWO
            Auth::loginUsingId($user->id);
            Session::set('user_id', $user->id);
            Session::set('iwo_id', $iwo_id);
            Session::set('iwo_ref', $iwo_ref);

            return Redirect::to('manage/view');
        }
        else
        {
            //    If no user found, throw an exception and redirect back with errors
            throw new ManagementLoginException('Login failed', 'Incorrect login details entered. Please try again.');
        }
    }

    public function getView()
    {
        $this->check_permission('read');

        return View::make('manage.view_iwo')->with(['page_title' => $this->page_title, 'workorder' => $this->workorder, 'user' => $this->user]);
    }

    //Add a note to the current IWO
    public function getNote()
    {
        $this->check_permission('comment');

        return View::make('manage.add_note')->with(['page_title' => $this->page_title, 'workorder' => $this->workorder, 'user' => Auth::user()]);
    }

    public function postNote()
    {
        $this->check_permission('comment');

        if(trim(Input::get('note')) != "")
        {
            Note::add_note(trim(Input::get('note')));
            Logger::add_log('New note added.');

            //Send a notification email to lead and sub units
            //Include copy contacts if the work order is confirmed
            $iwo_id = Session::get('iwo_id');
            $workorder = Workorder::find($iwo_id)->first();
            $data['iwo_ref'] = Session::get('iwo_ref');
            $data['note'] = trim(Input::get('note'));
            $data['recipient'] = $this->get_user_emails($iwo_id);
            if($workorder->confirmed > 0)
            {
                $data['recipient'] = array_merge($data['recipient'], $this->get_copy_emails($workorder->formtype_id));
            }
            Queue::push('\Iwo\Workers\SendEmail@iwo_note_added', $data);

            return Redirect::to('manage/view')->with('message', 'Note added.');
        }
        else
        {
            return Redirect::to('manage/view')->with('message', 'Blank note not added.');
        }

    }

    public function getEdit()
    {
        $this->check_permission('edit');

        return View::make('forms.' . $this->iwo_key)->with(['page_title' => 'Editing "' . $this->workorder->title . '"', 'workorder' => $this->workorder, 'iwo_key' => $this->iwo_key]);
    }

    public function postConfirmupdates()
    {
        $this->check_permission('edit');

        $validator_name = ucfirst($this->iwo_key) . "WorkOrderValidator";
        $controller_name = ucfirst($this->iwo_key) . "WorkOrderController";
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
        return View::make('confirm', compact('input'))->with(['page_title' => '"' . $this->workorder->title . '": Update and Re-submit', 'iwo_key' => $this->iwo_key]);

    }

    public function getUpdate()
    {
        $this->check_permission('edit');

        //If a token exists, input has been passed through and it is safe to process the update
        if(Input::old('_token'))
        {
            //Find the workorder to be updated in the DB
            $workorder = Workorder::find(Session::get('iwo_id'));
            $updated_workorder = $this->get_input_for_db();
            //If the workorder is exactly the same as the entry in the DB, redirect to the view page
            //with a message, as no updates have been made
            if($updated_workorder == $workorder->workorder)
            {
                return Redirect::to('manage/view')->with('message', 'No updates made.');
            }
            //Otherwise, carry on wih the update
            $workorder->workorder = $this->get_input_for_db();
            $workorder->updated_at = date_time_now();
            $workorder->save();

            //Add an event log entry for this update
            Logger::add_log('Work order updated.', 'update');
            //Get all users linked to this work order so we can email them about the update
            $users = User::where('iwo_id', '=', Session::get('iwo_id'))->get(['email', 'name']);
            foreach($users as $user)
            {
                //Send an email to lead and sub units plus copy contacts now the work order is confirmed
                $data['iwo_ref'] = Session::get('iwo_ref');
                $data['recipient'] = $this->get_user_emails($workorder->id);
                Queue::push('\Iwo\Workers\SendEmail@iwo_updated', $data);
            }

            return Redirect::to('manage/updatecomplete');
        }
    else
        {
            //If token doesn't exist, no input received. Redirect to the view page with an error message
            return Redirect::to('manage/view')->with('message', 'Error: you cannot access that page.');
        }
    }

    public function getUpdatecomplete()
    {
        $this->check_permission('edit');

        return View::make('manage.update_complete')->with('page_title', 'Work Order Re-submitted');
    }

    public function getLogout()
    {
        Auth::logout();
        Session::flush();

        return Redirect::to('manage')->with('message', 'You have been logged out.');
    }

    public function getConfirm()
    {
        $this->check_permission('confirm');

        $workorder = Workorder::find(Session::get('iwo_id'));
        $workorder->confirmed = 1;
        $workorder->updated_at = date_time_now();
        $workorder->save();

        //Send an email to lead and sub units plus copy contacts now the work order is confirmed
        $data['iwo_ref'] = Session::get('iwo_ref');
        $data['recipient'] = array_merge($this->get_user_emails($workorder->id), $this->get_copy_emails($workorder->formtype_id));
        Queue::push('\Iwo\Workers\SendEmail@iwo_confirmed', $data);

        Logger::add_log('Work order confirmed.', 'success');

        return Redirect::to('manage/view')->with('message', 'Work order confirmed.');
    }

    public function getUnconfirm()
    {
        //Return false temporarily until this feature is available
        return false;
        $this->check_permission('confirm');

        $workorder = Workorder::find(Session::get('iwo_id'));
        $workorder->confirmed = 0;
        $workorder->updated_at = date_time_now();
        $workorder->save();

        //Send an email to lead and sub units plus copy contacts now the work order is un-confirmed
        $data['iwo_ref'] = Session::get('iwo_ref');
        $data['recipient'] = array_merge($this->get_user_emails($workorder->id), $this->get_copy_emails($workorder->formtype_id));
        Queue::push('\Iwo\Workers\SendEmail@iwo_unconfirmed', $data);

        Logger::add_log('Work order un-confirmed.', 'warning');

        return Redirect::to('manage/view')->with('message', 'Work order un-confirmed.');
    }

    public function getCancel()
    {
        $this->check_permission('cancel');

        $workorder = Workorder::find(Session::get('iwo_id'));
        $workorder->cancelled = 1;
        $workorder->updated_at = date_time_now();
        $workorder->save();

        //Send an email to lead and sub units plus copy contacts now the work order is un-confirmed
        $data['iwo_ref'] = Session::get('iwo_ref');
        $data['recipient'] = array_merge($this->get_user_emails($workorder->id), $this->get_copy_emails($workorder->formtype_id));
        Queue::push('\Iwo\Workers\SendEmail@iwo_cancelled', $data);

        Logger::add_log('Work order cancelled.', 'alert');

        return Redirect::to('manage/view')->with('message', 'Work order cancelled.');
    }

    private function check_permission($permission)
    {
        if( ! $this->user->can($permission))
        {
            return Redirect::to('manage')->with('message', 'Sorry, you do not have the necessary permissions to do that.');
        }
        else
        {
            return true;
        }
    }
}