<?php namespace Iwo\Workers;

class Generate {

    public static function iwo_ref($number = 1)
    {
    //    Generate a code reference using the number passed in and return it
        $pass = date('ymd') . str_pad($number, 4, '0', STR_PAD_LEFT);
        return $pass;
    }

    public static function add_letter($pass)
    {

    }
} 