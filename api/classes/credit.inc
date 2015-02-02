<?php
// Album Credits Class
Class Credit {
	private $tableName = 'credits';

	// Create a credit
	public function createCredit($creditObj){
		$lab = new lelabDB();
		$query = "insert into $this->tableName
			(album_name,
			artist_name,
			genre,
			year,
			credit,
			image,
			engineer_id,
			bandcamp_url,
			homepage_flag)
			values (
			'".stripslashes(SQLite3::escapeString($creditObj->album_name))."',
			'".stripslashes(SQLite3::escapeString($creditObj->artist_name))."',
			'".stripslashes(SQLite3::escapeString($creditObj->genre_id))."',
			'".stripslashes(SQLite3::escapeString($creditObj->year))."',
			'".stripslashes(SQLite3::escapeString($creditObj->credit))."',
			'".stripslashes(SQLite3::escapeString($creditObj->image_id))."',
			'".stripslashes(SQLite3::escapeString($creditObj->engineer_id))."',
			'".stripslashes(SQLite3::escapeString($creditObj->bandcamp_url))."',
			'".stripslashes(SQLite3::escapeString($creditObj->homepage_flag))."'
												)";
		$lab->execQuery($query);
		$this->createJson($this->all());
		$this->createTimeline();
	}

	public function importCredit($creditObj){
		$lab = new lelabDB();
		$query = "insert or ignore into $this->tableName (album_name, artist_name, image) values ('$creditObj.album-name', '$creditObj.artist-name', '$creditObj.image-id')";
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

	// Search for credit
	public function searchCredits($keyword){
		$lab = new lelabDB();
		$query = "select * from $this->tableName where (album_name COLLATE UNICODE || artist_name COLLATE UNICODE || year) like '%$keyword%'";
		$result = $lab->getArray($query);
		return $result;
	}

	// Update a credit
	public function updateCredit($creditObj){
		$lab = new lelabDB();
		$query = "update $this->tableName set album_name='".$creditObj->album_name."', artist_name='".$creditObj->artist_name."', genre='".$creditObj->genre_id."', year='".$creditObj->year."', credit='".$creditObj->credit."', extra_credit='".$creditObj->extra_credit."', image='".$creditObj->image_id."', engineer_id='".$creditObj->engineer_id."', bandcamp_url='".$creditObj->bandcamp_url."', homepage_flag='".$creditObj->homepage_flag."' where id='".$creditObj->creditID."'";
		$lab->execQuery($query);
		$this->createJson($this->all());
		$this->createTimeline();
	}

	// Delete a credit
	public function deleteCredit($creditID){
		$lab = new lelabDB();
		$query = "delete from $this->tableName where id='$creditID'";
		$result = $lab->doDelete($query);
		$this->createJson($this->all());
		$this->createTimeline();
		return $result;
	}

	// Return list of all credits
	public function listCredits($limit, $offset){
		$lab = new lelabDB();
		$query = "select * from $this->tableName order by id DESC LIMIT '$offset', '$limit'";
		$result = $lab->getArray($query);
		return $result;
	}

	// Return list of all credits
	public function all(){
		$lab = new lelabDB();
		$query = "select * from $this->tableName order by year, id desc";
		$result = $lab->getArray($query);
		return $result;
	}

	public function listEngineerCredits($engineer_id){
		$lab = new lelabDB();
		$query = "select * from $this->tableName where engineer_id = '$engineer_id' order by year, id";
		$result = $lab->getArray($query);
		return $result;
	}

	public function getTotal(){
		$lab = new lelabDB();
		$query = "select COUNT(*) from $this->tableName";
		$result = $lab->getArray($query);
		return $result;
	}

	// Get last credit
	public function getLast(){
		$lab = new lelabDB();
		$query = "select * from $this->tableName order by id DESC LIMIT 0, 1";
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

		//$jsonFilename = realpath(dirname(__FILE__))."/credits.json";
		//$destinationFolder = chdir("../cdn/data/");
		$jsonFilename = "credits.json";
		$dest = $jsonFilename;
		$jsonData = array();

		// Insert each in the array
		foreach ($credits as $credit){

			$img = new CreditImage();
			$currentImage = $img->getImageName($credit['image']);

			$eng = new Engineer();
			$currentEngineer = $eng->getEngineerName($credit['engineer_id']);

			$tempArray = array(
				'image' => $currentImage,
				'album' => $credit['album_name'],
				'artist' => $credit['artist_name'],
				'genre' => $credit['genre'],
				'year' => $credit['year'],
				'credit' => $credit['credit'],
				'engineer' => "",
				'bandcamp_url' => $credit['bandcamp_url']

			);

			if($currentEngineer){
				$tempArray['engineer'] = $currentEngineer[0]['name'];
			}

			if($credit['homepage_flag'] == 1){
				array_push($jsonData, $tempArray);
			}

		}


		// Encode the array to json
		$jsonData = json_encode($jsonData);

		// Write the file
		$fp = fopen($dest, 'w');
		fwrite($fp, $jsonData);
		fclose($fp);

	}

	public function createTimeline(){

		// JSON filename
		//$jsonFilename = realpath(dirname(__FILE__))."/timeline.json";
		//$destinationFolder = chdir("../cdn/data/");
		$jsonFilename = "timeline.json";
		$dest = $jsonFilename;


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
		$fp = fopen($dest, 'w');
		fwrite($fp, $years_array);
		fclose($fp);

	}

}
?>