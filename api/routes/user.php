<?php

Flight::route('POST /auth', function(){
    // Initialize the new User object
    $obj = new User();

    $string = Flight::request()->body;

    $data = json_decode($string);
    $username = $data->username;
    $password = $data->password;

    $result = $obj->authenticate($username, $password);

    $response = new stdClass();
    $response->user = new stdClass();

    if($result){
        $response->message = "success";
        $response->status = 200;

        $response->user->username = $result[0]['username'];
        $response->user->userId = $result[0]['id'];
        $response->user->email = $result[0]['email'];

        if($result[0]['admin'] == 'true'){
            $response->user->admin = true;
        } else {
            $response->user->admin = false;
        }

    } else {
        $response->message = "unauthorized";
        $response->status = 401;
    }

    return Flight::json($response);
});

Flight::route('GET /users', function(){

	$obj = new User();
	$response = $obj->listUsers();

	return Flight::json($response);

});

Flight::route('POST /users', function(){
    // Initialize the new User object
    $obj = new User();

    $string = Flight::request()->body;

    $data = json_decode($string);
    $username = $data->data->username;
    $password = $data->data->password;
    $admin = $data->data->admin;
    $email = $data->data->email;

    $response = $obj->create($username, $password, $admin, $email);

    $latestUser = $obj->showUser($response);

    return Flight::json($latestUser[0]);
});

Flight::route('PUT /users', function(){
    $body = Flight::request()->body;

    $data = json_decode($body);

    $obj = new User();
    $result = $obj->updateUser($data->update);

    return Flight::json($result);
});

// Get user by ID
Flight::route('GET /users/@id', function($id){

    $obj = new User();
    $result = $obj->showUser($id);

    return Flight::json($result[0]);

});

// Delete credit
Flight::route('DELETE /users/@id', function($id){
    
    $obj = new User();
    $result = $obj->deleteUser($id);


    return Flight::json($result);
});

?>