<?php

Flight::route('GET /genres', function(){

	$result = Flight::get('database')->select("genres", "*", array('ORDER' => 'name'));
	
	return Flight::json($result);

});

Flight::route('POST /genres', function(){
	
	$string = Flight::request()->body;
	$genre = json_decode($string);
	
	$data = $genre->data;
	$id = $genre->id;
	$action = $genre->action;

	if($action == 'POST'){

		$genreName = ucwords($data);

		$result = Flight::get('database')->insert("genres", array('name' => $genreName));

		$genre->id = $result;
		$genre->name = $data;

		Flight::createGenreJson();

		return Flight::json($genre);

	} else if($action == 'PUT'){

		$name = $data->name;

		$result = Flight::get('database')->update("genres", array('name' => $name), array('id' => $id));

		Flight::createGenreJson();

		return Flight::json($result);

	} else if($action == 'DELETE') {
		
		$result = Flight::get('database')->delete("genres", array('id' => $id));

		Flight::createGenreJson();
	
		return Flight::json($result);

	}

});

Flight::route('GET /genres/@id', function($id){
	
	$result = Flight::get('database')->select("genres", "*", array('id' => $id));
	
	return Flight::json($result);
});

Flight::route('GET /genres/search', function(){

	$keyword = Flight::request()->query['keyword'];
	$result = Flight::get('database')->select("genres", "*", array('name[~]' => $keyword));
	
	return Flight::json($result);
});

?>