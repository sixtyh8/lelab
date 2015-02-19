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

    $database = Flight::get('database');
    
    $user = json_decode($string);
    $action = $user->action;
    $data = $user->data;
    $id = $user->id;

    if($action == "POST"){
        
        $username = $data->username;
        $password = $data->password;
        $admin = $data->admin;
        $email = $data->email;

        $result = $database->insert('users', array(
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'admin' => $admin
            ));

        $latestUser = $database->get('users', '*', array('id' => $result));

        return Flight::json($latestUser);

    } else if($action == "PUT"){
        
        $username = $data->username;
        $password = $data->password;
        $admin = $data->admin;
        $email = $data->email;

        $result = $database->update('users', array(
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'admin' => $admin
        ), array('id' => $id));

        return Flight::json($result);

    } else if($action == "DELETE"){
        
        $result = $database->delete('users', array('id' => $id));
        
        return Flight::json($result);

    }
});

// Get user by ID
Flight::route('GET /users/@id', function($id){

    $result = Flight::get('database')->select('users', '*', array('id' => $id));
    
    return Flight::json($result[0]);

});

?>