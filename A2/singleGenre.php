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
        <script src="js/paintingTable.js"></script>
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
                
                $img = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=genres/". $key ->GenreID . "&width=400";
               
                echo "<div class ='profile'>
                <h1 id = 'genreName'>$key->GenreName</h1>
                <img src='$img' alt='$key->GenreName'/>
                <p>$key->Description</p>
                <a href='$key->Link'>Link to Wikipedia</a>
                </div>";
            }
            
            ?>
            
        </div>
        <div id="painting_panel">
             <h2 id="paint_head">Paintings from this Genre</h2>  
             <table id="painting_table">
                <tbody id ="table_body"></tbody>
             </table>
        </div>
    </body>
    