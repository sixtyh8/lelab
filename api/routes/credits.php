<?php

Flight::route('GET /credits', function(){
	$obj = new Credit();

	$total = $obj->getTotal();
	$limit = Flight::request()->query->limit;
	$offset = Flight::request()->query->offset;

	if($limit && $total){
		if($total > $offset){
	    	$result = $obj->listCredits($limit, $offset);
	    	$response = Flight::formatCredit($result);
	    } else {
	    	$response = new stdClass();
	    	$response->message = 'done';
	    	$response->total = $total;
	    }
	} else {
		$result = $obj->all();
	    $response = Flight::formatCredit($result);
	}

    return Flight::json($response);
});

Flight::route('GET /credits/search', function(){
	$keyword =  Flight::request()->query->keyword;

	$obj = new Credit();
    $result = $obj->searchCredits($keyword);

    $response = Flight::formatCredit($result);

    return Flight::json($response);
});

// Post new credit
Flight::route('POST /credits', function(){

	$string = Flight::request()->body;

	$credit = json_decode($string);
	$data = $credit->data;

	if(!property_exists($data, "image_id")){
		$data->image_id = null;
	}

	if(!property_exists($data, "bandcamp_url")){
		$data->bandcamp_url = null;
	}

	//Add genre to genre DB if doesn't exist
	if(property_exists($data, "genre") && $data->genreName[0]->name != ''){
		// Initialize the new Genre object
		$genre = new Genre();
		//$genreName = cleanString($data->genre);

		// Call checkGenre
		$result = $genre->checkGenre($data->genreName[0]->name);

		// If it exists, get it's ID
		if($result){
			$data->genre_id = $data->genreName[0]->id;
		} else {
			$lastID = $genre->addGenre($data->genreName[0]->name);
			$data->genre_id = $lastID;
		}

	}


	// Initialize the new Credit object
	$obj = new Credit();

	// Call createCredit
	$result = $obj->createCredit($data);

	$creditList = $obj->all();

    $response = Flight::formatCredit($creditList);

    return Flight::json($response);

});

// Get credit by ID
Flight::route('GET /credits/@id', function($id){

	$obj = new Credit();
	$result = $obj->getOneCredit($id);

	// Get image URL
	if($result[0]['image']){
		$imageID = $result[0]['image'];
		$imgObj = new CreditImage();
		$result[0]['imgName'] = $imgObj->getImageName($imageID);
	}

	// Get genre name
	if($result[0]['genre']){
		$genreID = $result[0]['genre'];
		$genreObj = new Genre();
		$result[0]['genreName'] = $genreObj->getGenreName($genreID);
	}

	// Get engineer name
	if($result[0]['engineer_id']){
		$engiID = $result[0]['engineer_id'];
		$engiObj = new Engineer();
		$result[0]['engi'] = $engiObj->getEngineerName($engiID);
	}

	return Flight::json($result[0]);

});

// Update credit
Flight::route('PUT /credits/@id', function($id){
	// Initialize the new Credit object
	$obj = new Credit();

	$string = Flight::request()->body;

	$credit = json_decode($string);

	$credit->creditID = $credit->id;

	if(!property_exists($credit, "image")){
		$credit->image_id = null;
	} else {
		$credit->image_id = $credit->image;
	}

	if(!property_exists($credit, "bandcamp_url")){
		$credit->bandcamp_url = null;
	}

	if(!property_exists($credit, "genre_id")){
		$credit->genre_id = null;
	}

	if(property_exists($credit, "genre")){
		
		// Initialize the new Genre object
		$genre = new Genre();
		//$genreName = cleanString($data->genre);

		// Call checkGenre
		$g = $genre->checkGenre($credit->genre);

		// If it exists, get it's ID
		if($g){
			$credit->genre_id = $g[0]['id'];
		} else {
			$lastID = $genre->addGenre($credit->genre);
			$credit->genre_id = $lastID;
		}
	}

	// Call createCredit
	$result = $obj->updateCredit($credit);

	$creditList = $obj->all();

    $response = Flight::formatCredit($creditList);

    return Flight::json($credit);

});

// Delete credit
Flight::route('DELETE /credits/@id', function($id){
	$obj = new Credit();
	$result = $obj->deleteCredit($id);

	return Flight::json($result);
});

// Get credits total
Flight::route('GET /credits/total', function($id){
	$obj = new Credit();
	$result = $obj->getTotal();


	return Flight::json($result);
});
?>