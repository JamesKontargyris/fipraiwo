<?php 

class Copy_contact extends Eloquent
{
	public function formtypes()
	{
		return $this->belongsTo('Formtype');
	}
}