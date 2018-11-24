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
        <link rel="stylesheet" href="css/singlePainting.css">
        <link rel="stylesheet" href="css/navigation.css">
        <script src="js/hamburger-functionality.js"></script>
    </head>
    <body id = "paintingBody">
         <?php createNavBar(); ?>
            
    <div id="painting_panel">
        <?php 
        
        
        if (isset($_GET['paintingID'] ) and $_GET['paintingID'] != ""){
            
            $paintingID = $_GET['paintingID'];
            populate_PaintingINFO($paintingID);
        }


        function fetch($api){
            
            $JSONdata= file_get_contents($api);
            return $data = json_decode($JSONdata);
        }


            function populate_PaintingINFO($paintingID){
                
                $paintingAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/painting.php?paintingID=$paintingID";
                $paintingAPIData = fetch($paintingAPI);
                
                foreach($paintingAPIData as $key){
                    
                    $artistID = $key->ArtistID;
                    $galleryID = $key->GalleryID;
                    $img_file = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=paintings/full/" . $key->ImageFileName."&width=500";
                
                    echo "<div class='profile'>";
                    echo "<h1>$key->Title</h1>";
                    echo "<a href='https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=paintings/full/$key->ImageFileName'><img src='$img_file' alt='$key->Title' /></a>";
                    echo "<p><a href='$key->MuseumLink'>Museum Link</a></p>";
                    if ($key->WikiLink != null){ 
                        echo "<p><a href='$key->WikiLink'>Wiki Link</a></p>";
                    }
                    if ($key->AccessionNumber != null){
                        echo "<p>Accession Number: $key->AccessionNumber</p>";
                    }
                    if ($key->CopyrightText != null){
                        echo "<p>Copyright: $key->CopyrightText</p>";
                    }
                    if ($key->Description != null){ 
                        echo "<p>Description: $key->Description</p>";
                    }
                    if ($key->Excerpt != null){ 
                        echo "<p>Excerpt: $key->Excerpt</p>";
                    }
                    echo "<p>YearOfWorkr: $key->YearOfWork</p>";
                    echo "<p>Size: $key->Width X $key->Height</p>";
                    echo "<p>Medium: $key->Medium</p>";
                    echo "<p>Cost: $key->Cost</p>";
                    echo "<p>MSRP: $key->MSRP</p>";
                    if ($key->GoogleLink != null){     
                        echo "<p><a href='$key->GoogleLink'>Google Link</a></p>";
                    }
                    if ($key->GoogleDescription != null){  
                    echo "<p>Google Description: $key->GoogleDescription</p>";
                    }

                }
                
                    populateArtist($artistID);
                    populateGallery($galleryID);
                    echo "<p>Genres: </p><ul>".populateGenres($paintingID)."</ul>";
                    populateRatingsReviews($paintingID);
                    echo "</div>";
                
            }
            
            function populateArtist($artistID){
                
                $paintingArtistAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/artist.php?artistID=$artistID";
                $artistAPIData = fetch($paintingArtistAPI);
                
                foreach($artistAPIData as $key){
                    echo "<p>Artist: $key->FirstName $key->LastName</p>";
                }
            }
            
            function populateGallery($galleryID){
                
                $paintingGallerytAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/gallery.php?galleryID=$galleryID";
                $paintingGallerytAPIData = fetch($paintingGallerytAPI);
                
                foreach($paintingGallerytAPIData as $key){
                    echo "<p>Gallery Name: $key->GalleryName</p>";
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
                        echo "<li>$key->GenreName</li>";
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

                echo "<p>Average Ratings: ".$averageRating = array_sum($ratings)/count($ratings)."</p>";
            }
            
        ?>