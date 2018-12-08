<?php 
    
include('includes/nav-bar.inc.php'); //naviagtion package

    if (isset($_SESSION['message'])){ //if login error message exist then remove it
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['messageExist'])){ //if email already exist message then remoe it 
        unset($_SESSION['messageExist']);
    }
    
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
            
            <?php 
            createNavBar(); //generate navigation bar
            ?>
            
        <div id="galleryList_panel">
            <h3>Gallery List</h3>
            <button id='down'>&#8681;</button>
            <button id='up'>&#8679;</button>
            <ul id="galleryList">
            </ul>
            <div class = 'numbers'></div>
        </div>


        <div id="artist_panel">
            <h3><button id='previousA'>&#8678;</button>Artists <button id='nextA'>&#8680;</button></h3>
            <div class = 'numbers'></div>
        </div>


        <div id="genre_panel">
            <h3><button id='previousG'>&#8678;</button>Genres <button id='nextG'>&#8680;</button></h3>
            <div class = 'numbers'></div>
        </div>
        
    <div id="loading">
        <p>Loading Please Wait....</p><img src='images/web/Spinner.gif'/>
        </div>
    </body>
    
    