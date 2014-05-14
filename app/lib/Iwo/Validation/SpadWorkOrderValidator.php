<?php namespace Iwo\Validation;

use Iwo\Validation\FormValidator;

class SpadWorkOrderValidator extends FormValidator
{
	protected $rules = [
		'account_director' => 'required',
		'special_adviser' => 'required',
		'scope_of_service' => 'required',
		'deliverables' => 'required',
		'time_frame' => 'required',
		'standard_hourly_rate_applies' => 'required',
		'flat_fee_agreed' => 'numeric',
		'flat_fee_basis' => 'required_with:flat_fee_agreed',
		'agreed_fee_element' => 'required',
		'agreed_fee_element_details' => 'required_if:agreed_fee_element,Yes',
		'green_sheet_required' => 'required',
		'written_contract_exists' => 'required',
		'registered_email' => 'required|email'
	];
	protected $messages = [
    	'required' => 'This field is required.',
	];
}