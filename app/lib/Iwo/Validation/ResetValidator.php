<?php namespace Iwo\Validation;

use Iwo\Validation\FormValidator;

class ResetValidator extends FormValidator
{
    protected $rules = [
        'email' => 'required|email|fipra_email_address',
    ];

    protected $messages = [
//        'required' => 'This field is required.',
        'fipra_email_address' => 'Only fipra.com email addresses are allowed.',
    ];
}