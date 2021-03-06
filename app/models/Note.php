<?php


class Note extends Eloquent {

	public $guarded = ['id'];

    public function workorder()
    {
        return $this->belongsTo('Workorder');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public static function add_note($note)
    {
	    $current_user = User::find(Session::get('user_id'));

        $new_note = new Note;
        $new_note->note = $note;
        $new_note->iwo_id = Session::get('iwo_id');
        $new_note->user_id = Session::get('user_id');
        $new_note->name = $current_user->name;
        $new_note->created_at = date_time_now();
        $new_note->updated_at = date_time_now();
        $new_note->save();

        return true;
    }
} 