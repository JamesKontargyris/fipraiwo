<?php


class Rating extends Eloquent {

	public $guarded = ['id'];

    public function workorder()
    {
        return $this->belongsTo('Workorder');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public static function add_rating($score = 0, $comment = '', $iwo_id, $user_id)
    {
	    $user = User::find($user_id);

        $new_rating = new Rating;
        $new_rating->score = $score;
        $new_rating->comment = trim($comment);
        $new_rating->iwo_id = $iwo_id;
        $new_rating->user_id = $user_id;
        $new_rating->created_at = date_time_now();
        $new_rating->updated_at = date_time_now();
        $new_rating->save();

        return true;
    }

	public static function get_iwo_rating($iwo_id, $round = true)
	{
		$ratings = Rating::where('iwo_id', '=', $iwo_id)->get();

		if($ratings->count())
		{
			$score = 0;
			foreach($ratings as $rating)
			{
				$score = $score + $rating->score;
			}

			$score = $score / $ratings->count();

			if($round) {
				// Round to nearest 0.5
				$score = round($score * 2) / 2;
			}

			return $score;

		}

		return false;

	}
} 