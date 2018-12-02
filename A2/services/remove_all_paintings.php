<?php

session_start();
$customerID = $_SESSION['sessionID'];

if (isset($_SESSION['favPaintingID'] )){
    foreach($_SESSION['favPaintingID'] as $key => $value) {
        if ($key == $customerID){
            for ($i=0; $i<count($value); $i++){
                unset($_SESSION['favPaintingID'][$key][$i]);
            }
        }
    }
}else{
    header("Location: {$_SERVER['HTTP_REFERER']}");
}
                    
header("Location: {$_SERVER['HTTP_REFERER']}");

?>

