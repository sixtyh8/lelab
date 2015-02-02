<?php
require_once $_SERVER['DOCUMENT_ROOT']."/api/classes/classes.inc";

$showName = true;

if(isset($_GET['engineer-id'])){
	$engineerID = $_GET['engineer-id'];
} else {
	$engineerID = false;
}

// Get the credits
$obj = new Credit();

if($engineerID){
	$showName = false;
	$result = $obj->listEngineerCredits($engineerID);
	$engiObj = new Engineer();
	$engiName = $engiObj->getEngineerName($engineerID);
} else {
	$result = $obj->all();
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
		$imgObj = new CreditImage();
		$img = $imgObj->getImageName($imageID);

		// Get genre name
		$genreID = $credit['genre'];
		$genreObj = new Genre();
		$genre = $genreObj->getGenreName($genreID);
		
		if($showName){
			// Get engineer name
			$engiID = $credit['engineer_id'];
			$engiObj = new Engineer();
			$engi = $engiObj->getEngineerName($engiID);
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
			<img class="lazy" src="/cdn/images/credits/<?php echo $img[0]['small_name']; ?>" alt="<?php echo $credit['album_name']; ?>" />
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
			<?php if($genre){ echo $genre[0]['name']; } ?>
		</td>
		<td class="year">
			<?php echo $credit['year']; ?>
		</td>
		
		<td>
			<?php 
			if($showName && $engi){
				echo $engi[0]['name']."<br />"; 
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
			"aoColumnDefs": [
	      		{ "bSearchable": false, "bVisible": false, "aTargets": [ 0 ] }
	    	],
	    	"aaSorting": [[ 3, "desc" ], [0, "desc"]],
	    	"sPaginationType": "full_numbers"
		});
	});
</script>

<?php
include 'includes/footer.php';
?>