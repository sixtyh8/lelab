<?php
		
// Read JSON file
$content = utf8_encode(file_get_contents("timeline.json", FILE_USE_INCLUDE_PATH));
$timeline_data = json_decode($content, true);

$timeline_count = count($timeline_data);
$fullTimelineDelimiters = $timeline_count % 5;
if($fullTimelineDelimiters == 0){
	$fullTimelineDelimiters = $timeline_count / 5;
}
$numExtraYears = $timeline_count - ($fullTimelineDelimiters * 5);
$fullDelimitersCounter = 0;

// Find the biggest number of albums produced to establish our baseline
$albumCount = array();

foreach($timeline_data as $key => $year) {
	array_push($albumCount, $year["album-count"]);
}

$biggestAlbumCount = max($albumCount);

// Output content init
$tbody = '';
$tfoot = '';

// Build the table body
foreach($timeline_data as $key => $year) {
	$tooltip_class = '';
	
	// Percentage height
	$height = ($year['album-count'] / $biggestAlbumCount) * 100;
	
	if($year["year"] % 5 == 0){
		$fullDelimitersCounter++;
		$colspan = '5';
		if($fullDelimitersCounter > $fullTimelineDelimiters){
			$colspan = ($numExtraYears / $fullDelimitersCounter);
		}
		$tfoot .= '<td colspan="'.$colspan.'"><div class="year-delimiter">'.$year["year"].'</div></td>';
		
	}
	
	if($height > 0){
		$tooltip_class = ' tooltip';
	}
	
	$tbody .= '<td><div class="year'.$tooltip_class.'" title="<h2>'.$year["year"].'</h2><p>'.$year["album-count"].' albums</p>"><span style="height:'.$height.'%"></span></div></td>';
	
}

?>

<script>
$(function(){
	var numberOfYears = <?php echo $timeline_count ?>,
		containerWidth = $('#timeline-table').width(),
		containerAvailWidth = containerWidth - (numberOfYears * 4),
		yearWidth = containerAvailWidth/numberOfYears;
		
	$('div.year').parents('td').css('width', yearWidth+'px');
	
	$('.tooltip').tooltipster({
		theme: '.tooltipster-noir',
		position: 'bottom'
	});
});
</script>
<div id="timeline-container">
<table id="timeline-table" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<?php echo $tbody; ?>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<?php echo $tfoot ?>
		</tr>
	</tfoot>
</table>
</div>