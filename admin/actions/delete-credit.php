<?php

	require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

	$creditID = $_GET['creditID'];
	$obj = new Credit();
	$obj->deleteCredit($creditID);
	
?>