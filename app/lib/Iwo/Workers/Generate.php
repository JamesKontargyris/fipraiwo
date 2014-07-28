<?php namespace Iwo\Workers;

class Generate {

    public static function iwo_ref($length = 10)
    {
    //    Generate a code reference and return it
        $chars = "abcdefghijkmnpqrstuvwxyz023456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;

        while ($i <= ($length - 1)) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }

        //If code is unique, return it
        return $pass;
    }
} 