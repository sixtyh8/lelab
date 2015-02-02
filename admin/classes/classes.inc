<?php
// Include DB Class
require_once 'db.inc';
require_once $_SERVER['DOCUMENT_ROOT'].'/conf/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/actions/clean-string.php';

// Album Credits Class
include 'credit.inc';

// Credit Image Class
include 'image.inc';

// Music Genres Class
include 'genre.inc';

// Session Class
include 'session.inc';

// User Class
include 'user.inc';

// Engineer Class
include 'engineer.inc';

// Categories Class
include 'category.inc';

// Whitepaper Class
include 'whitepaper.inc';

// Trophies Class
// include 'trophy.inc';

?>