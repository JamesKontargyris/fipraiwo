<?php namespace Iwo\Mailer;

use Illuminate\Support\ServiceProvider;

class MailerServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('Mailer', function()
        {
            return new Mailer;
        });
    }

}