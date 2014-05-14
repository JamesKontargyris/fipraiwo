<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CleanUploadDirectory extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'uploaddir:clean';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Remove all files from the upload directory set in the iwo_vars config file.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$upload_dir = Config::get('iwo_vars.upload_dir');
		
		if($this->confirm('This will delete all files in ' . $upload_dir . '! Do you want to continue? [yes|no]'))
		{
			// Set up counters
			$deleted = 0;
			$file_count = 0;

			$files = glob($upload_dir . '/*'); // get all file names
			foreach($files as $file)
			{ // iterate files
				if(is_file($file)) // if it is a file...
				{
					// Add one to file count
				  	$file_count++;

				  	if($this->option('olderthan')) // if 'olderthan' option is set...
				  	{
				  		if(date("F d Y H:i:s", strtotime($this->option('olderthan'))) > date("F d Y H:i:s", filectime($file))) // if file is older than "olderthan" date...
						{
							unlink($file); // delete file
				    		$deleted++;		
						}
					}
				  	else // if 'olderthan' options isn't set...
				  	{
				  		unlink($file); // delete file
				    	$deleted++;	
				  	}
				}
			}
			// Present message
			$this->info("Upload directory cleaned. $deleted of $file_count files deleted.");
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('olderthan', null, InputOption::VALUE_OPTIONAL, 'Delete only files older than a certain date.'),
		);
	}

}
