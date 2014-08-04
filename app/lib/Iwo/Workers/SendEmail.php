<?php namespace Iwo\Workers;

use Iwo\Mailer\Mailer;


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
        $data['subject'] = "Your " . $data['form_type'] . " Internal Work Order was submitted";

        $this->send($data['recipient'], $data['subject'], "emails." . $data['iwo_key'] . ".lead", $data);

        $job->delete();
    }

    //When an IWO is created, send an email to the lead unit contact
    public function iwo_created_sub($job, $data)
    {
        $data['subject'] = $data['form_type'] . " Internal Work Order was submitted";

        $this->send($data['recipient'], $data['subject'], "emails." . $data['iwo_key'] . ".sub", $data);

        $job->delete();
    }

    //When an IWO is created, send an email to the lead unit contact
    public function iwo_auto_confirmed($job, $data)
    {
        $data['subject'] = $data['form_type'] . " Internal Work Order was submitted and confirmed (ref: " . $data['iwo_ref'] . ")";

        foreach($data['recipient'] as $recipient)
        {
            $this->send($recipient, $data['subject'], "emails.manage.auto_confirm", $data, $data['file_names']);
        }

        $job->delete();
    }

    //Send an email when an IWO is updated
    public function iwo_updated($job, $data)
    {
        $data['subject'] = "Internal Work Order " . $data['iwo_ref'] . " has been updated";

        foreach($data['recipient'] as $recipient)
        {
            $this->send($recipient, $data['subject'], "emails.manage.update", $data);
        }

        $job->delete();
    }

    //Send an email when an IWO is cancelled
    public function iwo_cancelled($job, $data)
    {
        $data['subject'] = "Internal Work Order " . $data['iwo_ref'] . " has been cancelled";

        foreach($data['recipient'] as $recipient)
        {
            $this->send($recipient, $data['subject'], "emails.manage.cancel", $data);
        }

        $job->delete();
    }

    //Send an email when an IWO is confirmed
    public function iwo_confirmed($job, $data)
    {
        $data['subject'] = "Internal Work Order " . $data['iwo_ref'] . " has been confirmed";

        foreach($data['recipient'] as $recipient)
        {
            $this->send($recipient, $data['subject'], "emails.manage.confirm", $data);
        }

        $job->delete();
    }

    //Send an email when an IWO is un-confirmed
    public function iwo_unconfirmed($job, $data)
    {
        $data['subject'] = "Internal Work Order " . $data['iwo_ref'] . " has been un-confirmed";

        foreach($data['recipient'] as $recipient)
        {
            $this->send($recipient, $data['subject'], "emails.manage.unconfirm", $data);
        }

        $job->delete();
    }

    //Send an email when an IWO is un-confirmed
    public function iwo_note_added($job, $data)
    {
        $data['subject'] = "A note was added to Internal Work Order " . $data['iwo_ref'];

        foreach($data['recipient'] as $recipient)
        {
            $this->send($recipient, $data['subject'], "emails.manage.note_added", $data);
        }

        $job->delete();
    }
}