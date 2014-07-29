<?php namespace Iwo\Exceptions;

use Exception;

class ManagementLoginException extends Exception
{
    public function __construct($message, $errors)
	{
		parent::__construct();
		$this->errors = $errors;
	}

	public function getErrors()
	{
		return $this->errors;
	}
}