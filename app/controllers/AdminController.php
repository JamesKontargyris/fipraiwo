<?php


class AdminController extends BaseController {

    protected $page_title;

    public function __construct()
    {
        $this->page_title = "Fipra Online IWO Admin";
    }
    public function getIndex()
    {
        return View::make('admin.login')->with('page_title', $this->page_title);
    }

    public function postIndex()
    {
        if(Input::has('access_code') && Input::get('access_code') == 'superuser')
        {
            Session::set('admin_logged_in', 'yes');

            return Redirect::to('admin/dashboard');
        }
        else
        {
            return Redirect::back()->withErrors('Incorrect access code entered. Please try again.');
        }
    }

    public function getDashboard()
    {
        if(Session::get('admin_logged_in'))
        {
            $formtypes = Formtype::all();

            return View::make('admin.dashboard')->with(['formtypes' => $formtypes, 'page_title' => $this->page_title]);
        }
        else
        {
            Redirect::to('admin');
        }
    }

    public function getView()
    {
        if(Session::get('admin_logged_in'))
        {
            $iwo_id = Request::segment(3);
            if(isset($iwo_id))
            {
                $workorder = Workorder::find($iwo_id);
                $workorder->workorder = pretty_input(unserialize($workorder->workorder));

                return View::make('admin.view')->with(['page_title' => $this->page_title, 'workorder' => $workorder]);
            }
            else
            {
                redirect::to('admin/dashboard');
            }
        }
    }

    public function getLogout()
    {
        Session::forget('admin_logged_in');

        return Redirect::route('home')->with('message', 'You have been logged out.');
    }
} 