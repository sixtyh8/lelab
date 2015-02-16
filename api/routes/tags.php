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

	$string = Flight::request()->body;

	$tag = json_decode($string);
	$data = $tag->data;

	$result = Flight::get('database')->insert("tags", array('name' => $data));

	$tag->id = $result;
	$tag->name = $data;

	return Flight::json($tag);
});

// Update tag
Flight::route('PUT /tags', function(){
	
	$string = Flight::request()->body;

	$tag = json_decode($string);
	$tagObj = $tag[0];

	$name = $tagObj->name;
	$id = $tagObj->id;

	$result = Flight::get('database')->update('tags', array('name' => $name), array('id' => $id));

	return Flight::json($result);
});

// Delete tag
Flight::route('DELETE /tags/@id', function($id){
    
	$result = Flight::get('database')->delete('tags', array('id' => $id));

	return Flight::json($result);
});

?>