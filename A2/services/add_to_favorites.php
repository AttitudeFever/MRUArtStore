<?php

session_start();
$customerID = $_SESSION['sessionID'];

if (isset($_GET['paintingID'] ) and $_GET['paintingID'] != ""){
    $found = false;
    $paintingID = $_GET['paintingID'];
    if (isset($_SESSION['sessionID'])){
        if (isset($_SESSION['favPaintingID'])){
            $favourites= $_SESSION['favPaintingID'];
            foreach ($favourites[$customerID] as $key){
                if ($key == $paintingID){
                    $found = true;
                    break;
                }
            }
            if ($found == false){
                $favourites[$customerID][]=$paintingID;
                $_SESSION['favPaintingID']=$favourites;
            }
        }else{
            $favourites[$customerID][]=$paintingID;
            $_SESSION['favPaintingID']= $favourites;
        }
    }else{
        echo "Please Login First";
        header('Location: ../login.php');
    }
}else{
    echo "Painting doesn't exisit";
    header('Location: ../index.php');
}

header("Location: {$_SERVER['HTTP_REFERER']}");

?>

