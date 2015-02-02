<?php
require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

$metaTITLE['fr'] = 'Timeline';
$metaTITLE['en'] = 'Timeline';
$bodyClass = 'timeline';

include 'includes/header.php';
?>

<div id="timeline">
	<!-- Timeline will generate additional markup here -->
</div>

<script>
$(function(){

    var timeline = new VMM.Timeline();
    timeline.init("/includes/data.json");

});
</script>

<?php
include 'includes/footer.php';
?>