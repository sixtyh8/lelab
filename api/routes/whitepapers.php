<?php

// Get list of whitepapers
Flight::route('GET /whitepapers', function(){

	$database = Flight::get('database');

    $arr = array();

    $result = $database->select('whitepapers', '*');

    foreach ($result as $value) {

    	$value['tags'] = Flight::getWhitepaperTags($value['id']);
    	
    	array_push($arr, $value);
    }

    return Flight::json($arr);
});

// Search
Flight::route('GET /whitepapers/search', function(){
	$keyword =  Flight::request()->query->keyword;

	$result = Flight::get('database')->select('whitepapers', '*', array('OR' => array('title[~]' => $keyword, 'body[~]' => $keyword)));

    return Flight::json($result);
});

// Post new whitepaper
Flight::route('POST /whitepapers', function(){

	$database = Flight::get('database');

	$string = Flight::request()->body;

	$whitepaper = json_decode($string);
	
	$data = $whitepaper->data;
	$action = $whitepaper->action;

	if($action == 'POST'){	

		$title = $data->title;
		$body = $data->body;
		$created_at = $data->created_at;
		$updated_at = null;

		$whitepaperId = $database->insert('whitepapers', array(
				'title' => $title,
				'body' => $body,
				'created_at' => $created_at,
				'updated_at' => $updated_at
			));

		if($data->tags != ""){
			
			$tags = $data->tags;

			foreach ($tags as $key => $value){
				// Check if tag exists and retrieve it's ID
				$tagId = $database->has('tags', array('name' => $value));

				if(!$tagId){
					// Add tag to tags table if it doesn't exist
					$tagId = $database->insert('tags', array('name' => $value));
				} else {
					// Get the existing tag's ID
					$result = $database->get('tags', '*', array('name' => $value));
					$tagId = $result->id;
				}

				// Add tag to article relationship to tags_assoc table
				$result = $database->insert('tags_assoc', array('article_id' => $whitepaperId, 'tag_id' => $tagId));
			}

		}

		return Flight::json($data);

	} else if($action == 'PUT') {

		$title = $data->title;
		$body = $data->body;
		$id = $whitepaper->id;
		$updated_at = $data->updated_at;

		// Update the whitepaper
		$result = $database->update('whitepapers', array('title' => $title, 'body' => $body, 'updated_at' => $updated_at), array('id' => $id));

		// Check if tags is empty
		if($data->tags != ""){
			$tags = $data->tags;

			// Get all the tags associated with the whitepaper in the db
			$assocsInDB = $database->select('tags_assoc', '*', array('article_id' => $id));

			foreach($assocsInDB as $assoc){
				// Get tag name
				$tagInDBName = $database->select('tags', '*', array('id' => $assoc['tag_id']));

				// Check if the tag is in the tags submitted and remove the assoc if not
				if(!in_array($tagInDBName, $tags)){
					$database->delete('tags_assoc', array('id' => $assoc['id']));
				}
			}

			foreach ($tags as $key => $value){
				// Check if tag exists and retrieve it's ID
				if(is_array($value)){
					$tagName = $value['name'];
				} else {
					$tagName = $value;
				}

				$tagId = $database->get('tags', '*', array('name' => $tagName));

				if(!$tagId){
					// Add tags to tags table if it doesn't exist
					$tagId = $database->insert('tags', array('name' => $tagName));
				}

				if(is_array($tagId)){
					$tagId = $tagId['id'];
				}

				// Check if assoc exists
				$hasAssoc = $database->has('tags_assoc', array('AND' => array('tag_id' => $tagId, 'article_id' => $id)));

				if(!$hasAssoc){
					// Add tag to article relationship to tags_assoc table
					$database->insert('tags_assoc', array('tag_id' => $tagId, 'article_id' => $id));
				}
			}

		}

		return Flight::json($result);

	} else if($action == 'DELETE') {

		$id = $whitepaper->id;

		$result = Flight::get('database')->delete('whitepapers', array('id' => $id));

		return Flight::json($result);

	}

});

// Get whitepaper by ID
Flight::route('GET /whitepapers/@id', function($id){

	$database = Flight::get('database');

	$response = $database->get('whitepapers', '*', array('id' => $id));

	$response['tags'] = Flight::getWhitepaperTags($id);

	return Flight::json($response);
});

Flight::route('GET /whitepapers/tag/@id', function($id){

	$database = Flight::get('database');

	$list = $database->select('tags_assoc', '*', array('tag_id' => $id));

	$whitepapers = array();

	foreach($list as $assoc){
		$wp = $database->get('whitepapers', '*', array('id' => $assoc['article_id']));

		$wp['tags'] = Flight::getWhitepaperTags($wp['id']);

		array_push($whitepapers, $wp);
	}

	return Flight::json($whitepapers);

});

// Get all the tags for a whitepaper
// Return an array for all tags
Flight::map('getWhitepaperTags', function($whitepaper_id){
	
	$database = Flight::get('database');

	$list = $database->select('tags_assoc', '*', array('article_id' => $whitepaper_id));
	$tags = array();

	foreach($list as $tag){
		$t = $database->get('tags', '*', array('id' => $tag['tag_id']));
		array_push($tags, $t);
	}

	return $tags;

});

?>