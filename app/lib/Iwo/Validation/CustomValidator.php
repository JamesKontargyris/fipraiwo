<?php namespace Iwo\Validation;

class CustomValidator extends \Illuminate\Validation\Validator
{
	public function validateFileSize($attribute, $files, $parameters)
	{
		if(count(array_filter($files)) > 0)
		{
			$total = 0;
			foreach($files as $file)
			{
				$total = $total + $file->getSize();
			}
			return $total < \get_max_upload_size();
		}
		return true;
	}

    public function validateFutureDate($attribute, $value, $parameters)
    {
        if(isset($value))
        {
            $today = date_time_now();

            return date("Y-m-d h:i:s", strtotime($value)) > $today;
        }
    }
}