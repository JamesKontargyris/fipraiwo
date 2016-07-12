<?php namespace Iwo\Validation;

use Iwo\Validation\FormValidator;

class EditUserValidator extends FormValidator
{
    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|fipra_email_address',
        'password' => 'sometimes|confirmed|min:6|max:12',
    ];

    protected $messages = [
//        'required' => 'This field is required.',
        'fipra_email_address' => 'Only fipra.com email addresses are allowed.',
    ];
}