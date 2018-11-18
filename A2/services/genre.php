<?php

require_once ('../includes/sqlCollection.php'); //sql collection package
require_once ('../includes/db-connection.php'); // db connection and JSON making package


//To allow Cross-Origin Request, so that I can fetch php-api into any other IDE other than cloud9
header('Access-Control-Allow-Origin: *');

//Set content type for output
header('Content-Type: application/json');

//check if query string is being asked then set sql accordingly
if (isset($_GET['genreID'] ) and $_GET['genreID'] != ""){
    
   //get id from query string
    $genreID = $_GET['genreID'];
    
     //get particular sql querry from the sql collection
    $sql = getGenreSQL($genreID);
    
}else{
    
    //get particular sql querry from the sql collection
    $sql = getAllGenreSQL();
}
    
//output json object using that particular sql
echo $JSON = generate_JSON_DATA($sql);

?>