<?php
// Session Class
Class Session {
	private $indexPath;
	private $loginPath;

	function __construct(){
		// Define the paths
		$this->indexPath = $_conf['path']['base_url']."/admin/index.php";
		$this->loginPath = $_conf['path']['base_url']."/admin/login.php";
	}

	// Login
	public function login($username, $password){
		$usr = new User();
		$result = $usr->checkUser($username, $password);
		
		// If user exists
		if($result){
			// Start session
			session_start();
			// Add username to session
			$_SESSION['username'] = $result[0]['username'];
			// Redirect to index
			header("Location: $this->indexPath");
		} else {
			// Redirect to login
			header("Location: $this->loginPath");
		}
		
	}

	// Logout
	public function logout(){
		session_start();
		session_destroy();
		header("Location: $this->loginPath");
	}
}
?>