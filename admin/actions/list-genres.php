<?php

require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

$obj = new Genre();
$result = $obj->listGenres();

if($result){
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th style="width:400px;">Genre Name - Click to edit</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($result as $genre) {
?>
		<tr>
			<td><a class="editable" title="Edit" href="#" id="genre-<?php echo $genre['id'] ?>" data-type="text" data-pk="<?php echo $genre['id'] ?>" data-name="name" data-url="/admin/actions/edit-genre.php" data-original-title="Enter genre"><?php echo $genre['name']; ?></a></td>
			<td><a href="/admin/actions/delete-genre.php?genreID=<?php echo $genre['id'] ?>" class="delete-genre btn btn-danger btn-small pull-right"><i class="icon-trash icon-white"></i> Delete</a></td>
		</tr>
<?php 
	}
?>	</tbody>
</table>
<?php
} else {
?>
<p>No genres in the database</p>
<?php
} 
?>