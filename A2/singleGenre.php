<?php 

include('includes/nav-bar.inc.php');

?>

<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8"/>  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/web/logo.png">
        <title>Single Genre</title>   
        <link rel="stylesheet" href="css/navigation.css">
        <link rel="stylesheet" href="css/singleGenre.css">
        <script src="js/hamburger-functionality.js"></script>
        <script src="js/paintings.js"></script>
    </head>
    <body id = "genreBody">
        <?php createNavBar(); ?>
        
        <div id = "genre_panel">
            
            <?php
            
            if (isset($_GET['genreID']) and $_GET['genreID'] != "")
            {
                $genreID = $_GET['genreID'];
            }
            
            $genreAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/genre.php?genreID=$genreID";
            $JSONdata = file_get_contents($genreAPI);
            $data = json_decode($JSONdata);
            
            foreach($data as $key){
                
                $img = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=genre/full/". $key ->GenreID;
               
                echo "<div>
                <h1 id = 'genreName'>$key->GenreName</h1>
                <img src='$img' alt='$key->GenreName'/>
                <p>$key->Description</p>
                <a href='$key->Link'>Link to Wikipedia</a>
                </div>";
            }
            
            ?>
            
        </div>
        <div id="painting_panel">
            
             
        </div>
    </body>
    