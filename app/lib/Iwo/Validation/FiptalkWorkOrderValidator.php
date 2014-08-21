<?php namespace Iwo\Validation;

use Iwo\Validation\FormValidator;

class FiptalkWorkOrderValidator extends FormValidator
{
    protected $rules = [
        'person_requiring_assistance'           => 'required',
        'unit_special_adviser_or_correspondent' => 'required',
        'lead_email_address'                    => 'required|email',
        'time_frame'                            => 'required',
        'require_cost_estimate'                 => 'required',
        'individual_or_group_coaching'          => 'required',
        'group_numbers'                         => 'required_if:individual_or_group_coaching,Group',
    ];
    protected $messages = [
        'required' => 'This field is required.',
    ];
}