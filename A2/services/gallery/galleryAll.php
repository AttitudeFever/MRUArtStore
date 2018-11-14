<?php

require_once '../sqlCollection.php';
require_once '../db-connection.php';



$sql = getAllGallerySQL();
echo $JSON = generate_JSON_DATA($sql);
    

?>