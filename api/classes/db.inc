<?php
Class lelabDB{

	// Variables
	protected $db;

	// Object constructor
	function __construct(){
	   $this->db = new PDO('mysql:host=localhost;dbname=lelab', 'root', '');
       if(!$this->db){
          echo $db->lastErrorMsg();
       }
	}

	// Create, update or delete an entry in the database
	public function execQuery($query){
		$result = $this->db->exec($query);
		$lastID = $this->db->lastInsertRowID();
		return $lastID;
	}

	// Query the database
	public function queryDB($query){
        $result = $this->db->query($query);
        return $result;
    }

    // Query the database for an array
    public function getArray($query){
    	$results = $this->db->query($query);
        $arr = array();

        while ($row = $results->fetchArray()) {
            array_push($arr, $row);
        }

    	return $arr;
    }

}

?>
