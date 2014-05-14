<?php namespace Iwo\Workers;

class DeleteUploads {

    public function fire($job, $files)
    {
    	foreach($files as $filename)
    	{
    		File::delete(Config::get('iwo_vars.upload_dir') . '/' . $filename);
    	}
        $job->delete();
    }
}