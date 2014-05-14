<?php namespace Iwo\FileUpload;

use Illuminate\Support\ServiceProvider;

class FileUploadServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('FileUpload', function()
        {
            return new FileUpload;
        });
    }

}