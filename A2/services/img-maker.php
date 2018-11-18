<?php

//To allow Cross-Origin Request, so that I can fetch php-api into any other IDE other than cloud9
header('Access-Control-Allow-Origin: *');

//developer must specify requsted ?file action in query string to utilize the image maker api
if (isset($_GET['file']) && $_GET['file'] !="" ) {
    
    //file path requested in query string example artists/square/1 
    $file = $_GET['file'];
    
    //out type header set
    header('Content-Type: image/png');
    
    //variable will complete the path for the file example ../images/art/artists/square/1.jpg
    $imgname = "../images/art/$file.jpg";
    
    //image creater function
    $img = imagecreatefromjpeg($imgname);
    
    //check if width is requested in query string otherwise output full image
    if (isset($_GET['width']) ){
        
        //get width from query string
        $width = $_GET['width'];
        
        //project new width and scale image
        $newimg = imagescale($img,$width,$width);
        
        //output new image
        imagejpeg($newimg);
        
    }else{
        
        //output original image
        imagejpeg($img);
    }
    
}

?>