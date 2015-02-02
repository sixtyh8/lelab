<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

	// Get POST value
	$name = cleanString($_POST["name"]);
	
	if($name != ""){
		// Initialize the new Genre object
		$obj = new Engineer();

		// Call addGenre
		$result = $obj->createEngineer($name);

	} else {
		echo("Empty fields");
	}

?>