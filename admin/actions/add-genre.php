<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

	// Get POST value
	$genreName = cleanString($_POST["genre-name"]);
	
	if($genreName != ""){
		// Initialize the new Genre object
		$obj = new Genre();

		// Call addGenre
		$result = $obj->addGenre($genreName);

	} else {
		echo("Empty fields");
	}

?>