<?php namespace Iwo\Validation;

use Iwo\Validation\FormValidator;

class EDTWorkOrderValidator extends FormValidator
{
	protected $rules = [
		'commissioned_by'                       => 'required',
		'unit_special_adviser_or_correspondent' => 'required',
		'contact_email_address'                 => 'required|email',
		'project_and_client_name'               => 'required',
		'required_completion_date_and_time'     => 'required',
		'type_of_product'                       => 'required',
		'require_consultation'                  => 'required',
		'require_cost_estimate'                 => 'required',
		'registered_email'                      => 'required|email'
	];
	protected $messages = [
    	'required' => 'This field is required.',
	];
}