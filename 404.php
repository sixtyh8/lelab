<?php
$metaTITLE['fr'] = '404';
$metaTITLE['en'] = '404';
$bodyClass = '404';

include 'includes/header.php';
?>

<div class="full-box">
	<div class="full-box-top"></div>
    <div class="full-box-content no-background no-minheight" style="padding-bottom:40px;">
    <?php if($_conf['translation']['lang'] == 'en'){ ?>
    	<h2>404 Error</h2>
        <p>Sorry, the page your are trying to view can't be found. This page might have been removed or the name has changed.</p>
    <?php } else { ?>
    	<h2>&Agrave; propos</h2>
        <p></p>
    <?php } ?>
    </div>
    <div class="full-box-bottom"></div>
</div>

<?php
include 'includes/footer.php';
?>