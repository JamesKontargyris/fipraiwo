<?php namespace Iwo\Validation;

use Validator;

abstract class FormValidator
{
	protected $validation;

	public function validate(array $input)
	{
		$this->validation = Validator::make($input, $this->getValidationRules(), $this->getValidationMessages());

		if($this->validation->fails())
		{
			throw new FormValidationException('Validation failed', $this->getValidationErrors());
		}

		return true;
	}

	protected function getValidationRules()
	{
        //Get global rules
        $global_rules = new GlobalValidator;
        //Get this IWO's specific rules
        $iwo_rules = $this->rules;
        //Merge all rules
        $all_rules = array_merge($global_rules->get_rules(), $iwo_rules);

        return $all_rules;
	}

	protected function getValidationMessages()
	{
		return $this->messages;
	}

	protected function getValidationErrors()
	{
		return $this->validation->errors();
	}
}