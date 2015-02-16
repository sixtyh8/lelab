<?php

Flight::route('POST /auth', function(){

    $string = Flight::request()->body;

    $data = json_decode($string);
    $username = $data->username;
    $password = $data->password;

    $result = Flight::get('database')->select("users", '*', array(
        'AND' => array(
            'OR' => array(
                'username' => $username,
                'email' => $username
            ),
        'password' => $password
        )
    ));

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

	$result = Flight::get('database')->select("users", '*');

	return Flight::json($result);
});

Flight::route('POST /users', function(){

    $string = Flight::request()->body;

    $data = json_decode($string);
    $username = $data->data->username;
    $password = $data->data->password;
    $admin = $data->data->admin;
    $email = $data->data->email;

    $result = Flight::get('database')->insert('users', array(
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'admin' => $admin
        ));

    $latestUser = Flight::get('database')->get('users', '*', array('id' => $result));

    return Flight::json($latestUser);
});

Flight::route('PUT /users/@id', function($id){
    $body = Flight::request()->body;

    $data = json_decode($body);

    $username = $data->update->username;
    $email = $data->update->email;
    $password = $data->update->password;
    $admin = $data->update->admin;
    $id = $data->update->id;

    $result = Flight::get('database')->update('users', array(
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'admin' => $admin
        ), array('id' => $id));

    return Flight::json($result);
});

// Get user by ID
Flight::route('GET /users/@id', function($id){

    $result = Flight::get('database')->select('users', '*', array('id' => $id));

    return Flight::json($result[0]);
});

// Delete user
Flight::route('DELETE /users/@id', function($id){

    $result = Flight::get('database')->delete('users', array('id' => $id));

    return Flight::json($result);
});

?>