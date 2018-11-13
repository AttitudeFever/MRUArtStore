<?php

require_once 'db-connection.php';

function getAllGenre() {
   $sql = 'SELECT GenreID, GenreName, EraID, Description, Link FROM Genres';
   $sql .= " ORDER BY GenreName";
   
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

function getGenre($genreID) {
   $sql = 'SELECT GenreID, GenreName, EraID, Description, Link FROM Genres';
   $sql .=" WHERE GenreID = $genreID";

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


// $test = getAllGenre();

// echo "<p>". $test . "</p>";  

?>