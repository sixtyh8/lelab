<?php
// List Engineers
Flight::route('GET /engineers', function(){

	$result = Flight::get('database')->select('engineers', '*');

	return Flight::json($result);
});

// Add/Update/Delete Engineer
Flight::route('POST /engineers', function(){

	$string = Flight::request()->body;
	$engineer = json_decode($string);
	$data = $engineer->data;
	$id = $engineer->id;
	$action = $engineer->action;

	if($action == 'POST'){

		$result = Flight::get('database')->insert('engineers', array('name' => $data));

		$engineer->id = $result;
		$engineer->name = $data;

		return Flight::json($engineer);

	} else if($action == 'PUT'){

		$name = $data->name;

		$result = Flight::get('database')->update('engineers', array('name' => $name), array('id' => $id));

		return Flight::json($result);

	} else if($action == 'DELETE'){

		$result = Flight::get('database')->delete('engineers', array('id' => $id));

		return Flight::json($result);

	}

	
});

// Get Engineer Name
Flight::route('GET /engineers/@id', function($id){
	
	$result = Flight::get('database')->select('engineers', '*', array('id' => $id));

	return Flight::json($result);
});

?>