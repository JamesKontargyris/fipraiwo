<?php namespace Iwo\Validation;

use Iwo\Validation\FormValidator;

class SpadWorkOrderValidator extends FormValidator
{
	protected $rules = [
		'account_director' => 'required',
		'special_adviser' => 'required',
        'email_address' => 'required|email',
		'the_work_will_be_done' => 'required',
		'fee_agreed' => 'required|numeric',
		'fee_basis' => 'required_with:fee_agreed',
		'agreed_fee_element' => 'required',
		'agreed_fee_element_details' => 'required_if:agreed_fee_element,Yes',
		'green_sheet_required' => 'required',
		'written_contract_exists' => 'required',
	];
	protected $messages = [
    	'required' => 'This field is required.',
	];
}