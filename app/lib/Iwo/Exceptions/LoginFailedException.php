<?php namespace Iwo\Exceptions;

use Exception;

class LoginFailedException extends Exception {

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