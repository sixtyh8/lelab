<?php
    
require 'medoo.php';

// Or via independent configuration
$database = new medoo(array(
	'database_type' => 'sqlite',
	'database_file' => 'classes/lelab.db'
));

Flight::route('GET /genres', function(){
	$result = $database->select("genres", "*");
	return Flight::json($result);
});

Flight::route('POST /genres', function(){
	
	$string = Flight::request()->body;
	$genre = json_decode($string);
	$data = $genre->data;

	$obj = new Genre();
	$result = $obj->addGenre($data);

	$genre->id = $result;
	$genre->name = $data;

	return Flight::json($genre);
});

Flight::route('DELETE /genres/@id', function($id){
	$obj = new Genre();
	$result = $obj->deleteGenre($id);

	return Flight::json($result);
});

Flight::route('GET /genres/@id', function($id){
	$obj = new Genre();
	$result = $obj->getGenreName($id);

	return Flight::json($result);
});

Flight::route('PUT /genres', function(){
	$body = Flight::request()->body;

	$data = json_decode($body);

	$obj = new Genre();
	$result = $obj->updateGenre($data[0]);

	return Flight::json($result);
});

Flight::route('GET /genres/search', function(){
	$keyword = Flight::request()->query['keyword'];

	$obj = new Genre();
	$result = $obj->searchGenres($keyword);

	return Flight::json($result);
});
?>