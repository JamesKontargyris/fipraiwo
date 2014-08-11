<?php

use Iwo\Workers\Generate;

class Iwo_ref extends Eloquent
{
    protected $guarded = array('id');

    public function workorder()
    {
        return $this->belongsTo('Workorder');
    }

    public function generate_ref()
    {
        //Generate a unique reference for the work order and save to DB
        $unique = "no";
        $ref_code = "";
        for($i = 1; $unique == "no"; $i++)
        {
            $ref_code = Generate::iwo_ref($i);
            //If the code isn't found in the DB, the code is unique
            //so break the while loop
            if( ! $this->test_unique($ref_code, 'iwo_ref'))
            {
                $unique = "yes";
            }
        }

        return $ref_code;
    }

    private function test_unique($code, $column)
    {
        return $this->where($column, $code)->first();
    }

} 