<?php
//remove particular painting from fav list for a particular customer
session_start();
//acquire customer ID from global login session
$customerID = $_SESSION['sessionID'];

//check whether rquested to remove painting ID is not null and exisit
if (isset($_GET['paintingID'] ) and $_GET['paintingID'] != ""){

    $paintingID = $_GET['paintingID']; //acquire painting ID
    
    if (isset($_SESSION['favPaintingID'] )){ //check whether fav session exist for that particular customer
    
        $favourites = $_SESSION['favPaintingID']; //retrieve fav painitng list into a multi dimensional fav array
        
            foreach($favourites as $key=>$value) { //loop through multi dim fav list array and find customer ID
                if($key == $customerID){ //when customer ID is found inside multi dim fav list array
                    for ($i=0; $i < count($value); $i++){ //loop further on that index for finding requested painting ID 
                        if ($value[$i] == $paintingID){ //when requested painting id is found dont do anything 
                            continue;
                        }

                        $newFav[] = $value[$i]; ///store all paintings into new array 
                    }

                }
            }
        $favourites[$customerID] = $newFav; //dump the new array to replace the customer id index 
        $_SESSION['favPaintingID']= $favourites; //generate new fav list and store in global
        }    
}else{ //requested painitng is null 
    header("Location: {$_SERVER['HTTP_REFERER']}");
}

//when task is done redirect to same page
header("Location: {$_SERVER['HTTP_REFERER']}");

?>


