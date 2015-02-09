<?php 
// Credit Image Class
Class CreditImage{
	private $tableName = "credit_images";

	public function writeToDB($image_name, $thumb_name, $small_name){
		$lab = new lelabDB();
		$query = "insert or ignore into $this->tableName (image_name, thumb_name, small_name) values ('$image_name', '$thumb_name', '$small_name')";
		$id = $lab->execQuery($query);
		return $id;
	}

	public function getImageName($imageID){
		$lab = new leLabDB();
		$query = "select * from $this->tableName where id = '$imageID'";
		$id = $lab->getArray($query);
		return $id;
	}

	public function checkImage($imageName){
		$lab = new leLabDB();
		$query = "select * from $this->tableName where image_name = '$imageName'";
		$result = $lab->getArray($query);
		return $result;
	}

}

?>