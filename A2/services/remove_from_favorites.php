<?php

session_start();

if (isset($_GET['paintingID'] ) and $_GET['paintingID'] != ""){
    
    $paintingID = $_GET['paintingID'];
    
    if (isset($_SESSION['favPaintingID'] ) and $_SESSION['favPaintingID'] != ""){
        
        $favourites = $_SESSION['favPaintingID'];
        
            if (in_array($paintingID, $favourites)) {
                foreach($_SESSION['favPaintingID'] as $key => $value) {
                    if($value == $paintingID){
                        unset($_SESSION['favPaintingID'][$key]);
                    }
                }
            }
        }    
    
    // echo count($favourites);
   
}else{
    echo "ERROR";
}

header("Location: {$_SERVER['HTTP_REFERER']}");

?>


