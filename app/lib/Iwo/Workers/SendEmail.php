<?php namespace Iwo\Workers;

use Iwo\Mailer\Mailer;


class SendEmail {

    private $mailer;

    function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    public function sendToLeadUnit($job, $data)
    {
        $this->mailer->sendTo([$data['email']], $data['subject'], $data['view_lead-unit'], $data);
        $job->delete();
    }

    public function sendToSubUnit($job, $data)
    {
        $this->mailer->sendTo([$data['sub_email']], $data['subject'], $data['view_sub-unit'], $data, $data['file_names']);
        $job->delete();
    }

    public function sendCopies($job, $data)
    {
        $this->mailer->sendTo($data['copies_email'], $data['subject'], $data['view_copies'], $data, $data['file_names']);
        $job->delete();
    }

}