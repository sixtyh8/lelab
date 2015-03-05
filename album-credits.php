<?php
require $_SERVER['DOCUMENT_ROOT']."/api/plugins/medoo.php";

$database = new medoo(array(
	'database_type' => 'sqlite',
	'database_file' => $_SERVER['DOCUMENT_ROOT'].'/api/data/lelab.db'
));

$showName = true;

if(isset($_GET['engineer-id'])){
	$engineerID = $_GET['engineer-id'];
} else {
	$engineerID = false;
}

if($engineerID){
	$showName = false;
	$result = $database->select('credits', '*', array('engineer_id' => $engineerID, 'ORDER' => array('year DESC', 'id DESC')));
	$engiName = $database->select('engineers', '*', array('id' => $engineerID));
} else {
	$result = $database->select('credits', '*', array('ORDER' => array('year DESC', 'id ASC')));
}

$metaTITLE['fr'] = 'Crédit d\'album';
$metaTITLE['en'] = 'Album Credits';
$bodyClass = 'credits';

include 'includes/header.php';
?>
<?php 
	if($showName){
		include 'includes/timeline.php';
	}
?>
<?php					
if($result){
?>

<?php if(!$showName){ ?>
	<div class="caption"><?php echo $engiName[0]['name']; ?>'s Album Credits</div>
<?php } ?>
<table class="credits-table">
	<thead>
		<tr>
			<th class="hidden">ID</th> 
			<th>Artist / Album</th>
			<th>Genre</th>
			<th>Year</th>
			<th>Credits</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	foreach ($result as $credit) {

		// Get image path
		$imageID = $credit['image'];
		$img = $database->get('credit_images', '*', array('id' => $imageID));

		// Get genre name
		$genreID = $credit['genre'];
		$genre = $database->get('genres', '*', array('id' => $genreID));
		
		if($showName){
			// Get engineer name
			$engiID = $credit['engineer_id'];
			$engi = $database->get('engineers', '*', array('id' => $engiID));
		}
		
	?>

	<tr>
		<td class="hidden credit-id">
			<?php echo $credit['id']; ?>
		</td>
		<td class="image-td" style="width:450px;">
			<?php if($img){ ?>
			<?php if($credit['bandcamp_url']){ ?>
			<a href="<?php echo $credit['bandcamp_url']; ?>">
			<?php } ?>
			<img class="lazy" src="/cdn/images/credits/<?php echo $img['small_name']; ?>" alt="<?php echo $credit['album_name']; ?>" />
			<?php } ?>
			<?php if($credit['bandcamp_url']){ ?>
			</a>
			<?php } ?>
			<div>
				<p><?php echo $credit['album_name']; ?></p>
				<p><?php echo $credit['artist_name']; ?></p>
			</div>
			
		</td>
		<td>
			<?php if($genre){ echo $genre['name']; } ?>
		</td>
		<td class="year">
			<?php echo $credit['year']; ?>
		</td>
		
		<td>
			<?php 
			if($showName && $engi){
				echo $engi['name']."<br />"; 
			} 
			?>
			<?php echo $credit['credit']; ?>
		</td>
	</tr>
	<?php } ?>
	<tbody>
</table>
<?php } else { ?>
	<p>No Credits</p>
<?php } ?>

<script>
	$(function(){
		$('.credits-table').dataTable({
			"columnDefs": [
	            {
	                "targets": [ 0 ],
	                "visible": false,
	                "searchable": false
	            }
	        ],
			// "aoColumnDefs": [
	  //     		{ "bSearchable": false, "bVisible": false, "aTargets": [ 0 ] }
	  //   	],
	    	"order": [[ 3, "desc" ], [0, "desc"]],
	    	"deferRender": true
	    	//"ordering": true,
	    	//"sPaginationType": "full_numbers"
		});
	});
</script>

<?php
include 'includes/footer.php';
?>