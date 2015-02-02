<?php

Flight::route('GET /credits', function(){
	$obj = new Credit();

	$total = $obj->getTotal();
	$limit = Flight::request()->query->limit;
	$offset = Flight::request()->query->offset;

	if($total > $offset){
    	$result = $obj->listCredits($limit, $offset);
    	$response = Flight::formatCredit($result);
    } else {
    	$response = new stdClass();
    	$response->message = 'done';
    	$response->total = $total;
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
	if(property_exists($data, "genre")){
		// Initialize the new Genre object
		$genre = new Genre();
		//$genreName = cleanString($data->genre);

		// Call checkGenre
		$result = $genre->checkGenre($data->genreName[0]->name->name);

		// If it exists, get it's ID
		if($result){
			$data->genre_id = $data->genreName[0]->name->id;
		} else {
			$lastID = $genre->addGenre($data->genreName[0]->name->name);
			$data->genre_id = $lastID;
		}

	}


	// Initialize the new Credit object
	$obj = new Credit();

	// Call createCredit
	$result = $obj->createCredit($data);

	$creditList = $obj->listCredits(0, 0);

    $response = Flight::formatCredit($creditList);

    return Flight::json($response);

});

// Get credit by ID
Flight::route('GET /credits/@id', function($id){

	$obj = new Credit();
	$result = $obj->getOneCredit($id);

	// Get image URL
	$imageID = $result[0]['image'];
	$imgObj = new CreditImage();
	$result[0]['imgName'] = $imgObj->getImageName($imageID);

	// // Get genre name
	$genreID = $result[0]['genre'];
	$genreObj = new Genre();
	$result[0]['genreName'] = $genreObj->getGenreName($genreID);

	// // Get engineer name
	$engiID = $result[0]['engineer_id'];
	$engiObj = new Engineer();
	$result[0]['engi'] = $engiObj->getEngineerName($engiID);

	return Flight::json($result[0]);

});

// Update credit
Flight::route('PUT /credits', function(){
	// Initialize the new Credit object
	$obj = new Credit();

	$string = Flight::request()->body;

	$credit = json_decode($string);


	// Call createCredit
	$result = $obj->updateCredit($credit);

	$creditList = $obj->listCredits();

    $response = Flight::formatCredit($creditList);

    return Flight::json($response);

});

// Delete credit
Flight::route('DELETE /credits/@id', function($id){
	$obj = new Credit();
	$result = $obj->deleteCredit($id);


	return Flight::json($result);
});
?>