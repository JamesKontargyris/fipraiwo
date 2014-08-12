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
	// Uppercase versions to be replaced
	$field_uc = ['Or', 'As', 'And', 'The', 'For', 'Of'];

    foreach($input as $key => $value)
    {
        //If the key is 'team', this is the multidimensional array
        //of people and rates. Use the pretty_team function to
        //make it look nice
        if($key == 'team')
        {
            $input['Team Members and Rates'] = pretty_team($input['team']);
            //Remove the old team form data
            unset($input['team']);
            //Continue with the foreach loop
            continue;
        }
        //If the value is an array of values (and it isn't the team array),
        //convert to a string of comma separated values
        elseif(is_array($value) && $key != 'team')
        {
            $input[$key] = substr(implode(", ", $value), 0, -2);
        }

        // VALUE CONVERSION
		// value not entered?
		elseif(trim($input[$key]) == '')
        {
            // set to a dash
            $input[$key] = "-";
        }
        else
        {
			// Convert checkbox "on" values to "Yes"
			// (regular expression is used to avoid changing the word "on" in text)
			$input[$key] = preg_replace('/^on$/', "Yes", $input[$key]);
		}
		
		// KEY (field name) CONVERSION
        // Remove underscores, convert to title case, replace words that should be lowercase
        // and make first letter of string uppercase (in case it is marked as a word that should
        // be lowercase)
        $new_key = trim(ucfirst(str_replace($field_uc, $field_lc, ucwords(str_replace('_', ' ', $key)))));
		// Set a new key with the new tidy field name
		$input[$new_key] = trim($input[$key]);
		// Delete the old duplicate key and value
		unset($input[$key]);
	}

    return $input;
}

function pretty_team($team = [])
{
    $pretty_team  = "<table cellspacing='10' cellpadding='10' border='1'>";

    foreach($team as $member)
    {
        if($member['person'] != "" or $member['rate'] != "")
        {
            $pretty_team .= "<tr>";
            $pretty_team .= "<td style='padding-right:20px'>" . $member['person'] . "</td><td>&euro;" . remove_currency_symbol($member['rate']) . "</td>";
            $pretty_team .= "</tr>";
        }
    }

    $pretty_team .= "</table>";

    return $pretty_team;
}

function remove_currency_symbol($string)
{
    $symbols = ['€', '$', '£'];
    return str_replace($symbols, '', $string);
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

function email_addresses_to_array($recipients = array())
{
    $addresses = [];
    foreach($recipients as $recipient) { $addresses[] = $recipient->email; }
    return $addresses;
}

function date_time_now()
{
    return date("Y-m-d h:i:s");
}

function editing()
{
    //If we are on the edit page or the confirm updates page of the manage section,
    //and this is not a post request on the edit page (i.e. validation errors), return true
    if(Request::path() == "manage/edit" && ! Request::isMethod('post') || Request::path() == "manage/confirmupdates")
    {
        return true;
    }
    //Otherwise, this is not an edit page
    return false;
}

function update_iwo_ref($ref)
{
    if( ! ctype_digit($ref))
    {
        $last_letter = substr($ref, -1);
        $new_ref = substr($ref, 0, -1);
        ++$last_letter;
        $new_ref .= $last_letter;
    }
    else
    {
        $new_ref = $ref . 'a';
    }

    return $new_ref;
}

function get_original_ref($ref)
{
    return preg_replace("/[^0-9,.]/", "", $ref);
}