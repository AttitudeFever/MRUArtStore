<?php

require_once '../sqlCollection.php';
require_once '../db-connection.php';

$genreID = $_GET['x'];
    
if ($genreID > 0) { 
    
    $sql = getPaintingGenreSQL($genreID);
    echo $JSON = generate_JSON_DATA($sql);
    
}
  

?>