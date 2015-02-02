<?php
// User Class
Class User {
	private $tableName = 'users';

	// Create a user
	public function create($username, $password, $admin, $email){
		$lab = new lelabDB();
		$query = "insert into $this->tableName (username, password, admin, email) values ('$username', '$password', '$admin', '$email')";
		$result = $lab->execQuery($query);
		return $result;
	}

	// Update a user
	public function updateUser($userObj){
		$lab = new lelabDB();
		$query = "update $this->tableName set username='".$userObj->username."', email='".$userObj->email."', admin='".$userObj->admin."', password='".$userObj->password."' where id='".$userObj->id."'";
		$result = $lab->execQuery($query);
		return $result;
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

	public function showUser($id){
		$lab = new lelabDB();
		$query = "select * from $this->tableName where id='$id'";
		$result = $lab->getArray($query);
		return $result;
	}

	// Check if a user exists
	public function authenticate($username, $password){
		$lab = new lelabDB();
		$query = "select * from $this->tableName where username='$username' or email='$username' and password='$password'";
		$result = $lab->getArray($query);
		return $result;
	}


}
?>