<?php
//php add to fav functionalities 


session_start();
//acquire custmer ID
$customerID = $_SESSION['sessionID'];

//check if query string has painting ID and its not null
if (isset($_GET['paintingID'] ) and $_GET['paintingID'] != ""){
    
    $found = false;
    $paintingID = $_GET['paintingID'];
    
    //check whether customer is logged in or not
    if (isset($_SESSION['sessionID'])){
        
        //check if this logged in customer has fav session ever started
        if (isset($_SESSION['favPaintingID'])){
            
            //retrieve fav list from session into a multi dimensional array variable of fav
            $favourites= $_SESSION['favPaintingID'];
            
            //loop through that fav array for that customer
            foreach ($favourites[$customerID] as $key){
                
                //check if they have that painting in his list already, if it is boolean variable found comes true
                if ($key == $paintingID){
                    $found = true;
                    break;
                }
            }
            //based on boolean vaiable remains false add that painting in fav list for that customer
            if ($found == false){
                $favourites[$customerID][]=$paintingID;
                $_SESSION['favPaintingID']=$favourites;
            }
        
        // this customer has never started the fav session, so it will start for him for the first time and painting will be added to multi dim fav array
        }else{
            $favourites[$customerID][]=$paintingID;
            $_SESSION['favPaintingID']= $favourites;
        }
    //guest is not logged in and trying to acces add to fav funtionality
    }else{
        echo "Please Login First";
        header('Location: ../login.php');
    }
    
//painting guest or customer trying to add does not exist    
}else{
    echo "Painting doesn't exisit";
    header('Location: ../index.php');
}

//redirect to the same page where they come from
header("Location: {$_SERVER['HTTP_REFERER']}");

?>

