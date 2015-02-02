<?php
session_start();
if(isset($_SESSION['EM_SESSION'])) {
	header('Location: ../e-mastering/');
}
																									  
if(isset($_POST['login']) && isset($_POST['password'])){
	if($_POST['login'] == 'labUser' && $_POST['password'] == 'X9Z78buw77'){
		$_SESSION['EM_SESSION'] = 'true';
		header('Location: ../e-mastering/');
	} else {
		$error = 'Sorry, an error occurs. Please make sure your Login and Password are valid.';
	}
} else {
	
}

$metaTITLE['fr'] = 'E-Mastering';
$metaTITLE['en'] = 'E-Mastering';
$bodyClass = 'e-mastering';

include '../includes/header.php';
?>

<div class="right-box" id="e-mastering-box">
	<div class="right-box-top"></div>
    <div class="right-box-content">
    	<h2>Login</h2>
        <form id="e-mastering-login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        	<p>
            <label for="login">Login</label>
            <input type="text" maxlength="25" name="login" tabindex="1"  />
            </p>
            <p>
            <label for="password">Password</label>
            <input type="password" maxlength="25" name="password" tabindex="2" />
            </p>
            <p style="text-align:right;"><input type="submit" class="submit" value="Connect" /></p>
            <?php if(isset($error)) echo '<p style="color:red">'.$error.'</p>'; ?>
        </form>
    </div>
    <div class="right-box-bottom"></div>
</div>

<?php
include '../includes/footer.php';
?>