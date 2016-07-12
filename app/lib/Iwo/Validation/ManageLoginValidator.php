<?php namespace Iwo\Validation;

use Iwo\Validation\FormValidator;

class ManageLoginValidator extends FormValidator
{
    protected $rules = [
        'manage_email' => 'required|email|fipra_email_address',
        'manage_password' => 'required',
        'iwo_ref' => 'required|min:6',
    ];

    protected $messages = [
        'manage_email' => 'The email field is required.',
        'manage_password' => 'The password field is required.',
        'iwo_ref' => 'The IWO reference field is required.',
        'email' => 'The email format is invalid.',
        'fipra_email_address' => 'Only fipra.com email addresses are allowed.',
    ];
}