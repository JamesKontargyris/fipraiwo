<?php namespace Iwo\Validation;

use Iwo\Validation\FormValidator;

class LoginValidator extends FormValidator
{
    protected $rules = [
        'email' => 'required|email|fipra_email_address',
        'password' => 'required',
    ];

    protected $messages = [
//        'required' => 'This field is required.',
        'fipra_email_address' => 'Only fipra.com email addresses are allowed.',
    ];
}