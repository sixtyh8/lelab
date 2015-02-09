<?php
// Category Class
Class Whitepaper {
	private $tableName = 'whitepapers';

	// Create a category
	public function create($obj){
		$lab = new lelabDB();
		$query = "insert into $this->tableName (title, body, created_at) values ('".$obj->title."', '".$obj->body."', '".$obj->created_at."')";
		$result = $lab->execQuery($query);
		return $result;
	}

	// Return one category
	public function getOne($id){
		$lab = new lelabDB();
		$query = "select * from $this->tableName where id = '$id'";
		$result = $lab->getArray($query);
		return $result;
	}

	// Update a category
	public function update($obj){
		$lab = new lelabDB();
		$query = "update $this->tableName set title='".$obj->title."', body='".$obj->body."', updated_at='".$obj->updated_at."' where id='".$obj->id."'";
		$result = $lab->execQuery($query);
		return $result;
	}

	// Delete a category
	public function delete($id){
		$lab = new lelabDB();
		$query = "delete from $this->tableName where id='$id'";
		$result = $lab->execQuery($query);
		return $result;
	}

	// Return list of all categories
	public function listWhitepapers(){
		$lab = new lelabDB();
		$query = "select * from $this->tableName order by id DESC";
		$result = $lab->getArray($query);
		return $result;
	}

	// Search for credit
	public function searchWhitepapers($keyword){
		$lab = new lelabDB();
		$query = "select * from $this->tableName where (title COLLATE UNICODE || body COLLATE UNICODE) like '%$keyword%' order by id DESC";
		$result = $lab->getArray($query);
		return $result;
	}

	// Get total
	public function getTotal(){
		$lab = new lelabDB();
		$query = "select COUNT(*) from $this->tableName";
		$result = $lab->count($query);
		return $result;
	}

	// Get last
	public function getLast(){
		$lab = new lelabDB();
		$query = "select * from $this->tableName order by id DESC LIMIT 0, 1";
		$result = $lab->getArray($query);
		return $result;
	}

}
?>