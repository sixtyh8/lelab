<?php

	require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

	$engi = $_GET['engiID'];
	$obj = new Engineer();
	$obj->deleteEngineer($engi);
	
?>