<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

	// Get POST value
	$columnName = $_POST["column-name"];
	$columnType = $_POST["column-type"];
	
	if($columnName != ""){
		// Initialize the new Genre object
		$obj = new Credit();

		// Call addGenre
		$result = $obj->addColumn($columnName, $columnTyoe);

	} else {
		echo("Empty fields");
	}

?>