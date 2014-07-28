<?php

class Formtype extends Eloquent
{
	public function copy_contacts()
	{
		return $this->hasMany('copy_contact');
	}
}