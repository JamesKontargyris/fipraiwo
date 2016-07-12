<?php namespace Iwo\Exceptions;

class CannotEditException extends \Exception
{
    function __construct()
    {
        parent::__construct();
    }

    public function getErrors()
    {
        return 'Sorry, you can\'t edit that.';
    }

}