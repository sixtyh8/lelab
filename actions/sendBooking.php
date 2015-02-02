<?php
	require_once dirname(dirname((__FILE__))).'/conf/config.php';

	$to = $_conf['email']['dest'];
	$from = $_POST['email'];
	
	$msg = '<h1>SESSION BOOKING REQUEST</h1>';
	$msg .= '<p>Name: '.htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8').'<br/>';
	$msg .= 'Phone: '.$_POST['phone'].'<br/>';
	$msg .= 'Email: '.htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8').'<br/>';
	//$msg .= 'Engineer: '.htmlentities($_POST['engineer']).'<br/>';
	$msg .= 'Message: '.htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8').'</p>';
	
    $subject = 'Session booking request';
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
    $headers .= 'From: Le Lab Mastering Website <noreply@lelabmastering.com>'."\r\n";
	
   	if(mail($to, $subject, $msg, $headers)){
		echo $_POST['lang'] == 'en' ? 'Your request have been sent.' : 'Votre demande a &eacute;t&eacute; envoy&eacute;e.';
	} else {
		echo $_POST['lang'] == 'en' ? 'Sorry, an error occurs, please try again.' : 'D&eacute;sol&eacute;, une erreur s\'est produite, veuillez r&eacute;essayer.';
	}
?>