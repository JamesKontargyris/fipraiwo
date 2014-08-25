<?php


class ConfirmController extends BaseController
{
    public function getIndex()
    {
        if( ! $this->check_input())
        {
            return Redirect::to('/')->withErrors('Error: incorrect or incomplete user / IWO ref data supplied.');
        }

        return "Hello from confirm controller!";
    }

    private function check_input()
    {
        //If both 'ref' and 'email' values as not passed through, return to the homepage
        if( ! Input::get('ref') || ! Input::get('email'))
        {
            return false;
        }

        return true;
    }
} 