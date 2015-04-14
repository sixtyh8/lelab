<?php

Flight::route('GET /trophies', function(){

	$result = Flight::get('database')->select("trophies", "*", array('ORDER' => 'name'));
	
	return Flight::json($result);

});

Flight::route('POST /trophies', function(){
	
	$string = Flight::request()->body;
	$trophy = json_decode($string);
	
	$data = $trophy->data;
	$name = $data->name;
	$type = $data->type;
	$description = $data->description;
	$id = $trophy->id;
	$action = $trophy->action;

	if($action == 'POST'){

		$trophyName = ucwords($name);


		$result = Flight::get('database')->insert("trophies", array('trophy_name' => $trophyName, 'trophy_type' => $type, 'trophy_description' => $description));

		// $genre->id = $result;
		// $genre->name = $data;

		return Flight::json($result);

	} else if($action == 'PUT'){

		$trophyName = ucwords($name);

		$result = Flight::get('database')->update("trophies", array('trophy_name' => $trophyName, 'trophy_type' => $type, 'trophy_description' => $description), array('id' => $id));

		return Flight::json($result);

	} else if($action == 'DELETE') {
		
		$result = Flight::get('database')->delete("trophies", array('trophy_id' => $id));
	
		return Flight::json($result);

	}

});

Flight::route('GET /trophies/@id', function($id){
	
	$result = Flight::get('database')->select("trophies", "*", array('trophy_id' => $id));
	
	return Flight::json($result);
});

?>