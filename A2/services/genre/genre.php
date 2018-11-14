<?php

require_once '../sqlCollection.php';
require_once '../db-connection.php';


$genreID = $_GET['x'];
    
if ($genreID > 0) {  
    
    $sql = getGenreSQL($genreID);
    echo $JSON = generate_JSON_DATA($sql);
    
}



?>