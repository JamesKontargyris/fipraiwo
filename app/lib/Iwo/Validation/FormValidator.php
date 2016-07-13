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
		if( ! \Request::is('login') && ! \Request::is('login/*') && ! \Request::is('users/*') && ! \Request::is('users') && ! \Request::is('password/*') && ! \Request::is('password'))
		{
			//Get global rules
			$global_rules = new GlobalValidator;
			//Get this IWO's specific rules
			$iwo_rules = $this->rules;
			//Merge all rules
			$all_rules = array_merge($global_rules->get_rules(), $iwo_rules);

			return $all_rules;
		}
		else
		{
			return $this->rules;
		}
	}

	protected function getValidationMessages()
	{
		if( ! \Request::is('login') && ! \Request::is('login/*') && ! \Request::is('users/*') && ! \Request::is('users') && ! \Request::is('password/*') && ! \Request::is('password'))
		{
			//Get global rules
			$global_messages = new GlobalValidator;
			//Get this IWO's specific rules
			$iwo_messages = $this->messages;
			//Merge all rules
			$all_messages = array_merge($global_messages->get_messages(), $iwo_messages);

			return $all_messages;
		}
		else
		{
			return $this->messages;
		}
	}

	protected function getValidationErrors()
	{
		return $this->validation->errors();
	}
}