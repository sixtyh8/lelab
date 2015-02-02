<?php

	require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

	$genreID = $_GET['genreID'];
	$obj = new Genre();
	$obj->deleteGenre($genreID);
	
?>