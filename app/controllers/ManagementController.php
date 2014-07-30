<?php


use Illuminate\Support\Facades\Redirect;
use Iwo\Exceptions\ManagementLoginException;

class ManagementController extends BaseController
{
    protected $page_title;

    public function __construct()
    {
        parent::__construct();

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
        $workorder = Workorder::where('id', '=', Auth::user()->iwo_id)->first();
        $workorder->iwo_ref = Iwo_ref::where('iwo_id', '=', $workorder->id)->pluck('iwo_ref');
        $workorder->workorder = pretty_input(unserialize($workorder->workorder));
        $workorder->notes = [
            ['author' => 'Mark McGann', 'datetime' => '2014-07-30 12:35:54', 'note' => 'This is note 3'],
            ['author' => 'Laura Batchelor', 'datetime' => '2014-07-30 10:23:54', 'note' => 'This is note 2'],
            ['author' => 'James Kontargyris', 'datetime' => '2014-07-29 14:46:54', 'note' => 'This is note 1'],
        ];

        return View::make('manage.view_iwo')->with(['page_title' => $this->page_title, 'workorder' => $workorder, 'user' => Auth::user()]);
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
}