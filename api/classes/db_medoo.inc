<?php

require  'medoo.min.php';

$db_path = realpath(dirname(__FILE__))."/lelab.db";

// Or via independent configuration
$database = new medoo(array(
	'database_type' => 'sqlite',
	'database_file' => 'lelab.db'
));

?>