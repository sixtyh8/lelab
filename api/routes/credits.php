<?php

Flight::route('GET /credits', function(){
	$database = Flight::get('database');

	$total = $database->count('credits');
	$limit = Flight::request()->query->limit;
	$offset = Flight::request()->query->offset;

	if($limit && $total){
		if($total > $offset){
	    	$result = $database->select('credits', '*', array('LIMIT' => array($offset, $limit), 'ORDER' => 'id DESC'));
	    	$response = Flight::formatCredit($result);
	    } else {
	    	$response = new stdClass();
	    	$response->message = 'done';
	    	$response->total = $total;
	    }
	} else {
		$result = $database->select('credits', '*');
	    $response = Flight::formatCredit($result);
	}

    return Flight::json($response);
});

Flight::route('GET /credits/search', function(){
	
	$keyword = Flight::request()->query->keyword;
    $result = Flight::get('database')->select('credits', '*', array('OR' => array('album_name[~]' => $keyword, 'artist_name[~]' => $keyword, 'year[~]' => $keyword)));
    $response = Flight::formatCredit($result);

    return Flight::json($response);

});

// Post new credit
Flight::route('POST /credits', function(){

	$database = Flight::get('database');
	$string = Flight::request()->body;

	$credit = json_decode($string);
	$data = $credit->data;
	$id = $credit->id;
	$action = $credit->action;

	if($action == 'POST' || $action == 'PUT'){

		if(!property_exists($data, "image_id")){
			$data->image_id = null;
		}

		if(!property_exists($data, "bandcamp_url")){
			$data->bandcamp_url = null;
		}

		if(!property_exists($data, "genre_id")){
			$data->genre_id = null;
		}

		$album_name = $data->album_name;
		$artist_name = $data->artist_name;
		$genre = $data->genre;
		$year = $data->year;
		$credit = $data->credit;
		$image = $data->image;
		$engineer_id = $data->engineer_id;
		$bandcamp_url = $data->bandcamp_url;
		$homepage_flag = $data->homepage_flag;

		//Add genre to genre DB if doesn't exist
		if(property_exists($data, "genre") && $data->genreName != ''){

			$result = $database->has('genres', array('name' => $data->genreName));

			// If it exists, get it's ID
			if($result){
				$data->genre_id = $database->get('genres', 'id', array('name' => $data->genreName));
			} else {
				$lastID = $database->insert('genres', array('name' => $data->genreName->name));
				$data->genre_id = $lastID;
			}

		}

		if($action == 'POST'){
			
			$result = $database->insert('credits', array(
					'album_name' => $album_name,
					'artist_name' => $artist_name,
					'genre' => $data->genre_id,
					'year' => $year,
					'credit' => $credit,
					'image' => $image,
					'engineer_id' => $engineer_id,
					'bandcamp_url' => $bandcamp_url,
					'homepage_flag' => $homepage_flag
				)
			);

		}

		if($action == 'PUT'){
			
			$result = $database->update('credits', array(
					'album_name' => $album_name,
					'artist_name' => $artist_name,
					'genre' => $data->genre_id,
					'year' => $year,
					'credit' => $credit,
					'image' => $image,
					'engineer_id' => $engineer_id,
					'bandcamp_url' => $bandcamp_url,
					'homepage_flag' => $homepage_flag
				), array('id' => $id)
			);

		}

		$creditList = $database->select('credits', '*');

	    $response = Flight::formatCredit($creditList);

	    Flight::createCreditsJson();
	    Flight::createTimelineJson();

	    return Flight::json($response);

	} else if($action == 'DELETE'){

		$result = $database->delete('credits', array('id' => $id));

		Flight::createCreditsJson();
	    Flight::createTimelineJson();
	    
		return Flight::json($result);

	}

});

// Get credit by ID
Flight::route('GET /credits/@id', function($id){

	$database = Flight::get('database');
	$result = $database->get('credits', '*', array('id' => $id));

	// Get image URL
	if($result['image']){
		$imageID = $result['image'];
		$result['imgName'] = $database->get('credit_images', '*', array('id' => $imageID));
	}

	// Get genre name
	if($result['genre']){
		$genreID = $result['genre'];
		$result['genreName'] = $database->get('genres', 'name', array('id' => $genreID));
	}

	// Get engineer name
	if($result['engineer_id']){
		$engiID = $result['engineer_id'];
		$result['engi'] = $database->get('engineers', '*', array('id' => $engiID));
	}

	return Flight::json($result);

});

// Get credits total
Flight::route('GET /credits/total', function($id){

	$result = Flight::get('database')->count('credits');
	return Flight::json($result);

});

?>