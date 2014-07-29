<?php


use Illuminate\Support\Facades\Redirect;
use Iwo\Exceptions\ManagementLoginException;

class ManagementController extends BaseController
{
    protected $page_title;

    public function __construct(){
        //Set default page title
        $this->page_title = "IWO Management";
    }

    public function getIndex()
    {
        if(Auth::check())
        {
            return View::make('manage.dashboard')->with('page_title', $this->page_title);
        }
        else
        {
            return View::make('manage.login')->with('page_title', $this->page_title);
        }
    }

    public function postIndex()
    {
    //    Attempt to find user in DB
        $email = Input::get('email');
        $iwo_ref = Input::get('iwo_ref');
        //Get IWO id
        $iwo_id = Iwo_ref::where('iwo_ref', $iwo_ref)->pluck('iwo_id');
        if($user = User::where('email', '=', $email)->where('iwo_id', '=', $iwo_id)->first())
        {
            //    If user found, log the user in and redirect to view IWO
            Auth::loginUsingId($user->id);
            return View::make('manage.dashboard')->with('page_title', $this->page_title);
        }
        else
        {
            //    If no user found, throw an exception and redirect back with errors
            throw new ManagementLoginException('Login failed', 'Incorrect login details entered. Please try again.');
        }
    }

    public function getView()
    {
        return "Congratulations - you are logged in.";
    }

    public function getEdit()
    {
        return "Edit form";
    }

    public function getError()
    {
        return "ERROR: no entry. Your session may have timed out or you may not have sufficient rights to access this section.";
    }

    private function logged_in()
    {
        return Auth::check();
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('manage')->with('message', 'You have been logged out.');
    }
} 