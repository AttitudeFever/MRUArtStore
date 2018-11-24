<?php 
    
include('includes/nav-bar.inc.php');

?>

<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8"/>  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/web/logo.png">
        <title>Art Store Web2-A2</title>   
        <link rel="stylesheet" href="css/home.css">
        <link rel="stylesheet" href="css/navigation.css">
        <script src="js/hamburger-functionality.js"></script>
        <script src="js/index.js"></script>
    </head>
    <body id = "homebody">
        
            <?php createNavBar(); ?>
            
<div id="galleryList_panel">
            <h3>Gallery List</h3>
            <ul id="galleryList">
            </ul>
        </div>

        <div id="artist_panel">
            <h3>Artists</h3>
        </div>

        <div id="genre_panel">
            <h3>Genres</h3>
        </div>
    <div id="loading">
        <p>Loading Please Wait....</p><img src='images/web/Spinner.gif'/>
        </div>
    </body>