<?php namespace Iwo\Validation;

use Iwo\Validation\FormValidator;

class FiplexWorkOrderValidator extends FormValidator
{
    protected $rules = [
        'commissioned_by'                       => 'required',
        'unit_special_adviser_or_correspondent' => 'required',
        'email_address'                         => 'required|email',
        'project_and_client_name'               => 'required',
        'other_service_info'                    => 'required_if:other_service,on',
        'required_completion_date_and_time'     => 'required',
        'type_of_product'                       => 'required',
        'require_cost_estimate'                 => 'required',
    ];
    protected $messages = [
        'required' => 'This field is required.',
    ];
}