<?php
	require_once dirname(dirname((__FILE__))).'/conf/config.php';
	require_once dirname(dirname((__FILE__))).'/lib/'.$_conf['translation']['lang'].'.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Le Lab Mastering | <?php echo $metaTITLE[$_conf['translation']['lang']]; ?></title>
<link type="text/css" rel="stylesheet" href="<?php echo $_conf['path']['base_url']; ?>css/tooltipster.css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo $_conf['path']['base_url']; ?>css/main.css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo $_conf['path']['base_url']; ?>css/slider.css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo $_conf['path']['base_url']; ?>css/reveal.css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo $_conf['path']['base_url']; ?>css/print.css" media="print" />
<link type="text/css" rel="stylesheet" href="<?php echo $_conf['path']['base_url']; ?>css/jquery-ui.css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo $_conf['path']['base_url']; ?>css/timeline.css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo $_conf['path']['base_url']; ?>css/timeline-custom.css" media="screen" />
<!--[if IE]>
<link type="text/css" rel="stylesheet" href="<?php echo $_conf['path']['base_url']; ?>css/ie.css" media="screen" />
<![endif]-->
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>js/jquery-migrate.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>js/jquery.reveal.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>js/jquery-ui-1.7.3.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>js/jquery.carouFredSel-6.2.1-packed.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>js/jquery.lazyload.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>admin/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>js/timeline.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>js/jquery.tooltipster.min.js"></script>
<script type="text/javascript" src="<?php echo $_conf['path']['base_url']; ?>js/main.js"></script>

<script type="text/javascript">
(function(){
  // if firefox 3.5+, hide content till load (or 3 seconds) to prevent FOUT
  var d = document, e = d.documentElement, s = d.createElement('style');
  if (e.style.MozTransform === ''){ // gecko 1.9.1 inference
    s.textContent = 'body{visibility:hidden}';
    var r = document.getElementsByTagName('script')[0];
    r.parentNode.insertBefore(s, r);
    function f(){ s.parentNode && s.parentNode.removeChild(s); }
    addEventListener('load',f,false);
    setTimeout(f,3000); 
  }
})();
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-24618293-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body class="<?php echo $bodyClass; ?>">
<div class="loader" style="width:1px; height:1px; overflow:hidden;"></div>
<div id="login-bar">

</div>
<div id="wraper">
<h1><a id="logo" href="<?php echo $_conf['path']['base_url'].$_conf['translation']['lang'].'/'; ?>"><img src="<?php echo $_conf['path']['base_url']; ?>img/logo-lab.png" alt="Lab Mastering" title="Lab Mastering" /></a></h1>
<div id="option-wrapper">
  <a href="#" data-reveal-id="myModal"><img id="mastered-for-itunes" src="<?php echo $_conf['path']['base_url']; ?>img/masteredituneslogo20120217.png" alt="Mastered for iTunes" /></a>
  <ul id="option-bar">
  	<li class="no-border"><a href="<?php echo $_conf['path']['base_url'].$_conf['translation']['lang'].'/'; ?>contact"><?php echo $_conf['translation']['lang']!='fr' ? 'Book a session' : 'R&eacute;servation'; ?></a></li>
  	<li><a href="<?php echo $_conf['path']['base_url'].$_conf['translation']['lang'].'/'; ?>e-mastering/">E-Mastering</a></li>
  	<!-- SWITCH DE LANGUE -->
      <li><a href="<?php echo $_conf['translation']['switch_lang']; ?>"><?php echo $_conf['translation']['lang']!='fr' ? 'Français' : 'English'; ?></a></li>
  </ul>
</div>
<ul id="main-menu" <?php if($_conf['translation']['lang'] == 'fr') echo ' style="margin-left:470px;"'; ?>>
	<li><a href="<?php echo $_conf['path']['base_url'].$_conf['translation']['lang'].'/'; ?>" <?php if($bodyClass == 'home') echo 'class="selected"'?>><?php echo MAIN_MENU_HOME; ?></a></li>
	<li><a href="<?php echo $_conf['path']['base_url'].$_conf['translation']['lang'].'/'; ?>studio" <?php if($bodyClass == 'studio') echo 'class="selected"'?>><?php echo MAIN_MENU_STUDIO; ?></a></li>
    <li><a href="<?php echo $_conf['path']['base_url'].$_conf['translation']['lang'].'/'; ?>engineers" <?php if($bodyClass == 'engineers') echo 'class="selected"'?>><?php echo MAIN_MENU_ENGINEERS; ?></a></li>
    <li><a href="<?php echo $_conf['path']['base_url'].$_conf['translation']['lang'].'/'; ?>mastering" <?php if($bodyClass == 'mastering') echo 'class="selected"'?>><?php echo MAIN_MENU_MASTERING; ?></a></li>
    <li><a href="/album-credits.php" <?php if($bodyClass == 'credits') echo 'class="selected"'?>>Credits</a></li>
    <li class="no-border"><a href="<?php echo $_conf['path']['base_url'].$_conf['translation']['lang'].'/'; ?>contact" <?php if($bodyClass == 'contact') echo 'class="selected"'?>><?php echo MAIN_MENU_CONTACT; ?></a></li>
</ul>
<?php
	if($bodyClass == 'home') include 'slider.php';
	if($bodyClass == 'studio' || $bodyClass == 'contact') include 'view.php';
?>
<div id="content">