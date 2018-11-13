<?php

require_once 'db-connection.php';

function getAllPainting() {
   $sql = 'SELECT PaintingID, ArtistID, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, ';
   $sql .= 'YearOfWork, Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings';
   $sql .= " ORDER BY Title";
   
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

function getPainting($paintingID) {
   $sql = 'SELECT PaintingID, ArtistID, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, ';
   $sql .= 'YearOfWork, Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings';
   $sql .=" WHERE PaintingID = $paintingID";

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


function getPaintingArtist($artistID) {
   $sql = 'SELECT PaintingID, ArtistID, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, ';
   $sql .= 'YearOfWork, Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings';
   $sql .=" WHERE ArtistID = $artistID";

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

function getPaintingGallery($galleryID) {
   $sql = 'SELECT PaintingID, ArtistID, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, ';
   $sql .= 'YearOfWork, Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings';
   $sql .=" WHERE GalleryID = $galleryID";

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

function getPaintingGenre($genreID) {
   $sql = 'SELECT Paintings.PaintingID As PaintingID, PaintingGenres.GenreID, ArtistID, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, ';
   $sql .= 'YearOfWork, Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings INNER JOIN PaintingGenres ON Paintings.PaintingID = PaintingGenres.PaintingID';
   $sql .=" WHERE PaintingGenres.GenreID = $genreID";

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



// $test = getPaintingGenre(1);

// echo "<p>". $test . "</p>";  

?>