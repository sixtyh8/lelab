<?php
$target_path = "../uploads/";

$target_path = $target_path . date('Ymd'). '-' . basename( $_FILES['uploadedfile']['name']); 

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    header('Location: success');
} else{
    header('Location: error');
}

?>