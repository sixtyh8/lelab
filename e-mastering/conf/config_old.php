<?php

$_conf = array();

// path
$_conf['path']['base_url'] = '/';
$_conf['path']['full_url'] = $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_conf['path']['base_url'];

// translation
$_conf['translation']['lang'] = 'en';
if(isset($_GET['lang']) && $_GET['lang'] == 'fr'){
	$_conf['translation']['lang'] = 'fr';
}
$_conf['translation']['url_en'] = $_conf['path']['base_url'].'en/';
$_conf['translation']['url_fr'] = $_conf['path']['base_url'].'fr/';
if($_conf['translation']['lang'] == 'en'){
	$_conf['translation']['switch_lang'] = str_replace('/en/', '/fr/', $_SERVER['REQUEST_URI']);
}
else{
	$_conf['translation']['switch_lang'] = str_replace('/fr/', '/en/', $_SERVER['REQUEST_URI']);	
}

// email
//$_conf['email']['dest'] = 'pring27@hotmail.com'; // local
$_conf['email']['dest'] = 'info@lelabmastering.com'; // prod