<?php
//////////////////
// Require Flight
//////////////////
require 'flight/Flight.php';

//////////////////
// Require Classes
//////////////////
//require 'classes/classes.inc';
//include 'classes/db_medoo.inc';
require 'plugins/medoo.php';

$database = new medoo(array(
	'database_type' => 'sqlite',
	'database_file' => 'data/lelab.db'
));

Flight::set('database', $database);

///////////////////
// Require Methods
///////////////////
require 'scripts/methods.php';

//////////////////
// Credits Routes
//////////////////
require 'routes/credits.php';

////////////////////
// Engineers Routes
////////////////////
require 'routes/engineers.php';

/////////////////////
// Genres Routes
/////////////////////
require 'routes/genres.php';

/////////////////////
// Whitepapers Routes
/////////////////////
require 'routes/whitepapers.php';

/////////////////////
// Tags Routes
/////////////////////
require 'routes/tags.php';

/////////////////////
// User/Auth Routes
/////////////////////
require 'routes/user.php';

////////////////////
// Dashboard Routes
////////////////////
require 'routes/dashboard.php';

/////////////////
// Images Routes
/////////////////
require 'routes/images.php';

//////////////////
// Trophies Routes
//////////////////
require 'routes/trophies.php';


Flight::route('OPTIONS /*', function(){
	return Flight::json(array('status' => '200'));
});

////////////////
// Start Flight
////////////////
Flight::start();

?>