<?php

session_start();
    
if (isset($_GET['paintingID'] ) and $_GET['paintingID'] != ""){
    
    $paintingID = $_GET['paintingID'];
    
    if (isset($_SESSION['favPaintingID'] ) and $_SESSION['favPaintingID'] != ""){
        
        $favourites = $_SESSION['favPaintingID'];
        
            if (!in_array($paintingID, $favourites)) {
                $favourites[] = $paintingID;
                $_SESSION['favPaintingID'] = $favourites;
            }
    }else{
        
        $favourites[] = $paintingID;
        $_SESSION['favPaintingID'] = $favourites;
    }    
    
    // echo count($favourites);
   
}else{
    echo "ERROR";
}

header("Location: {$_SERVER['HTTP_REFERER']}");

?>

