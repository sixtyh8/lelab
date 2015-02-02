<?php

require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

$obj = new User();
$result = $obj->listUsers();
						
if($result){
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Username</th>
			<th>Password</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($result as $user) { ?>
		<tr>
			<td>
				<a class="editable" title="Edit" href="#" id="user-<?php echo $user['id'] ?>" data-type="text" data-pk="<?php echo $user['id'] ?>" data-name="username" data-url="/admin/actions/edit-user.php" data-original-title="Enter Username"><?php echo $user['username']; ?></a>

			</td>
			<td>
				<a class="editable" title="Edit" href="#" id="password-<?php echo $user['id'] ?>"><?php echo $user['password']; ?></a>
			</td>
		</tr> 
	<?php } ?>
	</tbody>
</table>
<?php } else { ?>
	<p>No Users</p>
<?php } ?>