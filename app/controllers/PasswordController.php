<?php

use Iwo\Mailer\Mailer;
use Iwo\Validation\ChangePasswordValidator;
use Iwo\Validation\ResetValidator,
    Rych\Random\Random;

class PasswordController extends \BaseController {

    /**
     * @var ResetValidator
     */
    private $validator;
    /**
     * @var Mailer
     */
    private $mailer;
    /**
     * @var ChangePasswordValidator
     */
    private $changevalidator;

    public function __construct(ResetValidator $validator, ChangePasswordValidator $changevalidator, Mailer $mailer)
    {
        parent::__construct();
        $this->validator = $validator;
        $this->mailer = $mailer;
        $this->changevalidator = $changevalidator;
    }

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
        $input = Input::all();
        $this->validator->validate($input);

//        Does the user exist with a Fipriot account?
        if($user = $this->userExists($input['email']))
        {
//            Generate a new password
            $data['new_password'] = $this->generatePassword(10);
            $data['name'] = $user->name;

//            Send the email
            if($this->mailer->sendTo($user->email, 'Fipra IWO password reset', 'password.reset', $data))
            {
//                Email was successfully sent, so we can reset the password in the DB
//                and reset the changed_password to 0 (no), so the user is prompted to change
//                their password when they next login
                $user->password = Hash::make($data['new_password']);
                $user->changed_password = 0;
                $user->save();

                return Redirect::to('/login')->with('message', 'Password has been reset successfully. Please check your email.');
            }
            else
            {
                return Redirect::back()->with('error', 'Error: problem sending password reset email. Please try again.');
            }

        }
        else
        {
            return Redirect::back()->with('error', 'Error: user does not exist.');
        }

	}

    /**
     * Allow the user to change their password
     *
     * @return mixed
     */
    public function getChange()
    {
        return View::make('password.changeform')->with(['page_title' => 'Password Management', 'pass' => Session::get('temp_pass')]);
    }

    public function postChange()
    {
        $input = Input::all();
        $this->changevalidator->validate($input);

        $user = Auth::user();
        $user->password = Hash::make($input['new_password']);
        $user->changed_password = 1;
//        Remove the temporary password from the session
        Session::forget('temp_pass');

        if($user->save())
            return Redirect::intended('/')->with('message', 'Password updated successfully. Please use your new password next time you login.');
        else
            return Redirect::back()->with('error', 'Error: new password could not be changed. Please try again.');
    }



	protected function userExists($email)
    {
        return User::where('email', '=', $email)->where('iwo_id', '=', 999999)->first();
    }

    /**
     * Generate a new random string password
     *
     * @param $length
     * @return string
     */
    protected function generatePassword($length)
    {
        $random = new Random;
        return $random->getRandomString($length);
    }



}
