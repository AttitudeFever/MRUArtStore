<?php

//remove all paintings from fav list functionality
session_start();

//acquire customer ID from gloabl login session
$customerID = $_SESSION['sessionID'];

//check whether fav session exist for that customer
if (isset($_SESSION['favPaintingID'] )){
    
    //loop into multi dimensional fav list array and stops where customer ID is located inside array
    foreach($_SESSION['favPaintingID'] as $key => $value) {
        if ($key == $customerID){ //when that customer id is found loop further on that index to remove all paintings 
            for ($i=0; $i<count($value); $i++){
                unset($_SESSION['favPaintingID'][$key][$i]);
            }
        }
    }
}else{ //fav session never existed for that customer therefore redirect without doing anything
    header("Location: {$_SERVER['HTTP_REFERER']}");
}

//redirect after task done
header("Location: {$_SERVER['HTTP_REFERER']}");

?>

