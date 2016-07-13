<?php namespace Iwo\Validation;

use Iwo\Validation\FormValidator;

class ChangePasswordValidator extends FormValidator
{
    protected $rules = [
        'current_password' => 'required|different:new_password|temp_password_match:your_temporary_password',
        'new_password' => 'required|min:6|max:12|confirmed',
        'new_password_confirmation' => 'required'
    ];

    protected $messages = [
        'temp_password_match' => 'The current password you entered is incorrect.'
    ];
}