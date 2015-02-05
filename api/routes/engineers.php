<?php

Flight::route('GET /engineers', function(){
	$obj = new Engineer();
	$result = $obj->listEngineers();

	return Flight::json($result);
});

// Add engineer
Flight::route('POST /engineers', function(){

	$string = Flight::request()->body;
	$engineer = json_decode($string);
	$data = $engineer->data;

	$obj = new Engineer();
	$result = $obj->createEngineer($data);

	$engineer->id = $result;
	$engineer->name = $data;

	return Flight::json($engineer);
});

// Get engineer name
Flight::route('GET /engineers/@id', function($id){
	$obj = new Engineer();
	$result = $obj->getEngineerName($id);

	return Flight::json($result);
});

// Update engineer
Flight::route('PUT /engineers', function(){
	$body = Flight::request()->body;

	$data = json_decode($body);

	$obj = new Engineer();
	$result = $obj->updateEngineer($data[0]);

	return Flight::json($result);
});

// Delete engineer
Flight::route('DELETE /engineers/@id', function($id){
	$obj = new Engineer();
	$result = $obj->deleteEngineer($id);

	return Flight::json($result);
});

?>