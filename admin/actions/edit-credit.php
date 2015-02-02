<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

	// Credit array
	$creditObj =  array();

	// Get POST values and add to array
	$creditObj['creditID'] = $_POST["credit-id"];
	$creditObj['album-name'] = cleanString($_POST["album-name"]);
	$creditObj['artist-name'] = cleanString($_POST["artist-name"]);
	$creditObj['genre'] = cleanString($_POST["genre"]);
	$creditObj['year'] = cleanString($_POST["year"]);
	$creditObj['credit'] = cleanString($_POST["credit"]);
	$creditObj['extra-credit'] = cleanString($_POST["extra-credit"]);
	$creditObj['engineer-id'] = $_POST['engineer-id'];
	$creditObj['image-id'] = $_POST["image-id"];
	$creditObj['bandcamp-url'] = $_POST["bandcamp-url"];
	$creditObj['homepage-flag'] = $_POST["homepage-flag"];
	$creditObj['genre-id'] = "";

	// Add genre to genre DB if doesn't exist
	if($creditObj['genre'] != ""){
		// Initialize the new Genre object
		$genre = new Genre();
		$genreName = $creditObj['genre'];

		// Call checkGenre
		$result = $genre->checkGenre($genreName);

		// If it exists, get it's ID		
		if($result){
			$creditObj['genre-id'] = $result[0]['id'];
		} else {
			$lastID = $genre->addGenre($genreName);
			$creditObj['genre-id'] = $lastID;
		}

	}

	if($creditObj['creditID'] != ""){
		
		// Initialize the new Credit object
		$obj = new Credit();

		// Call createCredit
		$obj->updateCredit($creditObj);

	} else {
		echo("Empty fields");
	}
?>