<?php namespace Iwo\Validation;

use Illuminate\Validation\Validator;

class EDTWorkOrderValidator extends FormValidator
{
    protected $rules = [
        'commissioned_by'                       => 'required',
        'lead_email_address'                    => 'required|email',
        'project_and_client_company_name'       => 'required',
        'required_completion_date'              => 'required|futuredate',
        'type_of_product'                       => 'required',
        'require_cost_estimate'                 => 'required',
    ];
    protected $messages = [
    ];
}