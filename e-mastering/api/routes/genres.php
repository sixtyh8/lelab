<?php

Flight::route('GET /genres', function(){
	$obj = new Genre();
    $result = $obj->listGenres();

    return Flight::json($result);
});

Flight::route('POST /genres', function($name){
	$obj = new Genre();
	$result = $obj->addGenre($name);

	return Flight::json($result);
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