<?php


class Sub_contact extends Eloquent {

    public $timestamps = false;

    public function workorders()
    {
        return $this->belongsTo('workorder');
    }
} 