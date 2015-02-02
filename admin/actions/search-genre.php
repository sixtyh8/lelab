<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

	// Get POST value
	$keyword = $_GET["data"];

	if($keyword != ""){
		// Initialize the new Genre object
		$obj = new Genre();

		// Call searchGenre with the keyword
		$result = $obj->searchGenres($keyword);

		$returnData = array();

		foreach ($result as $genre){
			array_push($returnData, $genre['name']);
		}

		// Return a json object containing the results
		echo json_encode($returnData);

	} else {
		echo("Empty fields");
	}
	

?>