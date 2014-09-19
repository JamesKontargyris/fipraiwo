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
                // Add the necessary "value" and "label" fields and append to result set
                $found_ad['value'] = $ad['name'];
                $found_ad['email'] = $ad['email'];
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
        $spad_reps = Spad_rep::all()->toArray();

        // Cleaning up the term
        $term = trim(strip_tags($_GET['term']));

        // Rudimentary search
        $matches = [];
        foreach($spad_reps as $rep)
        {
            if(stripos($rep['spad'], $term) !== false)
            {
                // Add the necessary "value" and "label" fields and append to result set
                $found_rep['value'] = $rep['spad'];
                $found_rep['rep'] = $rep['rep'];
	            $found_rep['email'] = Spad_email::where('spad_name', '=', $rep['spad'])->pluck('spad_email');
                $found_rep['label'] = $rep['spad'] . " (" . $found_rep['email'] . ")";
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