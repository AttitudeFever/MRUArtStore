<?php 
session_start();
include('includes/nav-bar.inc.php'); //navigation package
include('includes/phpFetch.php'); //api fetching package
include('includes/displayHeart.php'); //display heart package

?>

<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8"/>  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/web/logo.png">
        <title>Single Painting</title>   
        <link rel="stylesheet" href="css/singlePainting.css">
        <link rel="stylesheet" href="css/navigation.css">
        <script src="js/hamburger-functionality.js"></script>
        <script>
            //hover over heart filled or empty 
            window.addEventListener('load', ()=>{
               
              var quryHeart = document.querySelector('#heart a img');
              var quryHeart_result = quryHeart.getAttribute('src');
              
              if (quryHeart_result.includes("fav.png")){
                    quryHeart.addEventListener('mouseenter', ()=>{
                        quryHeart.setAttribute('src', 'icons/heart_filled.png');
                    });
                    quryHeart.addEventListener('mouseleave', ()=>{
                        quryHeart.setAttribute('src', 'icons/fav.png');
                    }); 
              }else if(quryHeart_result.includes("heart_filled.png")){
                    quryHeart.addEventListener('mouseenter', ()=>{
                        quryHeart.setAttribute('src', 'icons/fav.png');
                    });
                    quryHeart.addEventListener('mouseleave', ()=>{
                        quryHeart.setAttribute('src', 'icons/heart_filled.png');
                    }); 
              }
            });
        </script>
    </head>
    <body id = "paintingBody">
         <?php 
         //genrate navigation bar
         createNavBar();
         ?>
            
        <?php 
        
        //check if paiting id is not null and exist
        if (isset($_GET['paintingID'] ) and $_GET['paintingID'] != ""){
            
            $paintingID = $_GET['paintingID']; //acquire painting id
            populate_PaintingINFO($paintingID); //populate painitng info section
        }

            //helper method painting info section will populate painting and call other helper methods that fetch ineral apis 
            function populate_PaintingINFO($paintingID){
                
                
                $paintingAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/painting.php?paintingID=$paintingID"; //api
                $paintingAPIData = fetch($paintingAPI);
                
                //loop through painitng api data, call for other heper methods are made in here
                foreach($paintingAPIData as $key){
                    
                    $artistID = $key->ArtistID;
                    $galleryID = $key->GalleryID;
                    $img_file = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=paintings/full/" . $key->ImageFileName."&width=500";
                
                    echo "<div class='profile'>
                            <h1>$key->Title</h1>
                            <a href='https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=paintings/full/$key->ImageFileName'><img id='painting_img' src='$img_file' alt='$key->Title' /></a>
                            <p id='medium'>Medium: $key->Medium</p>
                            <p id='size'>Size: $key->Width X $key->Height</p>";
                            if (isset($_SESSION['sessionID'])){ //if user is loged in then heart will displaed
                                projectHeart($paintingID);
                            }else{ //othrwise login asking 
                                echo "<div id='notLogin'><a href='login.php'>Favourite?/Login</a></div>";
                            }
                    echo "</div>";
                    
                    echo "<div class='description'>";
                        if ($key->Description != null){ //if description not null
                            echo "<details>";
                            echo "<summary class='caption' id='description'>Description</summary>";
                            echo "<p>$key->Description</p>";
                            echo "</details>";
                        }
                        if ($key->Excerpt != null){ //if excerpt not null
                            echo"<details>";
                            echo "<summary class='caption' id='excerpt'>Excerpt</summary>";
                            echo "<p>$key->Excerpt</p>";
                            echo "</details>";
                        }
                        if ($key->GoogleDescription != null){  //if google description is not null
                            echo"<details>";
                            echo "<summary class='caption' id='google'>Google Description</summary>";
                            echo "<p>$key->GoogleDescription</p>";
                            echo "</details>";
                        }
                    echo "</div>";
                         
                    echo "<div class='details'>";
                        echo "<h1>Details</h1>";
                        populateArtist($artistID); //populate artist info usinger helper method
                        echo "<p class='caption'>Year of Work: $key->YearOfWork</p>";
                        echo "<p class='caption'>Cost: $$key->Cost</p>";
                        echo "<p class='caption'>MSRP: $key->MSRP</p>";
                        if ($key->CopyrightText != null){ //if copyright not null
                            echo "<p class='caption'>Copyright: $key->CopyrightText</p>";
                        }
                        if ($key->AccessionNumber != null){ //if accessionnumber not null
                            echo "<p class='caption'>Accession Number: $key->AccessionNumber</p>";
                        }
                        echo "<div id='genres'><p class='caption'>Genre(s)</p>";
                                populateGenres($paintingID); //populate genres using helper method 
                        echo "</div>";
                        populateGallery($galleryID); //populate gallery info using hleper method
                        echo "<div id='links'>";
                        if ($key->MuseumLink != null){ //if meusum link not null
                            echo "<p class='caption'><a href='$key->MuseumLink' target='_blank'>Museum Link</a></p>";
                        }
                        if ($key->WikiLink != null){ //if wiki link not null
                            echo "<p class='caption'><a href='$key->WikiLink' target='_blank'>Wiki Link</a></p>";
                        }
                        if ($key->GoogleLink != null){ //if google link not mull
                        echo "<p class='caption'><a href='$key->GoogleLink' target='_blank'>Google Link</a></p>";
                        }
                        echo "</div>";
                        
                        populateRatingsReviews($paintingID); //calculate and populate rating, rviews using helper method
                        
                    echo "</div>";
                }
                    color_plete($paintingID); //popuate color theme using helper method
            }
            
            //helper method color plete will get dominant color info for that painting and popluate it on the page
            function color_plete($paintingID){
                $paintingAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/painting.php?paintingID=$paintingID"; //api
                $paintingAPIData = fetch($paintingAPI);
                foreach($paintingAPIData as $key){ //loop thorough api data
                    $JsonAnnotations = json_decode( $key->JsonAnnotations); 
                    echo "<div class='color_panel'>";
                        echo "<h1 class='caption'>Dominent Colour Theme<h1>";
                        for ($i=0; $i < count($JsonAnnotations->dominantColors); $i++){
                        
                            $r = $JsonAnnotations->dominantColors[$i]->color->red;
                            $g = $JsonAnnotations->dominantColors[$i]->color->green;
                            $b = $JsonAnnotations->dominantColors[$i]->color->blue;
                        
                            echo "<div class='color_visual' style='background-color:rgb($r, $g, $b)';>
                                    <p class='color_name'>".$JsonAnnotations->dominantColors[$i]->name.
                                    "</p></div>";
                        }
                    echo "</div>";
                }
            }
            
            //helper method to popluate artist info on page
            function populateArtist($artistID){
                
                $paintingArtistAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/artist.php?artistID=$artistID"; //api
                $artistAPIData = fetch($paintingArtistAPI);
                
                foreach($artistAPIData as $key){ //loop through api
                    $a_img = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=artists/square/$artistID"."&width=100";
                    echo "<div id='artist'><p class='caption'>Artist</p>
                        <a href='https://comp3512-assignment-hamid786.c9users.io/A2/singleArtist.php?artistID=$artistID'>
                        <img src='$a_img' alt='$key->LastName'/>
                        <div class='caption'>$key->FirstName $key->LastName</div>
                        </a></div>";
                }
            }
            
            //helper method to populate gallery info
            function populateGallery($galleryID){
                
                $paintingGallerytAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/gallery.php?galleryID=$galleryID"; //api
                $paintingGallerytAPIData = fetch($paintingGallerytAPI); //fetch api
                
                foreach($paintingGallerytAPIData as $key){ //loop though api
                    echo "<p class='caption'>Gallery:
                        <a href='https://comp3512-assignment-hamid786.c9users.io/A2/singleGallery.php?galleryID=$galleryID'>
                            </span>$key->GalleryName</span>
                        </a></p>";
                }
            }
            
            //helper method popluate genere info
            function populateGenres($paintingID){
                
                $paintingsGenresAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/painting.php?pgID=$paintingID"; //api
                $paintingsGenresAPIAPIData = fetch($paintingsGenresAPI); //fetch api
                
                foreach($paintingsGenresAPIAPIData as $key){ //loop though api data
                    $genreID = $key->GenreID;
                    $paintingGenreAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/genre.php?genreID=$genreID"; //api
                    $paintingGenreAPIData = fetch($paintingGenreAPI); //feth api
                    
                    foreach($paintingGenreAPIData as $key){ //lop through api data
                        $gen_img = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=genres/$genreID"."&width=100";
                        
                        echo "<div class='genre_box'><a href='https://comp3512-assignment-hamid786.c9users.io/A2/singleGenre.php?genreID=$genreID' >
                                <img src='$gen_img' alt=''/>
                                <div class='caption'>$key->GenreName</div>
                            </a></div>";
                    }
                }
            }
            
            //helper method poppluate reviews and calucuate ratings
            function populateRatingsReviews($paintingID){
                $paintingRatingsAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/painting.php?ratingPID=$paintingID"; //api
                $paintingRatingsAPIData = fetch($paintingRatingsAPI); //fetch api

                foreach($paintingRatingsAPIData as $key){ //loop through api data
                    
                    $ratings[] =$key->Rating;
                    
                    if ($key->Comment !=null){ //if reviews are not null
                        $reviews[] =  $key->Comment;
                        $reviewDate[] = $key->ReviewDate;
                        
                    }
                }

                
                if (!isset($_SESSION['sessionID'])){ //if login session not exist then give login question next to rating 
                    echo "<div id='ratingAsk'>".AverageRating($ratings)."<a href='login.php'>Add Rating?/Login</a></div>";
                }else{ //otherwise add voting link next to rating
                    echo "<div id='ratingAsk'>".AverageRating($ratings)."<a href='#'>Add Rating</a></div>";
                }

                echo"<details>";
                    echo "<summary class = 'caption' id='reviews'>Reviews</summary>";
                        reviews($reviews, $reviewDate);
                echo "</details>";
                

            }
            
            //helper method to populate reviews
            function reviews($reviews, $reviewDate){
                if (count($reviews) > 0){
                    for ($i=0; $i<count($reviews); $i++){
                        echo "<p>Date & Time: $reviewDate[$i]</p><p class='reviewBody'>$reviews[$i]</p>";
                    }
                }
            }
            
            //helper method to calculate average rating and place star image ext to it
            function AverageRating($ratings){

                $averageRating = round (array_sum($ratings)/count($ratings), 1);
                
                if (!is_nan ($averageRating)){
                    
                echo "<p class='caption'>Average Rating(s): ".$averageRating."</p>";
                    if ($averageRating < 0.5){
                echo "<img src='images/web/RatingStars/0.png' alt='0' width='100'/>";
                    }else if ($averageRating >= 0.5 and $averageRating < 1){
                        echo "<img src='images/web/RatingStars/0.5.png' alt='0.5' width='100'/>";
                    }else if ($averageRating >= 1 and $averageRating < 1.5 ){
                echo "<img src='images/web/RatingStars/1.png' alt='1' width='100'/>";
                    }else if ($averageRating >= 1.5 and $averageRating < 2){
                        echo "<img src='images/web/RatingStars/1.5.png' alt='1.5' width='100'/>";
                    }else if ($averageRating >=2 and $averageRating < 2.5){
                echo "<img src='images/web/RatingStars/2.png' alt='2' width='100'/>";
                    }else if ($averageRating >= 2.5 and $averageRating < 3){
                        echo "<img src='images/web/RatingStars/2.5.png' alt='2.5' width='100'/>";
                    }if ($averageRating >= 3 and $averageRating < 3.5){
                echo "<img src='images/web/RatingStars/3.png' alt='3' width='100'/>";
                    }else if ($averageRating >=3.5 and $averageRating < 4){
                        echo "<img src='images/web/RatingStars/3.5.png' alt='3.5' width='100'/>";
                    }else if ($averageRating >= 4 and $averageRating < 4.5){
                echo "<img src='images/web/RatingStars/4.png' alt='4' width='100'/>";
                    }else if ($averageRating >=4.5 and $averageRating < 5){
                        echo "<img src='images/web/RatingStars/4.5.png' alt='4.5' width='100'/>";
                    }else if ($averageRating >=5){
                echo "<img src='images/web/RatingStars/5.png' alt='5' width='100'/>";
                    }
                }else {
                    echo "<p>Average Rating(s): no ratings yet!</p>";
                }
            }
            
        ?>