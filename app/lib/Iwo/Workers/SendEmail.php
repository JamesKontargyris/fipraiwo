<?php namespace Iwo\Workers;

use Iwo\Mailer\Mailer;
use User;


class SendEmail {

    private $mailer;

    function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    //Use Mailer's sendTo method to send emails
    private function send($email, $subject, $view, $data = [], $file_names = [])
    {
        $this->mailer->sendTo($email, $subject, $view, $data, $file_names);
    }

    //When an IWO is created, send an email to the lead unit contact
    public function iwo_created_lead($job, $data)
    {
        $data['subject'] = $data['form_type'] . " IWO: " . $data['iwo_title'] .  " (" . $data['iwo_ref'] . ") was submitted";

	    //If this is a re-send request, make that clear in the subject line
	    if(isset($data['resend']) && $data['resend'] === true) $data['subject'] = '*RE-SENDING* ' . $data['subject'];

        $this->send($data['recipient'], $data['subject'], "emails." . $data['iwo_key'] . ".lead", $data);

        $job->delete();
    }

    //When an IWO is created, send an email to the lead unit contact
    public function iwo_created_sub($job, $data)
    {
        $data['subject'] = $data['form_type'] . " IWO: " . $data['iwo_title'] .  " (" . $data['iwo_ref'] . ") was submitted";

	    //If this is a re-send request, make that clear in the subject line
	    if(isset($data['resend']) && $data['resend'] === true) $data['subject'] = '*RE-SENDING* ' . $data['subject'];

        $this->send($data['recipient'], $data['subject'], "emails." . $data['iwo_key'] . ".sub", $data);

        $job->delete();
    }

    //When an IWO is created, send an email to the lead unit contact
    public function iwo_created_rep($job, $data)
    {
        $data['subject'] = $data['form_type'] . " IWO: " . $data['iwo_title'] .  " (" . $data['iwo_ref'] . ") was submitted";

	    //If this is a re-send request, make that clear in the subject line
	    if(isset($data['resend']) && $data['resend'] === true) $data['subject'] = '*RE-SENDING* ' . $data['subject'];

        $this->send($data['recipient'], $data['subject'], "emails.rep", $data);

        $job->delete();
    }

    //When an IWO is created, send an email to the lead unit contact
    public function iwo_created_copy($job, $data)
    {
        $data['subject'] = $data['form_type'] . " IWO: " . $data['iwo_title'] .  " (" . $data['iwo_ref'] . ") was submitted";

	    //If this is a re-send request, make that clear in the subject line
	    if(isset($data['resend']) && $data['resend'] === true) $data['subject'] = '*RE-SENDING* ' . $data['subject'];

	    foreach($data['recipient'] as $recipient)
	    {
		    $this->send($recipient, $data['subject'], "emails.copy", $data);
	    }

        $job->delete();
    }

	//When an IWO is created, send an email to the lead unit contact
	public function iwo_updated_lead($job, $data)
	{
		$data['subject'] = "IWO: " . $data['iwo_title'] .  " (" . $data['old_ref'] . ") has been updated and re-submitted";

		//If this is a re-send request, make that clear in the subject line
		if(isset($data['resend']) && $data['resend'] === true) $data['subject'] = '*RE-SENDING* ' . $data['subject'];

		$this->send($data['recipient'], $data['subject'], "emails.manage.update.lead", $data);

		$job->delete();
	}

	//When an IWO is created, send an email to the lead unit contact
	public function iwo_updated_sub($job, $data)
	{
		$data['subject'] = "IWO: " . $data['iwo_title'] .  " (" . $data['old_ref'] . ") has been updated and re-submitted";

		//If this is a re-send request, make that clear in the subject line
		if(isset($data['resend']) && $data['resend'] === true) $data['subject'] = '*RE-SENDING* ' . $data['subject'];

		$this->send($data['recipient'], $data['subject'], "emails.manage.update.sub", $data);

		$job->delete();
	}

	//When an IWO is created, send an email to the lead unit contact
	public function iwo_updated_copy($job, $data)
	{
		$data['subject'] = "IWO: " . $data['iwo_title'] .  " (" . $data['old_ref'] . ") has been updated and re-submitted";

		//If this is a re-send request, make that clear in the subject line
		if(isset($data['resend']) && $data['resend'] === true) $data['subject'] = '*RE-SENDING* ' . $data['subject'];

		foreach($data['recipient'] as $recipient)
		{
			$this->send($recipient, $data['subject'], "emails.manage.update.copy", $data);
		}

		$job->delete();
	}

    //When an IWO is created, send an email to the lead unit contact
    public function iwo_auto_confirmed($job, $data)
    {
        $data['subject'] = $data['form_type'] . " IWO: " . $data['iwo_title'] .  " (" . $data['iwo_ref'] . ") Internal Work Order was submitted and confirmed";

	    //If this is a re-send request, make that clear in the subject line
	    if(isset($data['resend']) && $data['resend'] === true) $data['subject'] = '*RE-SENDING* ' . $data['subject'];

        foreach($data['recipient'] as $recipient)
        {
	        // get the User model from the current recipient's email address and the iwo_id
	        $users = User::where('email', '=', $recipient)->where('iwo_id', '=', $data['iwo_id'])->get();

	        foreach($users as $user)
	        {
		        // There will only be one user (hopefully), but we need to do this to retain the user as a Model
		        // Add the user's ID to the dataset
		        $data['user_id'] = $user->id;
		        $data['email'] = $user->email;
		        $data['include_rating_link'] = false;

		        // If this user is a Lead or Sub user on this IWO, include the link to rate the IWO
		        if($user->hasRole('Lead') || $user->hasRole('Sub'))
		        {
			        $data['include_rating_link'] = true;
		        }

		        $this->send($recipient, $data['subject'], "emails.manage.auto_confirm", $data, $data['file_names']);
	        }

        }

        $job->delete();
    }

    //Send an email when an IWO is updated
    public function iwo_updated($job, $data)
    {
        $data['subject'] = "IWO: " . $data['iwo_title'] .  " (" . $data['old_ref'] . ") has been updated";

        foreach($data['recipient'] as $recipient)
        {
            $this->send($recipient, $data['subject'], "emails.manage.update", $data);
        }

        $job->delete();
    }

    //Send an email when an IWO is cancelled
    public function iwo_cancelled($job, $data)
    {
        $data['subject'] = "IWO: " . $data['iwo_title'] .  " (" . $data['iwo_ref'] . ") has been cancelled";

        foreach($data['recipient'] as $recipient)
        {
	        // get the User model from the current recipient's email address and the iwo_id
	        $users = User::where('email', '=', $recipient)->where('iwo_id', '=', $data['iwo_id'])->get();

	        foreach($users as $user)
	        {
		        // There will only be one user (hopefully), but we need to do this to retain the user as a Model
		        // Add the user's ID to the dataset
		        $data['user_id'] = $user->id;
		        $data['email'] = $user->email;
		        $data['include_rating_link'] = false;

		        // If this user is a Lead or Sub user on this IWO, include the link to rate the IWO
		        if($user->hasRole('Lead') || $user->hasRole('Sub'))
		        {
			        $data['include_rating_link'] = true;
		        }

		        $this->send($recipient, $data['subject'], "emails.manage.cancel", $data);
	        }

        }

        $job->delete();
    }

    //Send an email when an IWO is confirmed
    public function iwo_confirmed($job, $data)
    {
        $data['subject'] = "IWO: " . $data['iwo_title'] .  " (" . $data['iwo_ref'] . ") has been confirmed";

        foreach($data['recipient'] as $recipient)
        {
        	// get the User model from the current recipient's email address and the iwo_id
	        $users = User::where('email', '=', $recipient)->where('iwo_id', '=', $data['iwo_id'])->get();

	        foreach($users as $user)
	        {
	        	// There will only be one user (hopefully), but we need to do this to retain the user as a Model
		        // Add the user's ID to the dataset
		        $data['user_id'] = $user->id;
		        $data['email'] = $user->email;
		        $data['include_rating_link'] = false;

		        // If this user is a Lead or Sub user on this IWO, include the link to rate the IWO
		        if($user->hasRole('Lead') || $user->hasRole('Sub'))
		        {
			        $data['include_rating_link'] = true;
		        }

		        $this->send($recipient, $data['subject'], "emails.manage.confirm", $data);
	        }

        }

        $job->delete();
    }

	//Send an email when an IWO is confirmed
	public function rating_added($job, $data)
	{
		$data['subject'] = "IWO: " . $data['iwo_title'] .  " (" . $data['iwo_ref'] . ") - rating added";

		foreach($data['recipient'] as $recipient)
		{
			// get the User model from the current recipient's email address and the iwo_id
			$users = User::where('email', '=', $recipient)->where('iwo_id', '=', $data['iwo_id'])->get();

			foreach($users as $user)
			{
				// There will only be one user (hopefully), but we need to do this to retain the user as a Model
				// Add the user's ID to the dataset
				$data['user_id'] = $user->id;
				$data['email'] = $user->email;

				$this->send($recipient, $data['subject'], "emails.manage.rating_added", $data);
			}

		}

		$job->delete();
	}

    //Send an email when an IWO is un-confirmed
    public function iwo_unconfirmed($job, $data)
    {
        $data['subject'] = "IWO: " . $data['iwo_title'] .  " (" . $data['iwo_ref'] . ") has been unconfirmed";

        foreach($data['recipient'] as $recipient)
        {
            $this->send($recipient, $data['subject'], "emails.manage.unconfirm", $data);
        }

        $job->delete();
    }

    //Send an email when an IWO is un-confirmed
    public function iwo_note_added($job, $data)
    {
        $data['subject'] = "A note has been added to IWO: " . $data['iwo_title'] .  " (" . $data['iwo_ref'] . ")";

        foreach($data['recipient'] as $recipient)
        {
            $this->send($recipient, $data['subject'], "emails.manage.note_added", $data);
        }

        $job->delete();
    }

	//When an IWO will shortly expire, send an email to all users linked to the IWO
	public function iwo_expiry_notification($job, $data)
	{
		$data['subject'] = " IWO: " . $data['iwo_title'] .  " (" . $data['iwo_ref'] . ") will expire in 7 days";

		foreach($data['recipient'] as $recipient)
		{
			$this->send($recipient, $data['subject'], "emails.expire", $data);
		}

		$job->delete();
	}
}