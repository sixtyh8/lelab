<?php

session_start();

// Get current page
$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);
$currentPage = $parts[count($parts) - 1];
$flag = true;

// Session exceptions
if($currentPage == 'login.php'){
	$flag = false;
}

// Checking for valid session
if(!(isset($_SESSION['username'])) && $flag){
	header("Location: login.php");
}

?>