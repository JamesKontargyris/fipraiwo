<?php

use Iwo\Exceptions\LoginFailedException;
use Iwo\Validation\LoginValidator;
use Iwo\Validation\ManageLoginValidator;

class LoginController extends BaseController
{
    // Instance of validator
    protected $validator;
    protected $managevalidator;

    public function __construct(LoginValidator $validator, ManageLoginValidator $managevalidator)
    {
        parent::__construct();
        $this->validator = $validator;
        $this->managevalidator = $managevalidator;
    }

    public function getIndex()
    {
        return View::make('login');
    }

    public function postIndex()
    {
        $input = Input::all();
        $this->validator->validate($input);

        $user = User::where('email','=',Input::get('email'))->where('iwo_id', '=', 0)->first();
        if($user && Hash::check(Input::get('password'), $user->password))
        {
            Auth::login($user);
//            Temp password used for changing the password
            Session::put('temp_pass', $user->password);

//            Has the user changed their password to something memorable?
            if( ! $user->changed_password )
            {
                return Redirect::to('/password/change');
            }

            return Redirect::intended('/');
        }
        else
        {
            throw new LoginFailedException('Login failed', 'Incorrect login details entered. Please try again.');
        }

    }
    
    public function postManage()
    {
        //		Validate the login form
        $input = Input::all();
        $this->managevalidator->validate($input);
//		Find out if the user exists as a normal Fipriot account
        $user_exists = User::where('email','=',Input::get('manage_email'))->where('iwo_id', '=', 0)->first();
//		If so, carry on to the login process for the IWO to be managed
        if($user_exists && Hash::check(Input::get('manage_password'), $user_exists->password))
        {
            //Find the core IWO reference, stripping off any letters from the end
            $user_iwo_ref = get_original_ref( Input::get( 'iwo_ref' ) );
            //Get IWO id
            $iwo_id = Iwo_ref::where( 'iwo_ref', 'LIKE', $user_iwo_ref . '%' )->pluck( 'iwo_id' );
            //Get the current IWO reference code
            $iwo_ref = Iwo_ref::where( 'iwo_id', '=', $iwo_id )->pluck( 'iwo_ref' );

            if ( $user = User::where( 'email', '=', Input::get('manage_email') )->where( 'iwo_id', '=', $iwo_id )->first() ) {
                //If user found, log the user in, add some useful session variables
                //and redirect to view IWO
                User::login_user($user->id, $iwo_id, $iwo_ref);

                return Redirect::to('manage/view');
            }
            else
            {
//			Otherwise, throw an exception
                throw new LoginFailedException('Login failed', 'Incorrect login details entered. Please try again.');
            }
        }
        else
        {
//			Otherwise, throw an exception
            throw new LoginFailedException('Login failed', 'Incorrect login details entered. Please try again.');
        }
    }
}