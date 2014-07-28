<?php

use Iwo\Workers\Generate;

class Iwo_ref extends Eloquent
{

    protected $guarded = array('id');

    public function workorders()
    {
        return $this->belongsTo('workorder');
    }

    public function generate_ref()
    {
        //Generate a unique reference for the work order and save to DB
        $unique = "no";
        $ref_code = "";
        while($unique == "no")
        {
            $ref_code = Generate::iwo_ref(10);
            //If the code isn't found in the DB, the code is unique
            //so break the while loop
            if( ! $this->test_ref($ref_code, 'iwo_ref'))
            {
                $unique = "yes";
            }
        }

        return $ref_code;
    }

    private function test_ref($code, $column)
    {
        return $this->where($column, $code)->first();
    }

} 