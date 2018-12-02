<?php

define('DBHOST', 'localhost');
define('DBNAME', 'art');
define('DBUSER', getenv('C9_USER'));
define('DBPASS', '');
define('DBCONNSTRING',"mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8mb4;");


// function generate_JSON_DATA($sql) {
    
//   $Data_List = array();

//     try {
        
//         $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
//         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
//         $result = $pdo->query($sql);
        
//         while ($row = $result->fetch()) {  
            
//             $Data_List [] = $row;
//         }
        
//         // close the database connection
//         $pdo = null;
        
//     }catch (PDOException $e) {
        
//         die( $e->getMessage() );
//     }
     
//     return json_encode($Data_List);       
// }

?>