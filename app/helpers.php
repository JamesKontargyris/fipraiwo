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
	$field_lc = ['as', 'and', 'the', 'for', 'of'];
	// Uppercase versions to be replaced
	$field_uc = ['As', 'And', 'The', 'For', 'Of'];

    foreach($input as $key => $value)
    {
        //If the key is 'team', this is the multidimensional array
        //of people and rates. Use the pretty_team function to
        //make it look nice
        if($key == 'team')
        {
//            if this array key exists, it is the old model of fees entry
            if(array_key_exists('the_work_will_be_done', $input))
            {
                $input['Team'] = pretty_team_old($input['team']);

            }
            else
            {
//                Otherwise, it is the new model of fees entry
                $input['Team'] = pretty_team($input['team']);
            }
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

//Prettify the new fees model input
function pretty_team($team = [], $rate_type = 'Fipra day rate')
{
    $pretty_team  = "<table cellspacing='10' cellpadding='10' border='1'>";

    foreach($team as $member)
    {
        if(isset($member['person']) && $member['person'] != "")
        {
            if(isset($member['level']))
            {
//                This is the new style fees entry
                $friendly_levels = [
                    'account_director' => 'Account Director',
                    'account_manager' => 'Account Manager',
                    'account_executive' => 'Account Executive'
                ];

                $pretty_team .= "<tr>";
                $pretty_team .= "<td style='padding-right:20px'>" . $member['person'] . " (" .$friendly_levels[$member['level']] . ")</td>";

                if(isset($member['ratetype']) && $member['ratetype'] == 'dayrate')
                {
                    $days_plural = $member['days'] == 1 ? 'Day' : 'Days';
                    $per_month = isset($member['per-month']) ? ' per month' : ' in total';
                    $total_text = isset($member['per-month']) ? 'Total per month: ' : 'Total: ';
                    $pretty_team .= "<td style='padding-right:20px'>" . $member['days'] . " " . $days_plural . $per_month . "</td>";
                    $pretty_team .= "<td>" . $total_text . $member['persontotal'] . "</td>";
                } elseif(isset($member['ratetype']) && $member['ratetype'] == 'monthlyrate')
                {
                    $pretty_team .= "<td>&euro;" . remove_currency_symbol($member['monthlyrate']) . " (monthly rate)</td>";
                }
                else
                {
                    $pretty_team .= "<td>&euro;" . remove_currency_symbol($member['flatrate']) . " (project rate)</td>";
                }
                $pretty_team .= "</tr>";
            }
            else {
                // This is the old style fees entry
                if( ! isset($member['rate']) || $member['rate'] == '') $member['rate'] = 'N/A';
                $pretty_team .= "<tr>";
                $pretty_team .= "<td style='padding-right:20px'>" . $member['person'] . "</td><td>&euro;" . remove_currency_symbol($member['rate']) . "</td>";
                $pretty_team .= "</tr>";
            }

        }
    }

    $pretty_team .= "</table>";

    return $pretty_team;
}

//Prettify the old fees form input
function pretty_team_old($team = [])
{
    $pretty_team  = "<table cellspacing='10' cellpadding='10' border='1'>";
    foreach($team as $member)
    {
        if(isset($member['person']) && $member['person'] != "")
        {
            if( ! isset($member['rate']) || $member['rate'] == '') $member['rate'] = 'N/A';
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
    return date("Y-m-d H:i:s");
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

function get_fipra_reps()
{
    $reps = Rep_email::all();
    $rep_options = [];
    $rep_options[''] = 'Please select...';
    foreach($reps as $rep)
    {
        $rep_options[$rep->rep_name] = $rep->rep_name;
    }

    return $rep_options;
}

function get_all_units_for_dropdown()
{
    $units = Unit_lead_contact::get()->toArray();
    $options = ['' => 'Please select...'];

    foreach($units as $unit)
    {
        $options[$unit['unit_name']] = $unit['unit_name'];
    }

    return $options;
}