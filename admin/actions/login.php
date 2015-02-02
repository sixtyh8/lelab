<?php

require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

// Get POST variables
$username = $_POST['username'];
$password = $_POST['password'];

// Create Session object
$sess = new Session();
// Execute query
$sess->login($username, $password);

?>