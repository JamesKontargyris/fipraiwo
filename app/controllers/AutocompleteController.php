<?php


class AutocompleteController extends BaseController
{
    public function account_directors()
    {
        $account_directors = Account_director::all()->toArray();

        // Cleaning up the term
        $term = trim(strip_tags($_GET['term']));

        // Rudimentary search
        $matches = [];
        foreach($account_directors as $ad)
        {
	        if(stripos($ad['name'], $term) !== false)
	        {
		        $ad_copy_contacts = implode(', ', Account_directors_contact::where('account_director_name', '=', $ad['name'])->lists('copy_email'));

		        // Add the necessary "value" and "label" fields and append to result set
                $found_ad['value'] = $ad['name'];
                $found_ad['email'] = $ad['email'];
		        $found_ad['copy_contacts'] = $ad_copy_contacts;
                $found_ad['label'] = $ad['name'] . " (" . $ad['email'] . ")";
                $matches[] = $found_ad;
            }
        }

        // Truncate, encode and return the results
        $matches = array_slice($matches, 0, 5);
        return json_encode($matches);
    }

    public function unit_reps()
    {
        $unit_reps = Unit_rep::all()->toArray();

        // Cleaning up the term
        $term = trim(strip_tags($_GET['term']));

        // Rudimentary search
        $matches = [];
        foreach($unit_reps as $rep)
        {
            if(stripos($rep['fipra_unit'], $term) !== false)
            {
                // Add the necessary "value" and "label" fields and append to result set
                $found_rep['value'] = $rep['fipra_unit'];
                $found_rep['rep'] = $rep['rep'];
                $found_rep['label'] = $rep['fipra_unit'];
                $matches[] = $found_rep;
            }
        }

        // Truncate, encode and return the results
        $matches = array_slice($matches, 0, 5);
        return json_encode($matches);
    }

    public function spad_reps()
    {
//        Changed to use Spad_email table rather than Spad_rep for better functionality
        $spads = Spad_email::all()->toArray();

        // Cleaning up the term
        $term = trim(strip_tags($_GET['term']));

        // Rudimentary search
        $matches = [];
        foreach($spads as $spad)
        {
            if(stripos($spad['spad_name'], $term) !== false)
            {
                // Add the necessary "value" and "label" fields and append to result set
                $found_rep['value'] = $spad['spad_name'];
                $found_rep['rep'] = Spad_rep::where('spad', '=', $spad['spad_name'])->pluck('rep');
	            $found_rep['email'] = Spad_email::where('spad_name', '=', $spad['spad_name'])->pluck('spad_email');
                $found_rep['label'] = $spad['spad_name'] . " (" . $found_rep['email'] . ")";
                $matches[] = $found_rep;
            }
        }

        // Truncate, encode and return the results
        $matches = array_slice($matches, 0, 5);
        return json_encode($matches);
    }

	public function unit_lead_contacts_and_reps()
	{
		$unit_lead_contacts = Unit_lead_contact::all()->toArray();

		// Cleaning up the term
		$term = trim(strip_tags($_GET['term']));

		// Rudimentary search
		$matches = [];
		foreach($unit_lead_contacts as $contact)
		{
			if(stripos($contact['unit_name'], $term) !== false)
			{
				// Add the necessary "value" and "label" fields and append to result set
				$found_unit['value'] = $contact['unit_name'];
				$found_unit['name'] = $contact['lead_contact_name'];
				$found_unit['email'] = $contact['email'];
				$found_unit['rate_band'] = $contact['rate_band'];
				$found_unit['rep'] = Unit_rep::where('fipra_unit', '=', $contact['unit_name'])->pluck('rep');
				$found_unit['label'] = $contact['unit_name'];
				$matches[] = $found_unit;
			}
		}

		// Truncate, encode and return the results
		$matches = array_slice($matches, 0, 5);
		return json_encode($matches);
	}
} 