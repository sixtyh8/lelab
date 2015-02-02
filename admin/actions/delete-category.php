<?php

	require 'dbinfo.php';

	// Get Category ID
	$categoryID = $_GET['categoryID'];

	$db = sqlite_open($dbname, 0777, $err);

	if($err) die($err);

	$query = sqlite_query($db, "delete from $categoryTable where id='$categoryID'");
	
	sqlite_close($db);
	
?>