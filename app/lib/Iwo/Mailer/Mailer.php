<?php namespace Iwo\Mailer;

use Config;
use Mail;

class Mailer
{
	
	protected function sendEmail($address, $subject, $view = 'emails.default', $view_data = [], $file_names = [])
	{
		$data = $view_data;
		Mail::send($view, compact('data'), function($message) use ($address, $subject, $file_names)
		{
			$message->to($address)->subject($subject);
			if(count($file_names) > 0)
			{
				foreach($file_names as $file_name)
				{
					$message->attach(Config::get('iwo_vars.upload_dir') . '/' . $file_name);
				}
			}
		});
	return true;
	}

	public function sendTo($address, $subject, $view = 'emails.default', $data = [], $file_names = [])
	{
        if(is_array($address))
        {
            foreach($address as $email)
            {
                $this->sendEmail($email, $subject, $view, $data, $file_names);
            }
        }
        else
        {
            $this->sendEmail($address, $subject, $view, $data, $file_names);
        }

        return true;
    }
}