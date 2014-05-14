<?php

class Formtype extends Eloquent
{
	public function emailrecipients()
	{
		return $this->hasMany('Emailrecipient');
	}
}