<?php namespace Iwo\Validation;

use Iwo\Validation\FormValidator;

class AddUserValidator extends FormValidator
{
    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|fipra_email_address',
        'password' => 'required|confirmed|min:6|max:12',
        'password_confirmation' => 'required',
        'role_id' => 'required',
    ];

    protected $messages = [
//        'required' => 'This field is required.',
        'fipra_email_address' => 'Only fipra.com email addresses are allowed.',
    ];
}