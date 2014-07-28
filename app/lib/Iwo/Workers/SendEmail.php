<?php namespace Iwo\Workers;

use Iwo\Mailer\Mailer;


class SendEmail {

    private $mailer;

    function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    public function sendToLead($job, $data)
    {
        $this->mailer->sendTo([$data['lead_email']], $data['subject'], $data['view_lead'], $data);
        $job->delete();
    }

    public function sendToSub($job, $data)
    {
        $this->mailer->sendTo([$data['sub_email']], $data['subject'], $data['view_sub'], $data, $data['file_names']);
        $job->delete();
    }

    public function sendCopies($job, $data)
    {
        $this->mailer->sendTo($data['copies_email'], $data['subject'], $data['view_copies'], $data, $data['file_names']);
        $job->delete();
    }

}