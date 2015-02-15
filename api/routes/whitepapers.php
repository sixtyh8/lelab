<?php

// Get list of whitepapers
Flight::route('GET /whitepapers', function(){
	$obj = new Whitepaper();
    $result = $obj->listWhitepapers();

    $tagsAssoc = new TagAssoc();
    $tagsObj = new Tag();
    $arr = array();

    foreach ($result as $value) {
    	$tagsArr = array();

    	$tags = $tagsAssoc->getArticleTags($value['id']);
    	
    	foreach ($tags as $val) {
    		$temp = $tagsObj->getTag($val['id']);
    		if($temp){
    			array_push($tagsArr, $temp);
    		}
    	}

    	$value['tags'] = $tagsArr;
    	
    	array_push($arr, $value);
    }

    return Flight::json($arr);
});

// Search
Flight::route('GET /whitepapers/search', function(){
	$keyword =  Flight::request()->query->keyword;

	$obj = new Whitepaper();
	$tagsObj = new Tag();
	$tagsAssoc = new TagAssoc();

	// Check if keyword is a tag
	// If so, return all tag assocs
	// Get all articles

	$result = $obj->searchWhitepapers($keyword);

    return Flight::json($result);
});

// Post new whitepaper
Flight::route('POST /whitepapers', function(){

	$string = Flight::request()->body;

	$whitepaper = json_decode($string);
	$data = $whitepaper->data;

	$obj = new Whitepaper();
	$whitepaperId = $obj->create($data);

	if($data->tags != ""){
		$tags = $data->tags;
		$tagsObj = new Tag();
		$tagsAssoc = new TagAssoc();

		foreach ($tags as $key => $value){
			// Check if tag exists and retrieve it's ID
			$tagId = $tagsObj->checkTag($value);

			if(!$tagId){
				// Add tag to tags table if it doesn't exist
				$tagId = $tagsObj->create($value);
			} else {
				// Get the existing tag's ID
				$tagId = $tagId[0]['id'];
			}

			// Add tag to article relationship to tags_assoc table
			$tagsAssoc->create($tagId, $whitepaperId);
		}

	}

	return Flight::json($data);

});

// Get whitepaper by ID
Flight::route('GET /whitepapers/@id', function($id){

	$obj = new Whitepaper();
	$tagsObj = new Tag();
	$tagsAssoc = new TagAssoc();

	$result = $obj->getOne($id);

	$response = $result[0];

	$tags = array();

	$tagsList = $tagsAssoc->getArticleTags($id);

	foreach($tagsList as $tag){
		$tagName = $tagsObj->getTag($tag['tag_id']);
		array_push($tags, $tagName);
	}

	$response['tagsList'] = $tags;

	return Flight::json($response);

});

// Update whitepaper
Flight::route('PUT /whitepapers/@id', function($id){
	$obj = new Whitepaper();
	$tagsObj = new Tag();
	$tagsAssoc = new TagAssoc();

	$string = Flight::request()->body;

	$whitepaper = json_decode($string);
	$whitepaperId = $whitepaper->id;

	// Update the whitepaper
	$result = $obj->update($whitepaper);

	// Check if tags is empty
	if($whitepaper->tags != ""){
		$tags = $whitepaper->tags;

		// Get all the tags associated with the whitepaper in the db
		$assocsInDB = $tagsAssoc->getArticleTags($whitepaperId);

		foreach($assocsInDB as $assoc){
			// Get tag name
			$tagInDBName = $tagsObj->getTag($assoc['tag_id']);

			// Check if the tag is in the tags submitted and remove the assoc if not
			if(!in_array($tagInDBName, $tags)){
				$tagsAssoc->deleteByID($assoc['id']);
			}
		}

		foreach ($tags as $key => $value){
			// Check if tag exists and retrieve it's ID
			if(is_array($value)){
				$tagName = $value['name'];
			} else {
				$tagName = $value;
			}

			$tagId = $tagsObj->checkTag($tagName);

			if(!$tagId){
				// Add tags to tags table if it doesn't exist
				$tagId = $tagsObj->create($value);
			}

			if(is_array($tagId)){
				$tagId = $tagId[0]['id'];
			}

			// Check if assoc exists
			$hasAssoc = $tagsAssoc->checkAssoc($tagId, $whitepaperId);

			if(!$hasAssoc){
				// Add tag to article relationship to tags_assoc table
				$tagsAssoc->create($tagId, $whitepaperId);
			}
		}

	}

	return Flight::json($result);
});

// Delete whitepaper
Flight::route('DELETE /whitepapers/@id', function($id){
	$obj = new Whitepaper();

	$result = $obj->delete($id);

	return Flight::json($result);
});

?>