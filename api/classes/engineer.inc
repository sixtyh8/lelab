<?php
// Album Credits Class
Class Engineer {
	private $tableName = 'engineers';

	// Create an engineer
	public function createEngineer($name){
		$lab = new lelabDB();
		$query = "insert into $this->tableName (name) values ('$name')";
		$lab->execQuery($query);	
	}

	// Update an engineer
	public function updateEngineer($engiObj){
		$lab = new lelabDB();
		$query = "update $this->tableName set name='".$engiObj->name."' where id='".$engiObj->id."'";
		$lab->execQuery($query);
	}

	// Delete an engineer
	public function deleteEngineer($id){
		$lab = new lelabDB();
		$query = "delete from $this->tableName where id='$id'";
		$lab->execQuery($query);
	}

	// Return list of all engineers
	public function listEngineers(){
		$lab = new lelabDB();
		$query = "select * from $this->tableName order by id";
		$result = $lab->getArray($query);
		return $result;
	}

	// Return engineer name
	public function getEngineerName($engiID){
		$lab = new lelabDB();
		$query = "select * from $this->tableName where id='$engiID'";
		$result = $lab->getArray($query);
		return $result;
	}

}
?>