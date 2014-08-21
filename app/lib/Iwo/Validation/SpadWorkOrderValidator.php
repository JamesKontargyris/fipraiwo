<?php namespace Iwo\Validation;

use Iwo\Validation\FormValidator;

class SpadWorkOrderValidator extends FormValidator
{
    protected $rules = [
        'account_director'                => 'required',
        'special_adviser_instructed'      => 'required',
        'lead_email_address'              => 'required|email',
        'the_work_will_be_done'           => 'required',
        'rate_is'                         => 'required|numeric',
        'agreed_fee_element'              => 'required',
        'agreed_fee_element_details'      => 'required_if:agreed_fee_element,Yes',
        'work_capped_each_month'          => 'required',
        'work_cap'                        => 'required_if:work_capped_each_month,Yes',
        'internal_work_order_expiry_date' => 'required|futuredate',
        'green_sheet_required'            => 'required',
    ];
    protected $messages = [
        'required' => 'This field is required.',
    ];
}