<?php 

include('includes/nav-bar.inc.php');
include('includes/phpFetch.php');
include('includes/displayHeart.php');

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
         <?php createNavBar(); ?>
            
        <?php 
        
        
        if (isset($_GET['paintingID'] ) and $_GET['paintingID'] != ""){
            
            $paintingID = $_GET['paintingID'];
            populate_PaintingINFO($paintingID);
        }


            function populate_PaintingINFO($paintingID){
                
                $paintingAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/painting.php?paintingID=$paintingID";
                $paintingAPIData = fetch($paintingAPI);
                
                foreach($paintingAPIData as $key){
                    
                    $artistID = $key->ArtistID;
                    $galleryID = $key->GalleryID;
                    $img_file = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=paintings/full/" . $key->ImageFileName."&width=500";
                
                    echo "<div class='profile'>
                            <h1>$key->Title</h1>
                            <a href='https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=paintings/full/$key->ImageFileName'><img id='painting_img' src='$img_file' alt='$key->Title' /></a>
                            <p id='medium'>Medium: $key->Medium</p>
                            <p id='size'>Size: $key->Width X $key->Height</p>";
                            projectHeart($paintingID);
                    echo "</div>";
                    
                    echo "<div class='description'>";
                        if ($key->Description != null){ 
                            echo "<details>";
                            echo "<summary class='caption' id='description'>Description</summary>";
                            echo "<p>$key->Description</p>";
                            echo "</details>";
                        }
                        if ($key->Excerpt != null){ 
                            echo"<details>";
                            echo "<summary class='caption' id='excerpt'>Excerpt</summary>";
                            echo "<p>$key->Excerpt</p>";
                            echo "</details>";
                        }
                        if ($key->GoogleDescription != null){  
                            echo"<details>";
                            echo "<summary class='caption' id='google'>Google Description</summary>";
                            echo "<p>$key->GoogleDescription</p>";
                            echo "</details>";
                        }
                    echo "</div>";
                         
                    echo "<div class='details'>";
                        echo "<h1>Details</h1>";
                        populateArtist($artistID);
                        echo "<p class='caption'>Year of Work: $key->YearOfWork</p>";
                        echo "<p class='caption'>Cost: $$key->Cost</p>";
                        echo "<p class='caption'>MSRP: $key->MSRP</p>";
                        if ($key->CopyrightText != null){
                            echo "<p class='caption'>Copyright: $key->CopyrightText</p>";
                        }
                        if ($key->AccessionNumber != null){
                            echo "<p class='caption'>Accession Number: $key->AccessionNumber</p>";
                        }
                        echo "<div id='genres'><p class='caption'>Genre(s)</p>";
                                populateGenres($paintingID);
                        echo "</div>";
                        populateGallery($galleryID);
                        echo "<div id='links'>";
                        if ($key->MuseumLink != null){
                            echo "<p class='caption'><a href='$key->MuseumLink'>Museum Link</a></p>";
                        }
                        if ($key->WikiLink != null){ 
                            echo "<p class='caption'><a href='$key->WikiLink'>Wiki Link</a></p>";
                        }
                        if ($key->GoogleLink != null){     
                        echo "<p class='caption'><a href='$key->GoogleLink'>Google Link</a></p>";
                        }
                        echo "</div>";
                        
                        populateRatingsReviews($paintingID);
                        
                    echo "</div>";
                }
                    color_plete($paintingID);
            }
            
            function color_plete($paintingID){
                $paintingAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/painting.php?paintingID=$paintingID";
                $paintingAPIData = fetch($paintingAPI);
                foreach($paintingAPIData as $key){
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
            
            function populateArtist($artistID){
                
                $paintingArtistAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/artist.php?artistID=$artistID";
                $artistAPIData = fetch($paintingArtistAPI);
                
                foreach($artistAPIData as $key){
                    $a_img = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=artists/square/$artistID"."&width=100";
                    echo "<div id='artist'><p class='caption'>Artist</p>
                        <a href='https://comp3512-assignment-hamid786.c9users.io/A2/singleArtist.php?artistID=$artistID'>
                        <img src='$a_img' alt='$key->LastName'/>
                        <div class='caption'>$key->FirstName $key->LastName</div>
                        </a></div>";
                }
            }
            
            function populateGallery($galleryID){
                
                $paintingGallerytAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/gallery.php?galleryID=$galleryID";
                $paintingGallerytAPIData = fetch($paintingGallerytAPI);
                
                foreach($paintingGallerytAPIData as $key){
                    echo "<p class='caption'>Gallery:
                        <a href='https://comp3512-assignment-hamid786.c9users.io/A2/singleGallery.php?galleryID=$galleryID'>
                            </span>$key->GalleryName</span>
                        </a></p>";
                }
            }
            
            function populateGenres($paintingID){
                
                $paintingsGenresAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/painting.php?pgID=$paintingID";
                $paintingsGenresAPIAPIData = fetch($paintingsGenresAPI);
                
                foreach($paintingsGenresAPIAPIData as $key){
                    $genreID = $key->GenreID;
                    $paintingGenreAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/genre.php?genreID=$genreID";
                    $paintingGenreAPIData = fetch($paintingGenreAPI);
                    
                    foreach($paintingGenreAPIData as $key){
                        $gen_img = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=genres/$genreID"."&width=100";
                        
                        echo "<div class='genre_box'><a href='https://comp3512-assignment-hamid786.c9users.io/A2/singleGenre.php?genreID=$genreID' >
                                <img src='$gen_img' alt=''/>
                                <div class='caption'>$key->GenreName</div>
                            </a></div>";
                    }
                }
            }
            
            
            function populateRatingsReviews($paintingID){
                $paintingRatingsAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/painting.php?ratingPID=$paintingID";
                $paintingRatingsAPIData = fetch($paintingRatingsAPI);

                foreach($paintingRatingsAPIData as $key){
                    
                    $ratings[] =$key->Rating;
                    
                    if ($key->Comment !=null){
                        $reviews[] =  $key->Comment;
                        $reviewDate[] = $key->ReviewDate;
                        
                    }
                }

                AverageRating($ratings);

                echo"<details>";
                    echo "<summary class = 'caption' id='reviews'>Reviews</summary>";
                        reviews($reviews, $reviewDate);
                echo "</details>";
                

            }
            
            function reviews($reviews, $reviewDate){
                if (count($reviews) > 0){
                    for ($i=0; $i<count($reviews); $i++){
                        echo "<p>Date & Time: $reviewDate[$i]</p><p class='reviewBody'>$reviews[$i]</p>";
                    }
                }
            }
            
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