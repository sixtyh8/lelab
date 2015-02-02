<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/admin/classes/classes.inc";

/* 
* Importing existing images to database and save image with it's thumbnails in the right directory 
*/

// Variables
$localPath = $_SERVER['DOCUMENT_ROOT'];
$outputFile = $localPath.'/admin/data/test.json';

include $localPath.'/includes/covers-import.php';

$index = 1;

// Initialize the new Credit object
$obj = new Credit();

foreach ($covers as $cover) { 

    $filename = $cover['img'];
    $album = $cover["album"];
    $artist = $cover["title"];

    // Write to credits DB
    $creditObj =  array();
    $creditObj['album-name'] = $album;
    $creditObj['artist-name'] = $artist;
    $creditObj['image-id'] = $index;
    
    // Call createCredit
    $result = $obj->importCredit($creditObj);

    treatImage($filename);

    echo "Done adding credit " . $index . " and it's image.<br />";
    
    $index++;
}

function treatImage($filename){

    // Random number for both file, will be added after image name
    $RandomNumber   = rand(0, 9999999999);

    // Elements (values) of $filename array
    //let's access these values by using their index position
    $originFolder = $_SERVER['DOCUMENT_ROOT'].'/img/covers/';
    $destinationFolder = $_SERVER['DOCUMENT_ROOT'].'/img/credits/';
    $originImagePath = $originFolder.$filename;
    $ImageName      = $filename;
    $ImageSize      = getimagesize($originImagePath); // Obtain original image size
    $TempSrc        = $destinationFolder.'/tmp/tmp-'.$filename; // Tmp name of image file stored in PHP tmp folder
    $ImageType      = exif_imagetype($originFolder.$filename); //Obtain file type, returns "image/png", image/jpeg, text/plain etc.
    $ImageType      = image_type_to_mime_type($ImageType);
    $ThumbSquareSize        = 150; //Thumbnail will be 150x150
    $SmallThumbSize         = 80; //Small Thumbnail 80x80
    $BigImageMaxSize        = 500; //Image Maximum height or width
    $ThumbPrefix            = "thumb_"; //Normal thumb Prefix
    $SmallPrefix            = "small_";
    $DestinationDirectory   = $destinationFolder; //Upload Directory ends with / (slash)
    $Quality                = 90;

    copy($originImagePath, $TempSrc);
 
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

    //Construct a new image name (with random number added) for our new image.
    $NewImageName = $filename;
    $ThumbImageName = $ThumbPrefix.$NewImageName;
    $SmallImageName = $SmallPrefix.$NewImageName;

    //set the Destination Image
    $thumb_DestRandImageName    = $DestinationDirectory.$ThumbPrefix.$NewImageName; //Thumb name
    $small_DestRandImageName    = $DestinationDirectory.$SmallPrefix.$NewImageName; // Small Name
    $DestRandImageName          = $DestinationDirectory.$NewImageName; //Name for Big Image


    //Resize image to our Specified Size by calling resizeImage function.
    if(resizeImage($CurWidth,$CurHeight,$BigImageMaxSize,$DestRandImageName,$CreatedImage,$Quality,$ImageType))
    {
        //Create a square Thumbnail right after, this time we are using cropImage() function
        if(!cropImage($CurWidth,$CurHeight,$ThumbSquareSize,$thumb_DestRandImageName,$CreatedImage,$Quality,$ImageType))
            {
                echo 'Error Creating thumbnail';
            }

        if(!cropImage($CurWidth,$CurHeight,$SmallThumbSize,$small_DestRandImageName ,$CreatedImage,$Quality,$ImageType))
            {
                echo 'Error creating small size';
            }

        //Get New Image Size
        list($ResizedWidth,$ResizedHeight)=getimagesize($DestRandImageName);

        //echo '<img src="/img/credits/'.$ThumbPrefix.$NewImageName.'" alt="Thumbnail" height="'.$ThumbSquareSize.'" width="'.$ThumbSquareSize.'" />';

        // Insert info into database table!
        $imgObj = new CreditImage();
        $imageID = $imgObj->writeToDB($NewImageName, $ThumbImageName, $SmallImageName);


    } else {
        die('Resize Error'); //output error
    }
    
}

// This function will proportionally resize image
function resizeImage($CurWidth,$CurHeight,$MaxSize,$DestFolder,$SrcImage,$Quality,$ImageType)
{
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

}

//This function corps image to create exact square images, no matter what its original size!
function cropImage($CurWidth,$CurHeight,$iSize,$DestFolder,$SrcImage,$Quality,$ImageType)
{
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
    if(is_resource($NewCanves)) {imagedestroy($NewCanves);}
    return true;

    }

}
?>