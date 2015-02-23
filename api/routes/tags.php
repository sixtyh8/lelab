<?php

// Get all tags
Flight::route('GET /tags', function(){
	
	$result = Flight::get('database')->select("tags", "*");
	
	return Flight::json($result);
	
});

// Get tag
Flight::route('GET /tags/@id', function($id){

	$result = Flight::get('database')->select("tags", "*", array('id' => $id));

	return Flight::json($result);

});

// Create tag
Flight::route('POST /tags', function(){
    $database = Flight::get('database');

	$string = Flight::request()->body;

	$tag = json_decode($string);
	$action = $tag->action;
	$data = $tag->data;

	if($action == 'POST'){

		$result = $database->insert("tags", array('name' => $data));

		$tag->id = $result;
		$tag->name = $data;

		return Flight::json($tag);
		
	} else if($action == 'PUT'){

		$id = $tag->id;

		$result = $database->update('tags', array('name' => $data), array('id' => $id));

		return Flight::json($result);
		
	} else if($action == 'DELETE'){

		$id = $tag->id;
		
		$result = $database->delete('tags', array('id' => $id));

		return Flight::json($result);
		
	}
	
});

?>