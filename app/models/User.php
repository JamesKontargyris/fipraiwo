<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use HasRole;

    public function notes()
    {
        return $this->hasMany('Note');
    }

    public function workorder()
    {
        return $this->hasOne('Workorder');
    }

    public static function login_user($user_id, $iwo_id, $iwo_ref)
    {
        Auth::loginUsingId($user_id);
        Session::set('user_id', $user_id);
        Session::set('iwo_id', $iwo_id);
        Session::set('iwo_ref', $iwo_ref);

        return true;
    }

	public static function addUser($input)
	{
		$new_user = new User;
		$new_user->email = $input['email'];
		$new_user->name = $input['name'];
		$new_user->password = Hash::make($input['password']);
		if($new_user->save())
		{
			$new_user->attachRole($input['role_id']);
			return true;
		}

		return false;
	}

	public static function editUser($id, $input)
	{
		if($updated_user = User::find($id))
		{
			$updated_user->email = $input['email'];
			$updated_user->name = $input['name'];
			if($input['password'])
            {
                $updated_user->password = Hash::make($input['password']);
                $updated_user->changed_password = 0;
            }
		}
		if($updated_user->save())
		{
			return true;
		}

		return false;
	}

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}