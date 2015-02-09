<?php

Flight::route('GET /dashboard', function(){
    
    // Get credits count
    $cred = new Credit();
	$credTotal = $cred->getTotal();
	$lastCred = $cred->getLast();
	$formattedCredit = Flight::formatCredit($lastCred);

	// Get genres count
	$g = new Genre();
	$gTotal = $g->getTotal();

	// Get tags count
	$t = new Tag();
	$tTotal = $t->getTotal();

	// Get whitepapers count
	$w = new Whitepaper();
	$wTotal = $w->getTotal();
	$latestW = $w->getLast();

	// Get latest credit

	// Build response object
	$response = new stdClass();
	$response->count = new stdClass();
	$response->count->credits = $credTotal[0];
	$response->count->genres = $gTotal[0];
	$response->count->tags = $tTotal[0];
	$response->count->whitepapers = $wTotal[0];
	$response->credit = $formattedCredit[0];
	if($latestW){
		$response->whitepaper = $latestW[0];
	}

	return Flight::json($response);
});

?>