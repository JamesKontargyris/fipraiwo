<?php namespace Iwo\FileUpload;

use \Input;
use \Config;

class FileUpload
{
	// An array of file objects taken from the field name passed in
	protected $files;
	// Upload path set in the iwo_vars config file
	protected $upload_path;
	// An array of current file names
	protected $current_file_names = array();
	// An array of new file names after space replacement if required
	protected $new_file_names = array();
	// character to use in place of spaces if running space replacement on file name
	protected $space_replacement = '_';
	// remove spaces from file name? (true/false)
	protected $remove_spaces = true;

	public function __construct()
	{
		$this->upload_path = Config::get('iwo_vars.upload_dir');
	}

	// Upload files to the upload directory
	public function upload_files($files)
	{
		// Assign the incoming files objects to $this->files.
		$this->set_files($files);
		
		// Iterate through all files
		foreach($this->files as $file)
		{
			// If an UploadFile object exists, move the file to the upload folder
			if($file)
			{
				// Move the file and put the returned new file name in $new_file_name
				if($new_file_name = $this->move_file($file))
				{
					// Add the new file name to the class' $new_file_name variable
					// with the key field name as a key
					$this->current_file_names[] = $this->get_original_name($file);
					$this->new_file_names[] = $new_file_name;
				}
				else
				{
					// Problem uploading - throw exception
					throw new FileUploadException('File upload failed', $this->getErrors());
				}
			}
		}
		// When all files have been iterated through, return an array containing all current file names and all new space replaced (if chosen) file names
		return array('current_file_names' => $this->current_file_names, 'new_file_names' => $this->new_file_names);
	}

	// Ensure $this->files is an array of objects
	protected function set_files($files)
	{
		$this->files = (array) $files;
		return true;
	}

	// Check if any files exist in the input array for the fields provided
	public function has_files()
	{
		return count(array_filter($this->files));
	}

	public function get_files_info()
	{
		return $this->files;
	}

	protected function get_original_name($file)
	{
		return $file->getClientOriginalName();
	}

	// Move uploaded files to the upload directory
	protected function move_file($file)
	{
		$new_file_name = $this->remove_spaces ? remove_spaces($this->get_original_name($file), '_') : $this->get_original_name($file);
		if($file->move($this->upload_path, $new_file_name))
		{
			return $new_file_name;
		}
		return false;
	}

	

	// Return an error message if an error was encountered.
	public function getErrors()
	{
		return 'There was a problem uploading your file(s). Please try again.';
	}
}