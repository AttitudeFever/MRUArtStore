<?php
session_start();

function projectHeart($paintingID){
    $customerID = $_SESSION['sessionID'];
    if (isset($_SESSION['favPaintingID'] )){
        $found = false;
        foreach ($_SESSION['favPaintingID'] as $key=>$value){
            if ($key == $customerID){
                for ($i=0; $i< count($value); $i++){
                    if ($value[$i] == $paintingID){
                        $found=true;
                        break;
                    }else{
                        $found=false;
                    }
                }
            }
        }
    }else{
        emptyHeart($paintingID);
    }
    if ($found == true){
        filledHeart($paintingID);
    }else{
        emptyHeart($paintingID);
    }
}


function emptyHeart($paintingID){
    
    echo "<div id='heart'>
        <a href='https://comp3512-assignment-hamid786.c9users.io/A2/services/add_to_favorites.php?paintingID=$paintingID'>
            <img src='icons/fav.png' alt='fav' width='40'/>
        </a>
    </div>";
}

function filledHeart($paintingID){
    
    echo "<div id='heart'>
        <a href='https://comp3512-assignment-hamid786.c9users.io/A2/services/remove_from_favorites.php?paintingID=$paintingID'>
            <img src='icons/heart_filled.png' alt='fav' width='40'/>
        </a>
    </div>";
}

?>
