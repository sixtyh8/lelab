<?php
// Music Genres Class
Class Genre {
	private $tableName = 'genres';

	// Add a music genre to the DB
	public function addGenre($genreName){
		$genreName = ucwords($genreName);
		$lab = new lelabDB();
		$query = "insert or ignore into $this->tableName (name) values ('$genreName')";
		$result = $lab->execQuery($query);

		$this->createJson($this->listGenres());

		return $result;
	}

	// Get a list of the genres in the DB
	public function listGenres(){
		$lab = new lelabDB();
		$query = "select * from $this->tableName order by name";
		$result = $lab->getArray($query);
		return $result;
	}

	// Update a genre
	public function updateGenre($genreObj){
		$lab = new lelabDB();
		$query = "update $this->tableName set name='".$genreObj['name']."' where id='".$genreObj['id']."'";
		$lab->execQuery($query);
		$this->createJson($this->listGenres());
	}

	public function getGenreName($genreID){
		$lab = new lelabDB();
		$query = "select * from $this->tableName where id='$genreID'";
		$result = $lab->getArray($query);
		return $result;
	}

	// Check if a genre already exists
	public function checkGenre($genreName){
		$lab = new lelabDB();
		$genreName = ucwords($genreName);
		$query = "select * from $this->tableName where name='$genreName'";
		$result = $lab->getArray($query);
		return $result;
	}

	// Delete a genre
	public function deleteGenre($genreID){
		$lab = new lelabDB();
		$query = "delete from $this->tableName where id='$genreID'";
		$lab->execQuery($query);
		$this->createJson($this->listGenres());
	}

	// Search for genre - used by autocomplete
	public function searchGenres($keyword){
		$lab = new lelabDB();
		$query = "select * from $this->tableName where name like '%$keyword%'";
		$result = $lab->getArray($query);
		return $result;
	}

	// Create a json version of the genres DB
	private function createJson($genres){
		$jsonFilename = $_SERVER['DOCUMENT_ROOT']."/admin/data/genres.json";
		$jsonData = array();

		// Insert each in the array
		foreach ($genres as $genre){
			array_push($jsonData, $genre['name']);
		}

		// Encode the array to json
		$jsonData = json_encode($jsonData);
		
		// Write the file
		$fp = fopen($jsonFilename, 'w');
		fwrite($fp, $jsonData);
		fclose($fp);
	}
}

?>