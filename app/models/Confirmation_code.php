<?php


class Confirmation_code extends Eloquent {

    public function workorder()
    {
        return $this->belongsTo('Workorder');
    }

    public static function generate_code($length = 32)
    {
        if($length > 255) { $length = 255; }

        $randString = '';
        while (strlen($randString) < $length) {
            // generate a character between 0-9 a-f
            $character = mt_rand(0,15);
            if ($character > 9) $character += 39;
            $randString .= chr($character + 48);
        }

        return $randString;
    }
} 