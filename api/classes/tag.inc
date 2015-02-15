<?php
// Tag Class
Class Tag {
	private $tableName = 'tags';

	// Create a Tag
	public function create($label){
		$lab = new lelabDB();
		$query = "insert into $this->tableName (name) values ('$label')";
		$result = $lab->execQuery($query);
		return $result;
	}

	// Return one Tag
	public function getTag($id){
		$lab = new lelabDB();
		$query = "select * from $this->tableName where id = '$id'";
		$result = $lab->getArray($query);
		return $result;
	}

	// Return one Tag
	public function checkTag($name){
		$lab = new lelabDB();
		$query = "select * from $this->tableName where name = '$name'";
		$result = $lab->getArray($query);
		return $result;
	}

	// Update a Tag
	public function update($tagObj){
		$lab = new lelabDB();
		$query = "update $this->tableName set name='".$tagObj->name."' where id='".$tagObj->id."'";
		$result = $lab->queryDB($query);
		return $result;
	}

	// Get total
	public function getTotal(){
		$lab = new lelabDB();
		$query = "select COUNT(*) from $this->tableName";
		$result = $lab->count($query);
		return $result;
	}

	// Delete a Tag
	public function delete($id){
		$lab = new lelabDB();
		// $query = "DELETE FROM $this->tableName WHERE id='$id'";
		// $result = $lab->doDelete($query);
		$result = $id;
		return $result;
	}

	// Return list of all Tags
	public function listTags(){
		$lab = new lelabDB();
		$query = "select * from $this->tableName order by id";
		$result = $lab->getArray($query);
		return $result;
	}

}
?>