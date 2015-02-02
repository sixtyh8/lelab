<?php
session_start();
//print_r() ;
//$myArray = json_decode(stripslashes($_POST['data']), true);


//print_r($myArray);
require_once dirname(dirname((__FILE__))).'/conf/config.php';
require_once dirname(dirname((__FILE__))).'/lib/'.$_conf['translation']['lang'].'.php';
//	include 'covers.php';

//shuffle($covers);
//$covers = $_SESSION['slider']['data'];

$covers = $_POST['data'];
//print_r($covers);
unset($covers[0]);
unset($covers[1]);
unset($covers[2]);
unset($covers[3]);
unset($covers[4]);
//print_r($covers);

	//var_dump();
	//$data = explode(",",$_GET['data']);
	//foreach($data as $remover) {
		
		//var_dump($key);
	//}
	//foreach($covers as $keymaster => $cover) {
	//	$key = array_search($cover['img'],$data );
		
	//	if ($key) {
	//		unset($covers[$keymaster]);
			///var_dump($key);
			//var_dump($keymaster);
			//var_dump("----");
	//	}
	//}
	
	

$var3 = 0;
//$index = count($covers)-6;
$index = count($covers)-1;
$index2 = 0;
$indexfordelete = 0;
//print_r($covers);
//array_reverse($covers);
foreach($covers as $key => $cover) {
		

	if ($var3 % 5 == 0) {
	$index2++;
	echo "<ul class='list'>";
	}
				if ($covers[$index]['img']) {
					echo '<li class="cover"><span class="title">'.stripcslashes($covers[$index]['title']).'</span><img style="display:none;" src="../img/grey.gif" data-original="'.$_conf['path']['base_url'].'img/covers/'.stripcslashes($covers[$index]['img']).'" class="pochette'.$index2.'"></li>';
					
				}
						if ($var3 % 5 == 4) {
	echo "</ul>";
	}
						$var3++;
						$index--;
					}
			

?>