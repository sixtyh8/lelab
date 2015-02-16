<?php

Flight::route('GET /genres', function(){

	$result = Flight::get('database')->select("genres", "*");
	
	return Flight::json($result);
});

Flight::route('POST /genres', function(){
	
	$string = Flight::request()->body;
	$genre = json_decode($string);
	$data = $genre->data;

	$genreName = ucword($data);

	$result = Flight::get('database')->insert("genres", array('name' => $genreName));

	$genre->id = $result;
	$genre->name = $data;

	return Flight::json($genre);
});

Flight::route('DELETE /genres/@id', function($id){
	
	$result = Flight::get('database')->delete("genres", array('id' => $id));
	
	return Flight::json($result);
});

Flight::route('GET /genres/@id', function($id){
	
	$result = Flight::get('database')->select("genres", "*", array('id' => $id));
	
	return Flight::json($result);
});

Flight::route('PUT /genres', function(){
	$body = Flight::request()->body;

	$data = json_decode($body)[0];
	
	$name = $data->name;
	$id = $data->id;

	$result = Flight::get('database')->update("genres", array('name' => $name), array('id' => $id));

	return Flight::json($result);
});

Flight::route('GET /genres/search', function(){

	$keyword = Flight::request()->query['keyword'];
	$result = Flight::get('database')->select("genres", "*", array('name[~]' => $keyword));
	
	return Flight::json($result);
});
?>