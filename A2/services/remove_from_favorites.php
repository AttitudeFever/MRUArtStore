<?php

session_start();
$customerID = $_SESSION['sessionID'];

if (isset($_GET['paintingID'] ) and $_GET['paintingID'] != ""){

    $paintingID = $_GET['paintingID'];
    
    if (isset($_SESSION['favPaintingID'] )){
        
        $favourites = $_SESSION['favPaintingID'];
            foreach($_SESSION['favPaintingID'] as $key=>$value) {
                if($key == $customerID){
                    for ($i=0; $i < count($value); $i++){
                        if ($value[$i] == $paintingID){
                            unset($_SESSION['favPaintingID'][$key][$i]);
                        }
                    }

                }
            }
        }    
}else{
    header("Location: {$_SERVER['HTTP_REFERER']}");
}

header("Location: {$_SERVER['HTTP_REFERER']}");

?>


