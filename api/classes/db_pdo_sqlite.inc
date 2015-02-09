<?php

Class lelabDB{

	// Variables
	protected $db;

	// Object constructor
	function __construct(){
        // Get the DB path
        $dbname = realpath(dirname(__FILE__))."/lelab.db";
        $path = 'sqlite:'.$dbname;

		$this->db = new PDO($path);
        
        if(!$this->db){
            echo $db->lastErrorMsg();
        }
	}

	// Create, update or delete an entry in the database
	public function execQuery($query){
		$result = $this->db->exec($query);
		$lastID = $this->db->lastInsertId();
		return $lastID;
	}

    public function doDelete($query){
        $result = $this->db->exec($query);
        return $result;
    }

    public function count($query){
        $result = $this->db->query($query);
        $rows = $result->fetch(PDO::FETCH_NUM);
        return $rows;
    }

	// Query the database
	public function queryDB($query){
        $obj = $this->db->query($query);
        $result = $obj->fetchAll();
        return $result;
    }

    // Query the database for an array
    public function getArray($query){
    	$results = $this->db->query($query);
        $resultArray = $results->fetchAll();
    	return $resultArray;
    }

}

?>