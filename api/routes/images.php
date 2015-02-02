<?php

Flight::route('POST /images/upload', function(){
    // Initialize the new Credit object
    // $obj = new Category();
    //
    $request = Flight::request()->files;
    $image = $request->file;

    $response = Flight::treatImage($image);

    return Flight::json($response);
});

?>