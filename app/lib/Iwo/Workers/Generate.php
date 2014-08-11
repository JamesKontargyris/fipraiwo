<?php namespace Iwo\Workers;

class Generate {

    public static function iwo_ref($number = 1)
    {
    //    Generate a code reference and return it
        $pass = date('Ymd') . str_pad($number, 5, '0', STR_PAD_LEFT);
        return $pass;
    }
} 