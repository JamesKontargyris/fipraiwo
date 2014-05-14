<?php
function get_max_upload_size($convert_to_mb = false)
{
	if($convert_to_mb)
	{
		return floor(Config::get('iwo_vars.max_upload_size') / 1048576); 
	}
	return Config::get('iwo_vars.max_upload_size'); 
}

function convert_to_kb($bytes, $add_kb = false)
{
	$kilobytes = round($bytes / 1024, 2);
	if($add_kb)
	{
		$kilobytes .= "kb";
	}
	return $kilobytes;	
}
function convert_to_mb($bytes, $add_mb = false)
{
	$megabytes = round($bytes / 1048576, 2);
	if($add_mb)
	{
		$megabytes .= "mb";
	}
	return $megabytes;
}

// Function to convert form input values into a user-friendly format
function pretty_input($input)
{
	// Words that should be lowercase in field names
	$field_lc = ['or', 'as', 'and', 'the', 'for', 'of'];
	// Upperclass versions to be replaced
	$field_uc = ['Or', 'As', 'And', 'The', 'For', 'Of'];
	
	foreach($input as $key => $value)
	{
		// VALUE CONVERSION
		// value not entered?
		if($input[$key] == '')
		{
			// set to a dash 
			$input[$key] = "-";
		} else {
			// Convert checkbox "on" values to "Yes"
			// (regular expression is used to avoid changing the word "on" in text)
			$input[$key] = preg_replace('/^on$/', "Yes", $input[$key]);
		}
		
		// KEY (field name) CONVERSION
		// Remove underscores, convert to title case, replace words that should be lowercase
		// and make first letter of string uppercase (in case it is marked as a word that should
		// be lowercase)
		$new_key = ucfirst(str_replace($field_uc, $field_lc, ucwords(str_replace('_', ' ', $key)))); 
		// Set a new key with the new tidy field name
		$input[$new_key] = $input[$key];
		// Delete the old duplicate key and value
		unset($input[$key]);
	}
	return $input;
}

function display_form_error($field_name, $errors)
{
	return $errors->first($field_name, '<div class="error"><i class="fa fa-caret-up"></i> :message</div>');
}

function display_submit_button($button_text)
{
	return View::make('forms.partials.submit_button')->with('button_text', $button_text);
}

function remove_spaces($string, $replacement = "")
{
	return str_replace(' ', $replacement, $string);
}