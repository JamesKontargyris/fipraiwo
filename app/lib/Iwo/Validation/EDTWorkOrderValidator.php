<?php namespace Iwo\Validation;

use Illuminate\Validation\Validator;

class EDTWorkOrderValidator extends FormValidator
{
    protected $rules = [
        'commissioned_by'                       => 'required',
        'unit_special_adviser_or_correspondent' => 'required',
        'email_address'                         => 'required|email',
        'project_and_client_name'               => 'required',
        'required_completion_date'              => 'required|futuredate',
        'type_of_product'                       => 'required',
        'require_consultation'                  => 'required',
        'require_cost_estimate'                 => 'required',
    ];
    protected $messages = [
    ];
}