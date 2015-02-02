<?php

require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

$obj = new Credit();
$result = $obj->listCredits();
						
if($result){
?>
<table class="table table-striped table-bordered datatable" id="credits-table">
	<thead>
		<tr>
			<th class="credit-id">ID</th>
			<th class="cover-th">Cover</th>
			<th class="album-th">Album/Artist</th>
			<th class="genre-th">Genre</th>
			<th class="year-th">Year</th>
			<th class="engineer-th">Engineer</th>
			<th class="credit-th">Credit</th>
			<th class="extra-th">Extra Credit</th>
			<th class="actions-th"></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($result as $credit) {

		// Get image URL
		$imageID = $credit['image'];
		$imgObj = new CreditImage();
		$img = $imgObj->getImageName($imageID);

		// Get genre name
		$genreID = $credit['genre'];
		$genreObj = new Genre();
		$genre = $genreObj->getGenreName($genreID);

		// Get engineer name
		$engiID = $credit['engineer_id'];
		$engiObj = new Engineer();
		$engi = $engiObj->getEngineerName($engiID);
		
		$trClassName = "";
		
		if($credit['homepage_flag'] != 1){
			$trClassName = 'homepage-off';
		}
	?>
		
		<tr class="<?php echo $trClassName; ?>">
			<td class="credit-id">
				<?php if($credit['homepage_flag'] != 1){ ?>
				<div class="homepage-off-message">
					<a href="#" class="tooltip" title="Hidden on homepage">
					<i class="icon-eye-open"></i>
					</a>
				</div>
				<?php } ?>
				<?php echo $credit['id']; ?>
			</td>
			<td>
				<?php if($img){ ?>
					<?php if($credit['bandcamp_url']){ ?>
						<a href="<?php echo $credit['bandcamp_url']; ?>">
					<?php } ?>
					<img src="/img/credits/<?php echo $img[0]['small_name']; ?>" alt="<?php echo $credit['album_name']; ?>" height="80" width="80" />
					<?php if($credit['bandcamp_url']){ ?>
						</a>
					<?php } ?>
				<?php } ?>
			</td>
			<td><?php echo $credit['album_name']; ?><br /><?php echo $credit['artist_name']; ?></td>
			<td><?php if($genre){ echo $genre[0]['name']; } ?></td>
			<td><?php echo $credit['year']; ?></td>
			<td><?php if($engi){ echo $engi[0]['name']; } ?></td>
			<td><?php echo $credit['credit']; ?></td>
			<td><?php echo $credit['extra_credit']; ?></td>
			<td>
				<a href="/admin/blocks/edit-credits.php?creditID=<?php echo $credit['id'] ?>" class="edit-credit btn btn-small pull-right"><i class="icon-edit"></i> Edit</a>
				
				<a href="/admin/actions/delete-credit.php?creditID=<?php echo $credit['id'] ?>" class="delete-credit btn btn-danger btn-small pull-right confirm" title="delete this credit"><i class="icon-trash icon-white"></i> Delete</a>
			</td>
		</tr> 
	<?php } ?>
	</tbody>
</table>
<?php } else { ?>
	<p>No Credits in the database. <a href="#add-modal" data-toggle="modal">Add a Credit</a> to get started.</p>
<?php } ?>