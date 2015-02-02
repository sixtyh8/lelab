<?php
	require 'dbinfo.php';

	// Get POST variables
	$obj['name'] = $_POST["category-name"];
	$obj['parent_id'] = $_POST["category-parent"];

	if($obj['name'] !== ""){
		
		// Initialize the new Credit object
		$obj = new Category();

		// Call createCredit
		$obj->create($obj);

	} else {
		echo 'Empty field.';
	}
?>