<?php

class PasswordController extends \BaseController {

//	Display password reminder form
	public function getReset()
	{
		if( ! Auth::check())
		{
			return View::make('password.forgotform')->with('page_title', 'Reset your password');
		}
		else
		{
			return Redirect::to('/');
		}
	}

//	Process the forgotten password form
	public function postReset()
	{

	}



}
