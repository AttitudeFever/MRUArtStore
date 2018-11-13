<?php

require_once 'db-connection.php';

function getAllGallery() {
   $sql = 'SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry, Latitude, Longitude, GalleryWebSite FROM Galleries';
   $sql .= " ORDER BY GalleryName";
   
    try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $pdo->query($sql);
        
        while ($row = $result->fetch()) {  
            $json .= json_encode($row);
            
        }
        
        // close the database connection
        $pdo = null;
    }catch (PDOException $e) {
        die( $e->getMessage() );
    }
     
    return $json;       
}

function getGallery($galleryID) {
   $sql = 'SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry, Latitude, Longitude, GalleryWebSite FROM Galleries';
   $sql .=" WHERE GalleryID = $galleryID";

    try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $pdo->query($sql);
        
        while ($row = $result->fetch()) {  
            $json = json_encode($row);
            
        }
        
        // close the database connection
        $pdo = null;
    }catch (PDOException $e) {
        die( $e->getMessage() );
    }
     
    return $json;       
}


// $test = getGallery(2);

// echo "<p>". $test . "</p>";  

?>