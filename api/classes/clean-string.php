<?php
function cleanString($string){

    $search = array(
        chr(0xe2) . chr(0x80) . chr(0x98),
        chr(0xe2) . chr(0x80) . chr(0x99),
        chr(0xe2) . chr(0x80) . chr(0x9c),
        chr(0xe2) . chr(0x80) . chr(0x9d),
        chr(0xe2) . chr(0x80) . chr(0x93),
        chr(0xe2) . chr(0x80) . chr(0x94)
    );     
    $replace = array(
        '&lsquo;',
        '&rsquo;',                    
        '&ldquo;',                    
        '&rdquo;',                    
        '&ndash;',                    
        '&mdash;'
    );

    return str_replace($search, $replace, $string); 

}

function doubleQuotes($string){
	return str_replace(array("'", "&quot;"), "''", $string);
}

function removeQuotes($string){
	$search = array(
        chr(0xe2) . chr(0x80) . chr(0x98),
        chr(0xe2) . chr(0x80) . chr(0x99),
        chr(0xe2) . chr(0x80) . chr(0x9c),
        chr(0xe2) . chr(0x80) . chr(0x9d),
        chr(0xe2) . chr(0x80) . chr(0x93),
        chr(0xe2) . chr(0x80) . chr(0x94),
        "'",
        '"'
    );

    return str_replace($search, "", $string); 
}
?>