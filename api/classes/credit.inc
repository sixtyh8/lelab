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
			'".stripslashes(SQLite3::escapeString($creditObj->homepage_flag))."')";

		$lab->execQuery($query);
		$this->createJson($this->all());
		$this->createTimeline();
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
		$query = "delete from $this->tableName where id = '$creditID'";
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

	// List all the credits for a given engineer
	public function listEngineerCredits($engineer_id){
		$lab = new lelabDB();
		$query = "select * from $this->tableName where engineer_id = '$engineer_id' order by year, id";
		$result = $lab->getArray($query);
		return $result;
	}

	// Get total number of credits
	public function getTotal(){
		$lab = new lelabDB();
		$query = "select COUNT(*) from $this->tableName";
		$result = $lab->count($query);
		return $result;
	}

	// Get last credit
	public function getLast(){
		$lab = new lelabDB();
		$query = "select * from $this->tableName order by id DESC LIMIT 0, 1";
		$result = $lab->getArray($query);
		return $result;
	}

	// Count albums for a given year
	public function countAlbums($year){
		$lab = new lelabDB();
		$query = "select * from $this->tableName where year like '$year'";
		$result = $lab->getArray($query);
		return $result;
	}

	// Create the credits JSON file to be used on the homepage slider
	public function createJson($credits){

		// JSON filename
		$jsonFilename = "credits.json";
		$dest = $jsonFilename;
		$jsonData = array();

		// Insert each in the array
		foreach ($credits as $credit){

			// If the credit shouldn't be displayed on the homepage, return
			if($credit['homepage_flag'] != 1){
				return;
			}

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

			array_push($jsonData, $tempArray);

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

	public function removeAccents($term){
		// Define unwanted accents
		$unwanted_array = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',	'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
		
		// Replace it in the string
		$str = strtr( $term, $unwanted_array );

		// Return
		return $str;
	}

}
?>