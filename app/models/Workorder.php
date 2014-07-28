<?php

class Workorder extends Eloquent {

    protected $guarded = array('id');

    public function iwo_refs()
    {
        return $this->belongsTo('iwo_ref');
    }

    public function lead_contact()
    {
        return $this->belongsTo('lead_contact');
    }

    public function sub_contact()
    {
        return $this->belongsTo('sub_contact');
    }

} 