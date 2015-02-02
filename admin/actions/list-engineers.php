<?php

require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

$obj = new Engineer();
$result = $obj->listEngineers();

if($result){
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th style="width:400px;">Engineer - Click name to edit</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($result as $engi) {
?>
		<tr>
			<td><a class="editable" title="Edit" href="#" id="engineer-<?php echo $engi['id'] ?>" data-type="text" data-pk="<?php echo $engi['id'] ?>" data-name="name" data-url="/admin/actions/edit-engineer.php" data-original-title="Enter name"><?php echo $engi['name']; ?></a></td>
			<td><a href="/admin/actions/delete-engineer.php?engiID=<?php echo $engi['id'] ?>" class="delete-engineer btn btn-danger btn-small pull-right"><i class="icon-trash icon-white"></i> Delete</a></td>
		</tr>
<?php 
	}
?>	</tbody>
</table>
<?php
} else {
?>
<p>No engineers in the database</p>
<?php
} 
?>