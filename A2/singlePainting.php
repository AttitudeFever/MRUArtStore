<?php 

include('includes/nav-bar.inc.php');
include('includes/phpFetch.php');

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
                            <a href='https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=paintings/full/$key->ImageFileName'><img src='$img_file' alt='$key->Title' /></a>
                            <p id='medium'>Medium: $key->Medium</p>
                            <p id='size'>Size: $key->Width X $key->Height</p>
                            <p id='cost'>Cost: $$key->Cost</p>
                        </div>";
                    
                    echo "<div class='description'>";
                        if ($key->Description != null){ 
                            echo "<details>";
                            echo "<summary id='description'>Description</summary>";
                            echo "<p>$key->Description</p>";
                            echo "</details>";
                        }
                        if ($key->Excerpt != null){ 
                            echo"<details>";
                            echo "<summary id='excerpt'>Excerpt</summary>";
                            echo "<p>$key->Excerpt</p>";
                            echo "</details>";
                        }
                        if ($key->GoogleDescription != null){  
                            echo"<details>";
                            echo "<summary id='google'>Google Description</summary>";
                            echo "<p>$key->GoogleDescription</p>";
                            echo "</details>";
                        }
                    echo "</div>";
                         
                    echo "<div class='details'>";
                        echo "<h1>Details</h1>";
                        populateArtist($artistID);
                        echo "<p class='caption'>Year of Work: $key->YearOfWork</p>";
                        echo "<p class='caption'>MSRP: $key->MSRP</p>";
                        if ($key->CopyrightText != null){
                            echo "<p class='caption'>Copyright: $key->CopyrightText</p>";
                        }
                        if ($key->AccessionNumber != null){
                            echo "<p class='caption'>Accession Number: $key->AccessionNumber</p>";
                        }
                        echo "<div id='genres'><p>Genre(s)</p>";
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
                        
                        // populateRatingsReviews($paintingID);
                    echo "</div>";
                }
                    echo "<div class='color_panel'>
                            <aside>
                                <h2>Enter Color</h2>
                                    <form class='colorEntry'>
                                        <fieldset>
                                            <legend>Define a color scheme</legend>
                                            <div>
                                                <input type=color id='color1' name='color'/><span>#000000</span> <label for='color1'>Color #1</label>
                                            </div>
                                            <div>
                                                <input type=color id='color1' name='color'/><span>#000000</span> <label for='color1'>Color #1</label>
                                            </div>
                                            <div>
                                                <input type=color id='color1' name='color'/><span>#000000</span> <label for='color1'>Color #1</label>
                                            </div>
                                            <div>
                                                <input type=color id='color1' name='color'/><span>#000000</span> <label for='color1'>Color #1</label>
                                            </div>
                                            <div>
                                                <input type=color id='color1' name='color'/><span>#000000</span> <label for='color1'>Color #1</label>
                                            </div>  
                                            <hr>
                                            <button type=submit>Add to Scheme Collection</button>
			                                <button type='reset'>Reset Scheme</button>
                                        </fieldset>
                                    </form>
                                </aside>
                          </div>";
            }
            
            function populateArtist($artistID){
                
                $paintingArtistAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/artist.php?artistID=$artistID";
                $artistAPIData = fetch($paintingArtistAPI);
                
                foreach($artistAPIData as $key){
                    $a_img = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=artists/square/$artistID"."&width=100";
                    echo "<div id='artist'><p>Artist</p>
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
                        echo "<p>Reviews: $key->Comment</p>";
                    }
                }
                
                AverageRating($ratings);
            }
            
            function AverageRating($ratings){

                $averageRating = round (array_sum($ratings)/count($ratings), 1);
                
                if (!is_nan ($averageRating)){
                    
                echo "<p>Average Ratings: ".$averageRating."</p>";
                    if ($averageRating < 0.5){
                echo "<img src='images/web/RatingStars/0.png' alt='' width='100'/>";
                    }else if ($averageRating >= 0.5 and $averageRating < 1){
                        echo "<img src='images/web/RatingStars/0.5.png' alt='' width='100'/>";
                    }else if ($averageRating >= 1 and $averageRating < 1.5 ){
                echo "<img src='images/web/RatingStars/1.png' alt='' width='100'/>";
                    }else if ($averageRating >= 1.5 and $averageRating < 2){
                        echo "<img src='images/web/RatingStars/1.5.png' alt='' width='100'/>";
                    }else if ($averageRating >=2 and $averageRating < 2.5){
                echo "<img src='images/web/RatingStars/2.png' alt='' width='100'/>";
                    }else if ($averageRating >= 2.5 and $averageRating < 3){
                        echo "<img src='images/web/RatingStars/2.5.png' alt='' width='100'/>";
                    }if ($averageRating >= 3 and $averageRating < 3.5){
                echo "<img src='images/web/RatingStars/3.png' alt='' width='100'/>";
                    }else if ($averageRating >=3.5 and $averageRating < 4){
                        echo "<img src='images/web/RatingStars/3.5.png' alt='' width='100'/>";
                    }else if ($averageRating >= 4 and $averageRating < 4.5){
                echo "<img src='images/web/RatingStars/4.png' alt='' width='100'/>";
                    }else if ($averageRating >=4.5 and $averageRating < 5){
                        echo "<img src='images/web/RatingStars/4.5.png' alt='' width='100'/>";
                    }else if ($averageRating >=5){
                echo "<img src='images/web/RatingStars/5.png' alt='' width='100'/>";
                    }
                }else {
                    echo "<p>Average Ratings: N/A</p>";
                }
            }
            
        ?>