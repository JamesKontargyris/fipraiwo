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
		return $this->rules;
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