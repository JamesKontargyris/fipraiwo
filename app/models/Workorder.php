<?php

class Workorder extends Eloquent
{

    protected $guarded = array('id');

    public function iwo_ref()
    {
        return $this->hasOne('Iwo_ref', 'iwo_id');
    }

    public function lead_contact()
    {
        return $this->hasOne('Lead_contact', 'iwo_id');
    }

    public function sub_contact()
    {
        return $this->hasOne('Sub_contact', 'iwo_id');
    }

    public function notes()
    {
        return $this->hasMany('Note', 'iwo_id');
    }

    public function logs()
    {
        return $this->hasMany('Logger', 'iwo_id');
    }

} 