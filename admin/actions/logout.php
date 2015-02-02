<?php

require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

// Create Session object
$obj = new Session();
// Execute query
$obj->logout();

?>