<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

$obj = new Category();
$result = $obj->listCategories();
						
if($result){
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Category</th>
			<th>Parent Category</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($result as $category) { ?>
		<tr>
			<td><?php echo $category['name']; ?></td>
			<td><?php echo $category['parent_id']; ?></td>
			<td><a href="#" class="btn btn-primary btn-mini">Edit</a></td>
			<td><a href="/admin/modules/delete-category.php?categoryID=<?php echo $category['id'] ?>" class="delete-category btn btn-danger btn-mini">Delete</a></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php } else { ?>
	<p>No categories</p>
<?php } ?>