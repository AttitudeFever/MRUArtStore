<?php

require_once '../sqlCollection.php';
require_once '../db-connection.php';

$galleryID = $_GET['x'];
    
if ($galleryID > 0) { 
    
    $sql = getPaintingGallerySQL($galleryID);
    echo $JSON = generate_JSON_DATA($sql);
    
}
  

?>
