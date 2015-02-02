<?php
// Category Class
Class Category {
	private $tableName = 'categories';

	// Create a category
	public function create($obj){
		$lab = new lelabDB();
		$query = "insert into $this->tableName (name, parent_id) 
												values (
												'".$obj['name']."',
												'".$obj['parent_id']."'
												)";
		$lab->execQuery($query);
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
		$query = "update $this->tableName set name='".$obj['name']."', parent_id='".$obj['parent_id']."' where id='".$obj['id']."'";
		$lab->execQuery($query);
	}

	// Delete a category
	public function delete($id){
		$lab = new lelabDB();
		$query = "delete from $this->tableName where id='$id'";
		$lab->execQuery($query);
	}

	// Return list of all categories
	public function listCategories(){
		$lab = new lelabDB();
		$query = "select * from $this->tableName order by id";
		$result = $lab->getArray($query);
		return $result;
	}


}
?>