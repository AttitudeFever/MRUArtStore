<?php

require_once ('../includes/sqlCollection.php'); //sql collection package
require_once ('../includes/db-connection.php'); // db connection and JSON making package

//To allow Cross-Origin Request, so that I can fetch php-api into any other IDE other than cloud9
header('Access-Control-Allow-Origin: *');

//Set content type for output
header('Content-Type: application/json');

//check if query string is being asked then set sql accordingly
if (isset($_GET['paintingID'] ) and $_GET['paintingID'] != ""){
    
    //get id from query string
    $paintingID = $_GET['paintingID'];

    //get particular sql querry from the sql collection
    $sql = getPaintingSQL($paintingID);
    
}elseif (isset($_GET['artistID'] ) and $_GET['artistID'] != ""){
    
    //get id from query string
    $artistID = $_GET['artistID'];
    
    //get particular sql querry from the sql collection
    $sql = getPaintingArtistSQL($artistID);
    
}elseif(isset($_GET['galleryID'] ) and $_GET['galleryID'] != ""){
    
    //get id from query string 
    $galleryID = $_GET['galleryID'];

    //get particular sql querry from the sql collection
    $sql = getPaintingGallerySQL($galleryID);
    
}elseif(isset($_GET['genreID'] ) and $_GET['genreID'] != ""){
    
    //get id from query string
    $genreID = $_GET['genreID'];
    
    //get particular sql querry from the sql collection
    $sql = getPaintingGenreSQL($genreID);
    
}elseif(isset($_GET['ratingPID'] ) and $_GET['ratingPID'] != ""){
    
    //get id from query string
    $ratingPID = $_GET['ratingPID'];
    
    //get particular sql querry from the sql collection
    $sql = getRatingSQL($ratingPID);
    
    
}elseif(isset($_GET['pgID'] ) and $_GET['pgID'] != "") {    
    
    //get id from query string (pgID is paintingID in paintingGenres Table)
    $pgID = $_GET['pgID'];
    
    //get particular sql querry from the sql collection
    $sql = getGenreIDFromPaintingGenreSQL($pgID);
    
    
}else{
    
    //get particular sql querry from the sql collection
    $sql = getAllPaintingSQL();
}

//output json object using that particular sql
echo $JSON = generate_JSON_DATA($sql);

?>