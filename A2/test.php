<?php

session_start();

        $favourites = $_SESSION['favPaintingID'];
        $customerID = $_SESSION['sessionID'];
        
        echo "in favourites array";
        echo "<br>";
        foreach ($favourites as $key=>$value){
        if ($key== $customerID){
            for ($i=0; $i<count($value); $i++){
                echo " ".$key;
                echo "@ index: ".$i;
                echo " ".$value[$i];
            }
            
            }
        }
        echo "<br>";
        echo "in session[fav] array";
        echo "<br>";
        foreach ($_SESSION['favPaintingID'] as $key=>$value){
        if ($key== $customerID){
            for ($i=0; $i<count($value); $i++){
                echo " ".$key;
                echo "@ index: ".$i;
                echo " ".$value[$i];
            }
            
            }
        }

?>