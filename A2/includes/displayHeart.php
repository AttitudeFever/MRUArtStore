<?php
session_start();

function projectHeart($paintingID){
    
    if (isset($_SESSION['favPaintingID'] )){
        $favourites = $_SESSION['favPaintingID'];
        if (in_array($paintingID, $favourites)==true) {
            filledHeart($paintingID);
        }else{
            emptyHeart($paintingID);
        }
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
