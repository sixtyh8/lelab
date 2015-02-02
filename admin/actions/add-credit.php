<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

	// Credit array
	$creditObj =  array();

	// Get POST values and add to array
	$creditObj['album-name'] = cleanString($_POST["album-name"]);
	$creditObj['artist-name'] = cleanString($_POST["artist-name"]);
	//$creditObj['genre'] = cleanString($_POST["genre"]);
	$creditObj['year'] = cleanString($_POST["year"]);
	$creditObj['credit'] = cleanString($_POST["credit"]);
	$creditObj['engineer-id'] = $_POST['engineer-id'];
	$creditObj['credit2'] = cleanString($_POST["credit2"]);
	$creditObj['engineer-id2'] = $_POST["engineer-id2"];
	$creditObj['credit3'] = cleanString($_POST["credit3"]);
	$creditObj['engineer-id3'] = $_POST["engineer-id3"];
	$creditObj['credit4'] = cleanString($_POST["credit4"]);
	$creditObj['engineer-id4'] = $_POST["engineer-id4"];
	$creditObj['credit5'] = cleanString($_POST["credit5"]);
	$creditObj['engineer-id5'] = $_POST["engineer-id5"];
	$creditObj['image-id'] = $_POST["image-id"];
	$creditObj['bandcamp-url'] = $_POST["bandcamp-url"];
	$creditObj['homepage-flag'] = $_POST["homepage-flag"];
	$creditObj['genre-id'] = "";

	// Add genre to genre DB if doesn't exist
	if($_POST["genre"] != ""){
		// Initialize the new Genre object
		$genre = new Genre();
		$genreName = cleanString($_POST["genre"]);

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

	if($creditObj['album-name'] != "" || $creditObj['artist-name'] != "" || $creditObj['engineer-id'] != "" || $creditObj['year'] != "" || $creditObj['genre-id'] != "" || $creditObj['credit'] != ""){
		// Initialize the new Credit object
		$obj = new Credit();

		// Call createCredit
		$obj->createCredit($creditObj);
	} else {
		echo("Empty fields");
	}
	
?>