<?php 
    
include('php/nav-bar.inc.php');

?>

<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8"/>  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Art Store Web2-A2</title>   
        <link rel="stylesheet" href="css/home.css">
        <link rel="stylesheet" href="css/navigation.css">
        <script src="js/hamburger-functionality.js"></script>
    </head>
    <body id = "homebody">
            <?php createNavBar(); ?>
            
<div id="galleryList_panel">
            <h3>Gallery List</h3>
            <ul id="galleryList">
                <script>
                for (let i =0; i<20; i++){
                    var galleryList = document.getElementById('galleryList');
                    galleryList.innerHTML += "<li>abc xyz</li>";
                }
                </script>
            </ul>
        </div>

        <div id="artist_panel">
            <h3>Artists</h3>
                <script>
                    var imgs_box = document.querySelector('#artist_panel');
                    for (let i=0; i<5; i++){
                        imgs_box.innerHTML += "<div class= 'artist_box' >"+ "<a href='#'>" +
                                        "<img src='images/samples/artist.jpg' width='100' height='100' />"+
                                        "<span class='caption_artist'>"+"Artist Name"+ "</span>"+
                                        "</a>"+
                                        "</div>";

                    }
                </script>
        </div>

        <div id="genre_panel">
            <h3>Genres</h3>
            <script>
                    var imgs_box = document.querySelector('#genre_panel');
                    for (let i=0; i<8; i++){
                        imgs_box.innerHTML += "<div class= 'genre_box' >"+ "<a href='#'>" +
                                        "<img src='images/samples/genre.jpg' width='100' height='100' />"+
                                        "<span class='caption_genre'>"+"Genre Name"+ "</span>"+"<br>"+
                                        "</a>"+
                                        "</div>";

                    }
                </script>
        </div>
        <!--<a href="services/artist.php">Test</a>-->
    </body>