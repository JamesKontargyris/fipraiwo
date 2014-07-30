<?php namespace Iwo\Validation;

//Global validation rules across all forms
class GlobalValidator
{
	protected $rules = [
		'workorder_title' => 'required|max:255',
        'workorder_reference' => 'min:10|alpha_num|unique:iwo_refs,iwo_ref'
	];

    public function get_rules()
    {
        return $this->rules;
    }
}