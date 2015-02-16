<?php

Flight::route('GET /tags', function(){
	$result = $database->select("tags", "*");
	return Flight::json($result);
});

Flight::route('GET /tags/@id', function($id){
	// Initialize the new Tag object
	$obj = new Tag();

	// Call getOne()
	$result = $obj->getTag($id);

	return Flight::json($result);
});

Flight::route('POST /tags', function(){

	$string = Flight::request()->body;

	$tag = json_decode($string);
	$data = $tag->data;

	// Initialize the new Tag object
	$obj = new Tag();

	// Call create()
	$result = $obj->create($data);

	$tag->id = $result;
	$tag->name = $data;

	return Flight::json($tag);
});

// Update tag
Flight::route('PUT /tags', function(){
	
	$string = Flight::request()->body;

	$tag = json_decode($string);
	$tagObj = $tag[0];

	$obj = new Tag();
	$result = $obj->update($tagObj);

	return Flight::json($result);
});

Flight::route('DELETE /tags/@id', function($id){
    
	$obj = new Tag();
	$result = $obj->delete($id);

	return Flight::json($result);
});

?>