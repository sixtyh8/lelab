<?php

Flight::route('GET /dashboard', function(){
    
    // Get credits count
	$credTotal = Flight::get('database')->count('credits', '*');
	$lastCred = Flight::get('database')->select('credits', '*', array('ORDER' => 'id DESC', 'LIMIT' => 1));
	$formattedCredit = Flight::formatCredit($lastCred);

	// Get genres count
	$gTotal = Flight::get('database')->count('genres', '*');

	// Get tags count
	$tTotal = Flight::get('database')->count('tags', '*');

	// Get whitepapers count
	$wTotal = Flight::get('database')->count('whitepapers', '*');
	$latestW = Flight::get('database')->get('whitepapers', '*', array('ORDER' => 'id DESC'));

	// Build response object
	$response = new stdClass();
	$response->count = new stdClass();
	$response->count->credits = $credTotal;
	$response->count->genres = $gTotal;
	$response->count->tags = $tTotal;
	$response->count->whitepapers = $wTotal;
	$response->credit = $formattedCredit[0];
	if($latestW){
		$response->whitepaper = $latestW;
	}

	return Flight::json($response);
});

?>