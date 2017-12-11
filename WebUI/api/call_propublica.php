<?php

	// This file contains the $apiKey obtained via ProPublica
	include_once("config.php");

	$name = $_GET["name"];
	$id = $_GET["id"];
	$all = $_GET["all"];
	$repull = $_GET["repull"];

	// TODO: We should do something smarter than repull these values every time.
	$repull = true;

	// The files that we will be writing the member data to
	$senateFile = 'senateMembers.txt';
	$houseFile = 'houseMembers.txt';

	// ProPub endpoints for 
	$senateEndpoint = "https://api.propublica.org/congress/v1/115/senate/members.json";
	$houseEndpoint = "https://api.propublica.org/congress/v1/115/house/members.json";

	if ($repull){
			
		// echo ("repull</br>");

		// Options necessary for accessing the ProPub endpoint
		$opts = array(
			'http'=>array(
				'method'=>'GET',
				'header'=>  "Accept-language: en\r\n" .
					"X-API-Key: " . $apiKey
			)
		);

		$context = stream_context_create($opts);

		// Getting the senate and house data from the ProPub endpoint
		$senateData = file_get_contents($senateEndpoint,false,$context);
		$houseData = file_get_contents($houseEndpoint,false,$context);
		
		// Grabbing just the member data from the ProPub data
		$senateMembers = json_decode($senateData, true)['results'][0]['members'];
		$houseMembers = json_decode($houseData, true)['results'][0]['members'];

		// Creating/Opening files and storing the member objects, closing
		$senateHandle = fopen($senateFile, 'w') or die ('Fatal error: Cannot open API output');
		fwrite($senateHandle, serialize($senateMembers));
		fclose($senateHandle);

		$houseHandle = fopen($houseFile, 'w') or die ('Fatal error: Cannot open API output');
		fwrite($houseHandle, serialize($houseMembers));
		fclose($houseHandle);

	}

	// Checking what we are supposed to be returning
	// TODO: return values for a specific ID, this should certainly use a better
	// 	search than a basic loop, esp identifying which file we should look at.
	if ($id){
		echo ("id = " . $id . "</br>");
	}else if ($name){

		// Open the members file, look at each member, compare to requested, 
		// 	return the data for the matching member, close the file
		$senateHandle = fopen($senateFile, 'r');
		$senateMembers = unserialize(fread($senateHandle,filesize($senateFile)));

		// TODO: Do something smarter here for the search
		foreach ($senateMembers as $member){
			$memberName = strtolower($member['first_name'].$member['last_name']);
			if ($name == $memberName){
				echo (json_encode($member));
				return;
			}
		}
		fclose($senateHandle);

		$houseHandle = fopen($houseFile, 'r');
		$houseMembers = unserialize(fread($houseHandle,filesize($houseFile)));
		foreach ($houseMembers as $member){
			$memberName = strtolower($member['first_name'].$member['last_name']);
			if ($name == $memberName){
				echo (json_encode($member));
				return;
			}
		}
		fclose($senateHandle);

	}else if($all){
		// TODO: Fetch all for the UI to be able to pre-populate the suggestions
		echo ("doemall!" . "</br>");
	}



?>