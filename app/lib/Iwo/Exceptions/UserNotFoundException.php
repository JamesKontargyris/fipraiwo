<?php namespace Iwo\Exceptions;

class UserNotFoundException extends \Exception
{

    function __construct()
    {
        parent::__construct();
    }

    public function getErrors()
    {
        return 'Sorry, that user does not exist.';
    }

}