<?php 

require_once '../sqlCollection.php';
require_once '../db-connection.php';


$paintingID = $_GET['x'];
    
if ($paintingID > 0) { 
    
    $sql = getReviewPaintingSQL($paintingID);
    echo $JSON = generate_JSON_DATA($sql);
}



?>