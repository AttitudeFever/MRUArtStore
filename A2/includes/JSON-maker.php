<?php

require_once ('db-connection.php'); //db connection package

//method is responsible to create JSON data when given appropriate SQL request
function generate_JSON_DATA($sql) {
    
   $Data_List = array();

    try {
        
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); //db connection
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $result = $pdo->query($sql);
        
        while ($row = $result->fetch()) {  
            
            $Data_List [] = $row;
        }
        
        // close the database connection
        $pdo = null;
        
    }catch (PDOException $e) { //exceptions
        
        die( $e->getMessage() );
    }
     
    return json_encode($Data_List); //JSON data bundle 
}

?>