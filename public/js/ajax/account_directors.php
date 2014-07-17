<?php

// Data could be pulled from a DB or other source
$account_directors = [
    ['name' => 'Mark McGann', 'email' => 'james.kontargyris@fipra.com'],
    ['name' => 'Laura Batchelor', 'email' => 'james.kontargyris@fipra.com'],
];

// Cleaning up the term
$term = trim(strip_tags($_GET['term']));

// Rudimentary search
$matches = array();
foreach($account_directors as $ad){
    if(stripos($ad['name'], $term) !== false){
        // Add the necessary "value" and "label" fields and append to result set
        $ad['value'] = $ad['name'];
        $ad['label'] = "{$ad['name']} ({$ad['email']})";
        $matches[] = $ad;
    }
}

// Truncate, encode and return the results
$matches = array_slice($matches, 0, 5);
print json_encode($matches);
