<?php

require_once '../sqlCollection.php';
require_once '../db-connection.php';

$artistID = $_GET['x'];
    
if ($artistID > 0) { 
    
    $sql = getPaintingArtistSQL($artistID);
    echo $JSON = generate_JSON_DATA($sql);
    
}
  

?>
