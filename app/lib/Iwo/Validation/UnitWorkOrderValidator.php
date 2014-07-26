<?php namespace Iwo\Validation;

use Iwo\Validation\FormValidator;

class UnitWorkOrderValidator extends FormValidator
{
	protected $rules = [
		//'lead_unit' => 'required',
		//'lead_unit_account_director' => 'required',
        //'email_address' => 'required|email',
		//'sub_contracted_unit_correspondent_affiliate' => 'required',
		//'sub_contracted_unit_correspondent_affiliate_account_director' => 'required',
        //'sub_email_address' => 'required|email',
		//'the_work_will_be_done' => 'required',
		//'agreed_fee_element' => 'required',
		//'agreed_fee_element_details' => 'required_if:agreed_fee_element,Yes',
        //'work_capped_each_month' => 'required',
        //'work_cap' => 'required_if:work_capped_each_month,Yes',
		//'green_sheet_required' => 'required',
	];
	
	protected $messages = [
    	'required' => 'This field is required.',
	];
}