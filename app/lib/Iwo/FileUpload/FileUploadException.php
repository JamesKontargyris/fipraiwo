<?php namespace Iwo\FileUpload;

use Exception;

class FileUploadException extends Exception
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