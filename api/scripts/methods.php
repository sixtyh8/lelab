<?php

Flight::map('formatCredit', function($result){

    $cleanResults = array();

    $database = Flight::get('database');

    foreach ($result as $credit) {

        // Get image URL
        $imageID = $credit['image'];
        $credit['imgName'] = $database->select('credit_images', '*', array('id' => $imageID));

        // Get genre name
        $genreID = $credit['genre'];
        $credit['genreName'] = $database->select("genres", "*", array('id' => $genreID));

        // Get engineer name
        $engiID = $credit['engineer_id'];
        $credit['engi'] = $database->select("engineers", "*", array('id' => $engiID));

        // Get extra credit engineer name
        if($credit['extra_credit_engineer_id']){
            $extraEngiID = $credit['extra_credit_engineer_id'];
            $credit['extra_credit_engi'] = $database->select("engineers", "*", array('id' => $extraEngiID));
        }

        $credit['trClassName'] = "";

        if($credit['homepage_flag'] != 1){
            $credit['trClassName'] = 'homepage-off';
        }

        array_push($cleanResults, $credit);

    }

    return $cleanResults;
});

Flight::map('treatImage', function($image){

	//Some Settings
    $ThumbSquareSize        = 150; //Thumbnail will be 150x150
    $SmallThumbSize         = 80; //Small Thumbnail 80x80
    $BigImageMaxSize        = 500; //Image Maximum height or width
    $ThumbPrefix            = "thumb_"; //Normal thumb Prefix
    $SmallPrefix            = "small_";
    $DestinationDirectory   = chdir("../cdn/images/credits/");//$_SERVER['DOCUMENT_ROOT']."/cdn/images/credits/"; //chdir("../../cdn/images/credits/"); //Upload Directory ends with / (slash)
    $Quality                = 90;
    $response               = array();
    $filename               = $image['name'];

    // Random number for both file, will be added after image name
    $RandomNumber   = rand(0, 9999999999);

    // Elements (values) of $_FILES['ImageFile'] array
    //let's access these values by using their index position
    $ImageName		= str_replace(' ','',strtolower($filename));
    $ImageSize      = $image['size']; // Obtain original image size
    $TempSrc        = $image['tmp_name']; // Tmp name of image file stored in PHP tmp folder
    $ImageType      = $image['type']; //Obtain file type, returns "image/png", image/jpeg, text/plain etc.

    //Let's use $ImageType variable to check wheather uploaded file is supported.
    //We use PHP SWITCH statement to check valid image format, PHP SWITCH is similar to IF/ELSE statements
    //suitable if we want to compare the a variable with many different values
    switch(strtolower($ImageType))
    {
        case 'image/png':
            $CreatedImage =  imagecreatefrompng($TempSrc);
            break;
        case 'image/gif':
            $CreatedImage =  imagecreatefromgif($TempSrc);
            break;
        case 'image/jpeg':
        case 'image/pjpeg':
            $CreatedImage = imagecreatefromjpeg($TempSrc);
            break;
        default:
            die('Unsupported File!'); //output error and exit
    }

    //PHP getimagesize() function returns height-width from image file stored in PHP tmp folder.
    //Let's get first two values from image, width and height. list assign values to $CurWidth,$CurHeight
    list($CurWidth,$CurHeight)=getimagesize($TempSrc);
    //Get file extension from Image name, this will be re-added after random name
    $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
    //$ImageExt = str_replace('.','',$ImageExt);

    //remove extension from filename
    $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
    // Remove unwanted characters from name
    $ImageName		= preg_replace ("/([^A-Za-z0-9\+_\-,]+)/", "", $ImageName);

    //Construct a new image name (with random number added) for our new image.
    $NewImageName = $ImageName.$ImageExt;
    $ThumbImageName = $ThumbPrefix.$NewImageName;
    $SmallImageName = $SmallPrefix.$NewImageName;

    //set the Destination Image
    $thumb_DestRandImageName    = $ThumbPrefix.$NewImageName; //Thumb name
    $small_DestRandImageName    = $SmallPrefix.$NewImageName; // Small Name
    $DestRandImageName          = $NewImageName; //Name for Big Image


    //Resize image to our Specified Size by calling resizeImage function.
    if(Flight::resizeImage($CurWidth,$CurHeight,$BigImageMaxSize,$DestRandImageName,$CreatedImage,$Quality,$ImageType))
    {
        //Create a square Thumbnail right after, this time we are using cropImage() function
        if(!Flight::cropImage($CurWidth,$CurHeight,$ThumbSquareSize,$thumb_DestRandImageName,$CreatedImage,$Quality,$ImageType))
            {
                echo 'Error Creating thumbnail';
            }

        if(!Flight::cropImage($CurWidth,$CurHeight,$SmallThumbSize,$small_DestRandImageName ,$CreatedImage,$Quality,$ImageType))
            {
                echo 'Error creating small size';
            }
        /*
        At this point we have succesfully resized and created thumbnail image
        We can render image to user's browser or store information in the database
        For demo, we are going to output results on browser.
        */

        //Get New Image Size
        list($ResizedWidth,$ResizedHeight)=getimagesize($DestRandImageName);

        //echo '<img src="/img/credits/'.$ThumbPrefix.$NewImageName.'" alt="Thumbnail" height="'.$ThumbSquareSize.'" width="'.$ThumbSquareSize.'" />';

        // Insert info into database table!
        $imageID = Flight::get('database')->insert('credit_images', array(
            'image_name' => $NewImageName, 
            'thumb_name' => $ThumbImageName, 
            'small_name' => $SmallImageName
        ));

        // If the image wasn't written to DB, get it's ID
        if($imageID == 0){
            $id = Flight::get('database')->get('credit_images', '*', array('image_name' => $NewImageName));
            $imageID = $id['id'];
        }

        $response['image'] = $ThumbImageName;
        $response['imageID'] = $imageID;

        return $response;

    } else {
        return 'Resize Error'; //output error
    }

});

Flight::map('resizeImage', function($CurWidth,$CurHeight,$MaxSize,$DestFolder,$SrcImage,$Quality,$ImageType){
	//Check Image size is not 0
    if($CurWidth <= 0 || $CurHeight <= 0)
    {
        return false;
    }

    //Construct a proportional size of new image
    $ImageScale         = min($MaxSize/$CurWidth, $MaxSize/$CurHeight);
    $NewWidth           = ceil($ImageScale*$CurWidth);
    $NewHeight          = ceil($ImageScale*$CurHeight);

    if($CurWidth < $NewWidth || $CurHeight < $NewHeight)
    {
        $NewWidth = $CurWidth;
        $NewHeight = $CurHeight;
    }
    $NewCanves  = imagecreatetruecolor($NewWidth, $NewHeight);
    // Resize Image
    if(imagecopyresampled($NewCanves, $SrcImage,0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight))
    {
        switch(strtolower($ImageType))
        {
            case 'image/png':
                imagepng($NewCanves,$DestFolder);
                break;
            case 'image/gif':
                imagegif($NewCanves,$DestFolder);
                break;
            case 'image/jpeg':
            case 'image/pjpeg':
                imagejpeg($NewCanves,$DestFolder,$Quality);
                break;
            default:
                return false;
        }
    //Destroy image, frees up memory
    if(is_resource($NewCanves)) {imagedestroy($NewCanves);}
    return true;
    }
});

Flight::map('cropImage', function($CurWidth,$CurHeight,$iSize,$DestFolder,$SrcImage,$Quality,$ImageType){
	//Check Image size is not 0
    if($CurWidth <= 0 || $CurHeight <= 0)
    {
        return false;
    }

    //abeautifulsite.net has excellent article about "Cropping an Image to Make Square"
    //http://www.abeautifulsite.net/blog/2009/08/cropping-an-image-to-make-square-thumbnails-in-php/
    if($CurWidth>$CurHeight)
    {
        $y_offset = 0;
        $x_offset = ($CurWidth - $CurHeight) / 2;
        $square_size    = $CurWidth - ($x_offset * 2);
    }else{
        $x_offset = 0;
        $y_offset = ($CurHeight - $CurWidth) / 2;
        $square_size = $CurHeight - ($y_offset * 2);
    }

    $NewCanves  = imagecreatetruecolor($iSize, $iSize);
    if(imagecopyresampled($NewCanves, $SrcImage,0, 0, $x_offset, $y_offset, $iSize, $iSize, $square_size, $square_size))
    {
        switch(strtolower($ImageType))
        {
            case 'image/png':
                imagepng($NewCanves,$DestFolder);
                break;
            case 'image/gif':
                imagegif($NewCanves,$DestFolder);
                break;
            case 'image/jpeg':
            case 'image/pjpeg':
                imagejpeg($NewCanves,$DestFolder,$Quality);
                break;
            default:
                return false;
        }
    
    //Destroy image, frees up memory
    if(is_resource($NewCanves)) {
        imagedestroy($NewCanves);
    }
    
    return true;

    }
});

Flight::map('createCreditsJson', function(){

    // JSON filename
    $jsonFilename = "credits.json";
    $dest = $jsonFilename;
    $jsonData = array();
    $database = Flight::get('database');

    $credits = $database->select('credits', '*', array('ORDER' => 'year DESC'));

    // Insert each in the array
    foreach ($credits as $credit){

        // If the credit shouldn't be displayed on the homepage, return
        if($credit['homepage_flag'] != 1){
            return;
        }

        $currentImage = $database->get('credit_images', '*', array('id' => $credit['image']));
        $currentEngineer = $database->get('engineers', '*', array('id' => $credit['engineer_id']));

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
            $tempArray['engineer'] = $currentEngineer['name'];
        }

        array_push($jsonData, $tempArray);

    }

    // Encode the array to json
    $jsonData = json_encode($jsonData);

    // Write the file
    $fp = fopen($dest, 'w');
    fwrite($fp, $jsonData);
    fclose($fp);
});

Flight::map('createTimelineJson', function(){
    
    // JSON filename
    $jsonFilename = "timeline.json";
    $dest = $jsonFilename;

    $start_year = "2000";
    $year_pointer = $start_year;
    $curr_year = date("Y");
    $curr_year = strval($curr_year);
    $years_array = array();

    while($year_pointer <= $curr_year){

        $num = Flight::get('database')->count('credits', array('year' => $year_pointer));

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

});

Flight::map('createGenreJson', function(){
    
    $jsonFilename = "genres.json";
    $jsonData = array();
    $genres = Flight::get('database')->select('genres', '*', array('ORDER' => 'name'));

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

});

?>