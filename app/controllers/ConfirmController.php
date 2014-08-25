<?php


class ConfirmController extends BaseController
{
    protected $message = 'Error: incorrect IWO data entered. Cannot continue with one-click confirmation.';

    public function getIndex()
    {
        //Ensure a reference, email address and confirmation code are passed in
        if (!$this->check_input())
        {
            return Redirect::to('/')->withErrors($this->message);
        }

        //Get the input values and place in variables
        $iwo_id = Input::get('id');
        $email = Input::get('email');
        $code = Input::get('code');

        if ($this->check_confirmed($iwo_id))
        {
            return Redirect::to('/')->withErrors('Error: IWO already confirmed.');
        }

        //Find a workorder for the id passed in
        $workorder = Workorder::find($iwo_id);
        //Find a user for the email address passed in
        $user = $workorder->users()->where('email', '=', $email)->first();
        //Check the confirmation code passed in links to the correct work order
        $confirmation_code = Confirmation_code::where('code', '=', $code)->where('iwo_id', '=', $iwo_id)->first();

        //Does a workorder exist that is linked to the id passed in?
        //Does the email address passed in link to a user linked to the current workorder?
        //Is the confirmation code correct for the workorder found by the reference?
        if ( ! $workorder || ! $user || ! $confirmation_code)
        {
            return Redirect::to('/')->withErrors($this->message);
        }
        else
        {
            $iwo_ref = $workorder->iwo_ref()->first()->pluck('iwo_ref');

            //If the workorder id, user email and confirmation code all stack up,
            //log the user in and redirect to the management controller 'confirm' method,
            //where user permissions will be checked and the confirmation will take place
            User::login_user($user->id, $iwo_id, $iwo_ref);

            return Redirect::to('manage/confirm');
        }

    }

    private function check_input()
    {
        //If both 'ref' and 'email' values as not passed through, return to the homepage
        if (!Input::get('id') || !Input::get('email') || !Input::get('code'))
        {
            return false;
        }

        return true;
    }

    private function check_confirmed($iwo_id)
    {
        return Workorder::find($iwo_id)->first()->pluck('confirmed');
    }
}