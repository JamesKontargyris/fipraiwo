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

    public function confirmation_code()
    {
        return $this->hasOne('Confirmation_code', 'iwo_id');
    }

    public function users()
    {
        return $this->hasMany('User', 'iwo_id');
    }

	public function copy_emails()
	{
		return $this->hasMany('Copy_email', 'iwo_id');
	}

    public static function update_date_time()
    {
        $workorder = Workorder::find(Session::get('iwo_id'));
        $workorder->updated_at = date_time_now();
        $workorder->save();

        return true;
    }

} 