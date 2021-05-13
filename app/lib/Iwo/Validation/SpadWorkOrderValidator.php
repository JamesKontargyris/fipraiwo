<?php namespace Iwo\Validation;

use Iwo\Validation\FormValidator;

class SpadWorkOrderValidator extends FormValidator {
	protected $rules = [
		'account_director'                => 'required',
		'special_adviser_instructed'      => 'required',
		'lead_email_address'              => 'required|email',
		'billing_entity'                  => 'required',
		'the_work_will_be_done'           => 'sometimes|required',
		'days'                            => 'sometimes|required|numeric',
		'day_rate_in_euros'               => 'sometimes|required|numeric',
		'flat_rate_in_euros'              => 'sometimes|required|numeric',
		'rate_is'                         => 'sometimes|required|numeric',
		'agreed_fee_element'              => 'required',
		'agreed_fee_element_details'      => 'required_if:agreed_fee_element,Yes',
		'work_capped_at_maximum_level'    => 'required',
		'work_cap'                        => 'required_if:work_capped_at_maximum_level,Yes',
		'internal_work_order_expiry_date' => 'required',
		'green_sheet_required'            => 'required',
	];
	protected $messages = [
		'required' => 'This field is required.',
	];
}