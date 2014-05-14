<?php namespace Iwo\Workers;

class SendEmail {

    public function sendToUser($job, $data)
    {
        $mailer = \App::make('Mailer');
        $mailer->sendTo([$data['registered_email']], $data['subject_user'], $data['view_user'], $data);
        $job->delete();
    }

    public function sendCopies($job, $data)
    {
        $mailer = \App::make('Mailer');
        $mailer->sendTo($data['addresses'], $data['subject_copy'], $data['view_copy'], $data, $data['file_names']);
        $job->delete();
    }

}