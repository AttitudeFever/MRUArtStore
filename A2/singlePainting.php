<?php 

include('includes/nav-bar.inc.php');

?>

<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8"/>  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/web/logo.png">
        <title>Single Painting</title>   
        <link rel="stylesheet" href="">
        <link rel="stylesheet" href="css/navigation.css">
        <script src="js/hamburger-functionality.js"></script>
    </head>
    <body id = "artistBody">
         <?php createNavBar(); ?>
            
    <div id="painting_panel">
        <?php 
        
        if (isset($_GET['paintingID'] ) and $_GET['paintingID'] != ""){
            
            $paintingID = $_GET['paintingID'];
        }
         
        $paintingAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/painting.php?paintingID=$paintingID";
        $JSONdata = file_get_contents($paintingAPI);
        $data = json_decode($JSONdata);
        
       
        foreach($data as $key){
            
            $img_file = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=paintings/full/" . $key->ImageFileName;
            
            echo "<div class='profile'>
                    <img src='$img_file' alt='' />
            </div>";
        }
        
        ?>