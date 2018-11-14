<?php

require_once '../sqlCollection.php';
require_once '../db-connection.php';


$sql = getAllArtistSQL();
echo $JSON = generate_JSON_DATA($sql);
    


?>