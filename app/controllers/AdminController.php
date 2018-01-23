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
        if($this->check_admin_user())
        {
            $formtypes = Formtype::all();

            return View::make('admin.dashboard')->with(['formtypes' => $formtypes, 'page_title' => $this->page_title]);
        }
        else
        {
            Redirect::to('admin');
        }
    }

	public function getPcl() // Display IWOs involving Peter-Carlo Lehrell
	{
		if($this->check_admin_user())
		{
			$workorders = Workorder::where('workorder', 'LIKE', '%"lead_unit_account_director";s:19:"Peter-Carlo Lehrell"%')->orWhere('workorder', 'LIKE', '%"sub_contracted_unit_correspondent_affiliate_account_director";s:19:"Peter-Carlo Lehrell"%')->get();
			return View::make('admin.pcl')->with(['workorders' => $workorders, 'page_title' => $this->page_title]);
		}
		else
		{
			Redirect::to('admin');
		}

	}

    public function getView()
    {
        if($this->check_admin_user())
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

	public function getDelete()
	{
		if($this->check_admin_user())
		{
			$id = Request::segment(3);
			$iwo = Workorder::find($id);
			if($iwo)
			{
				$iwo->delete();
				return Redirect::to('admin/dashboard')->with('message', 'Work order deleted.');
			}
			else
			{
				return Redirect::to('admin/dashboard')->withErrors('Work order not found.');
			}
		}
	}

    public function getLogout()
    {
        Session::flush();

        return Redirect::route('home')->with('message', 'You have been logged out.');
    }

	private function check_admin_user()
	{
		if( ! Session::get('admin_logged_in') && Session::get('admin_logged_in') != 'yes')
		{
			return Redirect::back()->withErrors('You need to be logged in to carry out that action.');
		}

		return true;
	}
} 