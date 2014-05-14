<?php 

class Emailrecipient extends Eloquent
{
	public function formtype()
	{
		return $this->belongsTo('Formtype');
	}
}