<?php
	// phpinfo();

	$db = new PDO('sqlite:api/classes/lelab.db');

	$obj = $db->query('SELECT * FROM credits ORDER BY id');
	$results = $obj->fetchAll();

	print_r($results);
?>