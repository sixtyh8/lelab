<?php

	require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

	// Credit array
	$engiObj =  array();

	// Get POST values and add to array
	$engiObj['name'] = cleanString($_POST["value"]);
	$engiObj['id'] = $_POST["pk"];

	if($engiObj['name'] != "" && $engiObj['id'] != ""){
		
		// Initialize the new Credit object
		$obj = new Engineer();

		// Call createCredit
		$obj->updateEngineer($engiObj);

	}
	
?>