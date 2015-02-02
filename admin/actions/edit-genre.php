<?php

	require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

	// Credit array
	$genreObj =  array();

	// Get POST values and add to array
	$genreObj['name'] = cleanString($_POST["value"]);
	$genreObj['id'] = $_POST["pk"];

	if($genreObj['name'] != "" && $genreObj['id'] != ""){
		
		// Initialize the new Credit object
		$obj = new Genre();

		// Call createCredit
		$obj->updateGenre($genreObj);

	}
	
?>