<?php

// DB Class
Class lelabDB{

	// Variables
	protected $dbname;
	protected $db;

	// Object constructor
	function __construct(){
		$this->dbname = $_SERVER['DOCUMENT_ROOT']."/admin/data/lelab.db";
		$this->connect($this->dbname);
	}

	// Connect to the database
	private function connect($path){
		$this->db = sqlite_open($path, 0777, $err);
	}

	// Create, update or delete an entry in the database
	public function execQuery($query){
		$result = sqlite_exec($this->db, $query, $error);
		if (!$result) {
		    exit("Error in query: '$error'");
		}
		$lastID = sqlite_last_insert_rowid($this->db);
		return $lastID;
	}

	// Query the database
	public function queryDB($query){
        $result = sqlite_query($this->db, $query);
        return $result;
    }

    // Query the database for an array
    public function getArray($query){
    	$result = sqlite_array_query($this->db, $query, SQLITE_ASSOC);
    	return $result;
    }

    // Close the connection to the database
    function __destruct(){
    	sqlite_close($this->db);
    }

}

?>