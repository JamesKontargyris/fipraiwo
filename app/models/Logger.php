<?php


class Logger extends Eloquent
{
    protected $table = 'logs';

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function workorder()
    {
        return $this->belongsTo('Workorder');
    }

    public static function add_log($message, $type = 'standard', $iwo_id, $user_id)
    {
        $log = new Logger;
        $log->iwo_id = $iwo_id ? $iwo_id : Session::get('iwo_id');
        $log->user_id = $user_id ? $user_id : Session::get('user_id');
        $log->log = $message;
        $log->type = $type;
        $log->created_at = date_time_now();
        $log->updated_at = date_time_now();
        $log->save();

        return true;
    }
}