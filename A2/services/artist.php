<?php

require_once 'db-connection.php';

function getAllArtist() {
   $sql = 'SELECT ArtistID, FirstName, LastName, Nationality, Gender, YearOfBirth, YearOfDeath, Details, ArtistLink FROM Artists';
   $sql .= " ORDER BY LastName";
   
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

function getArtist($artistID) {
   $sql = 'SELECT ArtistID, FirstName, LastName, Nationality, Gender, YearOfBirth, YearOfDeath, Details, ArtistLink FROM Artists';
   $sql .=" WHERE ArtistID = $artistID";

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


// $test = getAllArtist();

// echo "<p>". $test . "</p>";  

?>