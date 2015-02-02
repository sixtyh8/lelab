<?php
// Album Credits Class
Class Credit {
	private $tableName = 'credits';

	// Create a credit
	public function createCredit($creditObj){
		$lab = new lelabDB();
		$query = "insert into $this->tableName (album_name, 
												artist_name, 
												genre, 
												year, 
												credit, 
												image, 
												engineer_id, 
												bandcamp_url, 
												homepage_flag) 
												values (
												'".stripslashes(sqlite_escape_string($creditObj['album-name']))."', 
												'".stripslashes(sqlite_escape_string($creditObj['artist-name']))."', 
												'".stripslashes(sqlite_escape_string($creditObj['genre-id']))."', 
												'".stripslashes(sqlite_escape_string($creditObj['year']))."', 
												'".stripslashes(sqlite_escape_string($creditObj['credit']))."', 
												'".stripslashes(sqlite_escape_string($creditObj['image-id']))."', 
												'".stripslashes(sqlite_escape_string($creditObj['engineer-id']))."', 
												'".stripslashes(sqlite_escape_string($creditObj['bandcamp-url']))."', 
												'".stripslashes(sqlite_escape_string($creditObj['homepage-flag']))."'
												)";
		$lab->execQuery($query);
		$this->createJson($this->listCredits());
		$this->createTimeline();
	}

	public function importCredit($creditObj){
		$lab = new lelabDB();
		$query = "insert or ignore into $this->tableName (album_name, artist_name, image) values ('".$creditObj['album-name']."', '".$creditObj['artist-name']."', '".$creditObj['image-id']."')";
		$result = $lab->queryDB($query);
		return $result;
	}

	// Return one credit
	public function getOneCredit($creditID){
		$lab = new lelabDB();
		$query = "select * from $this->tableName where id = '$creditID'";
		$result = $lab->getArray($query);
		return $result;
	}

	// Update a credit
	public function updateCredit($creditObj){
		$lab = new lelabDB();
		$query = "update $this->tableName set album_name='".$creditObj['album-name']."', artist_name='".$creditObj['artist-name']."', genre='".$creditObj['genre-id']."', year='".$creditObj['year']."', credit='".$creditObj['credit']."', extra_credit='".$creditObj['extra-credit']."', image='".$creditObj['image-id']."', engineer_id='".$creditObj['engineer-id']."', bandcamp_url='".$creditObj['bandcamp-url']."', homepage_flag='".$creditObj['homepage-flag']."' where id='".$creditObj['creditID']."'";
		$lab->execQuery($query);
		$this->createJson($this->listCredits());
		$this->createTimeline();
	}

	// Delete a credit
	public function deleteCredit($creditID){
		$lab = new lelabDB();
		$query = "delete from $this->tableName where id='$creditID'";
		$lab->execQuery($query);
		$this->createJson($this->listCredits());
		$this->createTimeline();
	}

	// Return list of all credits
	public function listCredits(){
		$lab = new lelabDB();
		$query = "select * from $this->tableName order by year, id DESC";
		$result = $lab->getArray($query);
		return $result;
	}

	public function listEngineerCredits($engineer_id){
		$lab = new lelabDB();
		$query = "select * from $this->tableName where engineer_id = '$engineer_id' order by year, id";
		$result = $lab->getArray($query);
		return $result;
	}

	public function countAlbums($year){
		$lab = new lelabDB();
		$query = "select * from $this->tableName where year like '$year'";
		$result = $lab->getArray($query);
		return $result;
	}

	public function createJson($credits){
		
		$jsonFilename = $_SERVER['DOCUMENT_ROOT']."/includes/credits.json";
		$jsonData = array();

		// Insert each in the array
		foreach ($credits as $credit){

			$img = new CreditImage();
			$currentImage = $img->getImageName($credit['image']);

			$eng = new Engineer();
			$currentEngineer = $eng->getEngineerName($credit['engineer_id']);

			$tempArray = array(
				'image' => $currentImage[0]['thumb_name'],
				'album' => $credit['album_name'],
				'artist' => $credit['artist_name'],
				'genre' => $credit['genre'],
				'year' => $credit['year'],
				'credit' => $credit['credit'],
				'engineer' => $currentEngineer[0]['name'],
				'bandcamp_url' => $credit['bandcamp_url']

			);
			
			if($credit['homepage_flag'] == 1){
				array_push($jsonData, $tempArray);
			}

		}


		// Encode the array to json
		$jsonData = json_encode($jsonData);
		
		// Write the file
		$fp = fopen($jsonFilename, 'w');
		fwrite($fp, $jsonData);
		fclose($fp);

	}

	public function createTimeline(){

		// JSON filename
		$jsonFilename = $_SERVER['DOCUMENT_ROOT']."/includes/timeline.json";


		$start_year = "2000";
		$year_pointer = $start_year;
		$curr_year = date("Y");
		$curr_year = strval($curr_year);
		$years_array = array();

		while($year_pointer <= $curr_year){
			
			$count = $this->countAlbums($year_pointer);
			$num = count($count);
			
			$tempArray = array(
				'year' => $year_pointer,
				'album-count' => $num
			);

			array_push($years_array, $tempArray);

			$year_pointer++;
		}

		// Encode the array to json
		$years_array = json_encode($years_array);
		
		// Write the file
		$fp = fopen($jsonFilename, 'w');
		fwrite($fp, $years_array);
		fclose($fp);

	}

}
?>