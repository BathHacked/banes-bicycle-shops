<?php

	// Run this file to put *all* the data up every month

	// Socrata Engine
	require_once("socrata.php");

	// Your credentials
	$root_url = '';
	$app_token = '';
	$database_id = '';
	$username = '';
	$password = '';
	$response = NULL;
	$google_key = '';

	// Create a new authenticated client
	$socrata = new Socrata($root_url, $app_token, $username, $password);

	// Get the raw data from the source
	$raw_data = file_get_contents('https://maps.googleapis.com/maps/api/place/textsearch/json?query=bike%20shops+in+Bath%20and%20North%20East%20Somerset&key=' . $google_key);

	// Decode the data
	$decoded_data = json_decode($raw_data, true);

	// Create a blank array ready for the data
	$formatted_rows = array();

	// Loop through the decoded data
	foreach ($decoded_data['results'] as $data_row) {
		$formatted_row = array(
		  "place_id" => $data_row['place_id'],
		  "place_name" => $data_row['name'],
		  "address" => $data_row['formatted_address'], 
		  "rating" => $data_row['rating'], 
		  "location" => '(' . $data_row['geometry']['location']['lat'] . ',' . $data_row['geometry']['location']['lng'] . ')'
		);

		// Add the data to the array
		array_push($formatted_rows, $formatted_row);

		// Output something to the browser
		echo 'Getting data for ' . $data_row['name'] . '<br />';
	}

	// Re-encode the array as JSON and put it to Socrata
	$response = $socrata->put('/resource/' . $database_id, json_encode($formatted_rows));

	// Output some info to the browser
	echo '<br />Done!<br />';
  
?>