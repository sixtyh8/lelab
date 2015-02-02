<?php

$metaTITLE['fr'] = 'Admin';
$metaTITLE['en'] = 'Admin';
$bodyClass = 'admin';
$currentSectionTitle = 'Admin Login';

include 'blocks/header.php';
?>

<form action="/admin/actions/login.php" method="post" class="form-signin">
	<input type="text" name="username" class="input-block-level" value="" placeholder="Username" />
	<input type="password" name="password" class="input-block-level" value="" placeholder="Password" />
	<button type="submit" class="btn btn-large btn-primary">Login</button>
</form>

<?php
include 'blocks/footer.php';
?>