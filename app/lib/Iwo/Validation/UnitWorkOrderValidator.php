<?php namespace Iwo\Validation;

use Iwo\Validation\FormValidator;

class UnitWorkOrderValidator extends FormValidator
{
	protected $rules = [
		'lead_unit' => 'required',
		'lead_unit_account_director' => 'required',
		'sub_contracted_unit_correspondent_affiliate' => 'required',
		'sub_contracted_unit_correspondent_affiliate_account_director' => 'required',
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