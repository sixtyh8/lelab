<?php
// Set default timezone
date_default_timezone_set("America/Montreal");

// Include DB Class
require_once 'db_sqlite.inc';
require_once 'clean-string.php';

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

// Tag Class
include 'tag.inc';

// Whitepaper Class
include 'whitepaper.inc';

// Tags Assoc
include 'tag_assoc.inc';

?>