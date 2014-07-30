<?php


use Illuminate\Support\Facades\Redirect;
use Iwo\Exceptions\ManagementLoginException;

class ManagementController extends BaseController
{
    protected $page_title;
    protected $workorder;

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
            $this->workorder->workorder = pretty_input(unserialize($this->workorder->workorder));
        }

        //Set default page title
        $this->page_title = "IWO Management";
    }

    public function getIndex()
    {
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
            //    If user found, log the user in and redirect to view IWO
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
        return View::make('manage.view_iwo')->with(['page_title' => $this->page_title, 'workorder' => $this->workorder, 'user' => Auth::user()]);
    }

    //Add a note to the current IWO
    public function getNote()
    {
        return View::make('manage.add_note')->with(['page_title' => $this->page_title, 'workorder' => $this->workorder, 'user' => Auth::user()]);
    }

    public function postNote()
    {
        if(Input::get('note') != "")
        {
            Note::add_note(Input::get('note'));
        }

        Logger::add_log('New note added.');
        return Redirect::to('manage/view')->with('message', 'Note added.');
    }

    public function getEdit()
    {
        return "Edit form";
    }

    public function getError()
    {
        return "ERROR: no entry. Your session may have timed out or you may not have sufficient rights to access this section.";
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('manage')->with('message', 'You have been logged out.');
    }

    public function getConfirm()
    {
        $workorder = Workorder::find(Session::get('iwo_id'));
        $workorder->confirmed = 1;
        $workorder->updated_at = date_time_now();
        $workorder->save();

        Logger::add_log('Work order confirmed.');

        return Redirect::to('manage/view')->with('message', 'Work order confirmed.');
    }

    public function getUnconfirm()
    {
        $workorder = Workorder::find(Session::get('iwo_id'));
        $workorder->confirmed = 0;
        $workorder->updated_at = date_time_now();
        $workorder->save();

        Logger::add_log('Work order un-confirmed.');

        return Redirect::to('manage/view')->with('message', 'Work order un-confirmed.');
    }

    public function getCancel()
    {
        $workorder = Workorder::find(Session::get('iwo_id'));
        $workorder->cancelled = 1;
        $workorder->updated_at = date_time_now();
        $workorder->save();

        Logger::add_log('Work order cancelled.');

        return Redirect::to('manage/view')->with('message', 'Work order cancelled.');
    }
}