<?php

class Formtype extends Eloquent
{
	public function copy_contacts()
	{
		return $this->hasMany('Copy_contact', 'formtype_id');
	}

    public function workorders()
    {
        return $this->hasMany('Workorder', 'formtype_id');
    }
}