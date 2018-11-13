<?php 

require_once 'db-connection.php';

function getReviewPainting($paintingID) {
   $sql = 'SELECT RatingID, PaintingID, ReviewDate, Rating, Comment FROM Reviews';
   $sql .= " WHERE PaintingID = $paintingID";

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


// $test = getReviewPainting(5);

// echo "<p>". $test . "</p>";  

?>