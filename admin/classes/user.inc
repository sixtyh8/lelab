<?php
// User Class
Class User {
	private $tableName = 'users';

	// Create a user
	public function createUser($username, $password){
		$lab = new lelabDB();
		$query = "insert into $this->tableName (username, password) values ('$username', '$password')";
		$lab->execQuery($query);	
	}

	// Update a user
	public function updateUser($username, $password, $userID){
		$lab = new lelabDB();
		$query = "update $this->tableName set username='$username', password='$password' where id='$userID'";
		$lab->execQuery($query);
	}

	// Delete a user
	public function deleteUser($userID){
		$lab = new lelabDB();
		$query = "delete from $this->tableName where id='$userID'";
		$lab->execQuery($query);
	}

	// Return list of all users
	public function listUsers(){
		$lab = new lelabDB();
		$query = "select * from $this->tableName order by id";
		$result = $lab->getArray($query);
		return $result;
	}

	// Check if a user exists
	public function checkUser($username, $password){
		$lab = new lelabDB();
		$query = "select * from $this->tableName where username='$username' and password='$password'";
		$result = $lab->getArray($query);
		return $result;
	}


}
?>