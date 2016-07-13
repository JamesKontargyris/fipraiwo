<?php

use Iwo\Mailer\Mailer;
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

    public function __construct(ResetValidator $validator, Mailer $mailer)
    {
        parent::__construct();
        $this->validator = $validator;
        $this->mailer = $mailer;
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
                $user->password = Hash::make($data['new_password']);
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

	protected function userExists($email)
    {
        return User::where('email', '=', $email)->where('iwo_id', '=', 0)->first();
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
