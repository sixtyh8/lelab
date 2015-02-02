<?php
	require_once '../conf/config.php';
	require_once '../lib/'.$_conf['translation']['lang'].'.php';
	// Loading base modules
	require_once 'actions/session.php';
  	
  	$loggedIn = false;
    $showModal = false;

	// Admin menu if session exists
	if(isset($_SESSION['username'])) { 
		$bodyClass = 'logged-in';
		$loggedIn = true;
	}

    if(isset($_GET['action'])){
        $showModal = $_GET['action'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Le Lab Mastering | <?php echo $metaTITLE[$_conf['translation']['lang']]; ?></title>
<link type="text/css" rel="stylesheet" href="<?php echo $_conf['path']['base_url']; ?>css/main.css" media="screen" />
<!-- Bootstrap -->
<link type="text/css" rel="stylesheet" href="<?php echo $_conf['path']['base_url']; ?>css/tooltipster.css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo $_conf['path']['base_url']; ?>admin/css/bootstrap.css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo $_conf['path']['base_url']; ?>admin/css/bootstrap-editable.css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo $_conf['path']['base_url']; ?>admin/css/alertify.core.css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo $_conf['path']['base_url']; ?>admin/css/alertify.bootstrap.css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo $_conf['path']['base_url']; ?>admin/css/admin.css" media="screen" />
<!--[if IE]>
<link type="text/css" rel="stylesheet" href="<?php echo $_conf['path']['base_url']; ?>css/ie.css" media="screen" />
<![endif]-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://malsup.github.com/jquery.cycle.all.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>js/jquery.lazyload.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>admin/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>admin/js/bootstrap-editable.min.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>admin/js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>admin/js/typeahead.min.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>admin/js/alertify.min.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>admin/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>admin/js/jquery.dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>js/jquery.tooltipster.min.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>admin/js/admin.js"></script>

</head>

<body class="<?php echo $bodyClass; ?>">


<div id="admin-menu" class="navbar navbar-fixed-top">
  	<div class="navbar-inner">
  		<a class="brand" href="index.php">Le Lab Admin</a>
  		<?php 
		// Admin menu if session exists
		if($loggedIn) { 
		?>
	    <ul class="nav">
	        <li<?php if($currentSection == 'credits'){?> class="active"<?php } ?>>
	        	<a href="credits.php">Album Credits</a>
	        </li>
	        <li<?php if($currentSection == 'whitepapers'){?> class="active"<?php } ?>>
	        	<a href="whitepapers.php">Whitepapers</a>
	        </li>
	        <li class="dropdown<?php if($currentSection == 'engineers' || $currentSection == 'categories' || $currentSection == 'users' || $currentSection == 'genres' || $currentSection == 'trophies'){?> active<?php } ?>">
    			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Tools<b class="caret"></b></a>
    			<ul class="dropdown-menu">
    				<!--
    				<li<?php if($currentSection == 'categories'){?> class="active"<?php } ?>>
	        			<a href="categories.php">Manage Categories</a>
	        		</li>
	        		-->
    				<li<?php if($currentSection == 'genres'){?> class="active"<?php } ?>>
	        			<a href="genres.php">Manage Genres</a>
	        		</li>
                    <li<?php if($currentSection == 'engineers'){?> class="active"<?php } ?>>
                        <a href="engineers.php">Manage Engineers</a>
                    </li>
                    <li<?php if($currentSection == 'categories'){?> class="active"<?php } ?>>
                        <a href="categories.php">Manage Categories</a>
                    </li>
                    <!--
                    <li<?php if($currentSection == 'users'){?> class="active"<?php } ?>>
                        <a href="users.php">Manage Users</a>
                    </li>
                    -->
	        		<!--
	        		<li<?php if($currentSection == 'trophies'){?> class="active"<?php } ?>>
	        			<a href="trophies.php">Manage Trophies</a>
	        		</li>
	        		-->
    			</ul>
 			 </li>
	    </ul>
	    <p class="navbar-text pull-right">Logged in as: <?php echo $_SESSION['username']; ?>  | <a href="actions/logout.php">Logout</a></p>
	    <?php 
		} 
		?>
	</div>
</div>



<div id="wraper">
<h1><a id="logo" href="<?php echo $_conf['path']['base_url'].$_conf['translation']['lang'].'/'; ?>"><img src="<?php echo $_conf['path']['base_url']; ?>img/logo-lab.png" alt="Lab Mastering" title="Lab Mastering" /></a></h1>
<div id="content">
	<div class="admin-content">