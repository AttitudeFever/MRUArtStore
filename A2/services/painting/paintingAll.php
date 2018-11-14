<?php

require_once '../sqlCollection.php';
require_once '../db-connection.php';


$sql = getAllPaintingSQL();
echo $JSON = generate_JSON_DATA($sql);

?>