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
        $job->delete();
    }

    //When an IWO is created, send an email to the lead unit contact
    public function iwo_created_lead($job, $data)
    {
        $subject = "Your " . $data['form_type'] . " Internal Work Order was submitted (ref " . $data['iwo_ref'] . ")";

        $this->send($data['recipient'], $subject, "emails.$iwo_key.lead", $data);

        $job->delete();
    }

    //When an IWO is created, send an email to the lead unit contact
    public function iwo_created_sub($job, $data)
    {
        $subject = $data['form_type'] . " Internal Work Order was submitted (ref " . $data['iwo_ref'] . ")";

        $this->send($data['recipient'], $subject, "emails.$iwo_key.sub", $data);

        $job->delete();
    }

    //When an IWO is created, send an email to the lead unit contact
    public function iwo_auto_confirmed($job, $data)
    {
        $subject = $data['form_type'] . " Internal Work Order was submitted and confirmed (ref " . $data['iwo_ref'] . ")";

        foreach($data['recipient'] as $recipient)
        {
            $this->send($recipient, $subject, "emails.manage.auto_confirm", $data);
        }

        $job->delete();
    }

    //Send an email when an IWO is updated
    public function iwo_updated($job, $recipients = [], $iwo_key, $iwo_ref, $data = [])
    {
        foreach($recipients as $recipient)
        {
            $this->send($recipient, "Internal Work Order $iwo_ref has been updated", "emails.manage.update", $data);
        }

        $job->delete();
    }

    //Send an email when an IWO is cancelled
    public function iwo_cancelled($job, $recipients = [], $iwo_key, $iwo_ref, $data = [])
    {
        foreach($recipients as $recipient)
        {
            $this->send($recipient, "Internal Work Order $iwo_ref has been cancelled", "emails.manage.cancel", $data);
        }

        $job->delete();
    }

    //Send an email when an IWO is confirmed
    public function iwo_confirmed($job, $recipients = [], $iwo_key, $iwo_ref, $data = [])
    {
        foreach($recipients as $recipient)
        {
            $this->send($recipient, "Internal Work Order $iwo_ref has been confirmed", "emails.manage.confirm", $data);
        }

        $job->delete();
    }

    //Send an email when an IWO is un-confirmed
    public function iwo_unconfirmed($job, $recipients = [], $iwo_key, $iwo_ref, $data = [])
    {
        foreach($recipients as $recipient)
        {
            $this->send($recipient, "Internal Work Order $iwo_ref has been un-confirmed", "emails.manage.unconfirm", $data);
        }

        $job->delete();
    }
}