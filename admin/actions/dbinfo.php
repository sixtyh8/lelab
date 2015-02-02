<?php

global $dbname;

// DB information
$dbname = $_SERVER['DOCUMENT_ROOT']."/admin/data/lelab.db";
$whitepaperTable = "whitepaper";
$categoryTable = "category";
$creditTable = "credit";
$trophyTable = "trophy";
$userTable = "users";

try
{
  	//create or open the database
	$db = sqlite_open($dbname, 0777, $err);

}
catch(Exception $e)
{
  	die($e);
}


?>