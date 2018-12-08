<?php
session_start();

//Method is responsible retrieve appropriate customer ID and check whether that customer has already added that painiting into their Fav list,
//if so then heart filled method is being called otherwise empty hart method
function projectHeart($paintingID){
    $customerID = $_SESSION['sessionID'];
    if (isset($_SESSION['favPaintingID'] )){ //verify of that customer has ever started fav session if not then empty heart
        $found = false;
        foreach ($_SESSION['favPaintingID'] as $key=>$value){ //go into exisiting fav list array and verify if that paining ID is in that array and change boolean state of found
            if ($key == $customerID){
                for ($i=0; $i< count($value); $i++){
                    if ($value[$i] == $paintingID){
                        $found=true;
                        break;
                    }
                }
            }
        }
    }else{
        emptyHeart($paintingID);
    }
    if (isset($_SESSION['favPaintingID']) and $found == true){ // calling herlper methods basd on found
        filledHeart($paintingID);
    }elseif (isset($_SESSION['favPaintingID']) and $found == false){
        emptyHeart($paintingID);
    }
}

//helper method of creating empty heart, heart has a adding to fav list link
function emptyHeart($paintingID){
    
    echo "<div id='heart'>
        <a href='https://comp3512-assignment-hamid786.c9users.io/A2/services/add_to_favorites.php?paintingID=$paintingID'>
            <img src='icons/fav.png' alt='fav' width='40'/>
        </a>
    </div>";
}

//helper method of creating filled heart, heart has a removing from fav list link
function filledHeart($paintingID){
    
    echo "<div id='heart'>
        <a href='https://comp3512-assignment-hamid786.c9users.io/A2/services/remove_from_favorites.php?paintingID=$paintingID'>
            <img src='icons/heart_filled.png' alt='fav' width='40'/>
        </a>
    </div>";
}

?>
