<?php namespace Iwo\Validation;

use Exception;
use Illuminate\Support\MessageBag;

class FormValidationException extends Exception
{
	protected $errors;

	public function __construct($message, MessageBag $errors)
	{
		parent::__construct($message);
		$this->errors = $errors;
	}

	public function getErrors()
	{
		return $this->errors;
	}
}