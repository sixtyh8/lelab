<?php
require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

$imageID = $_GET['imageID'];

$imgObj = new CreditImage();
$img = $imgObj->getImageName($imageID);

echo json_encode($img);

?>