<?php 

include('includes/nav-bar.inc.php'); //navigation package
include('includes/phpFetch.php'); // api fetching package

?>

<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8"/>  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/web/logo.png">
        <title>Single Artist</title>   
        <link rel="stylesheet" href="css/singleArtist.css">
        <link rel="stylesheet" href="css/navigation.css">
        <script src="js/hamburger-functionality.js"></script>
        <script src="js/paintingTable.js"></script>
    </head>
    <body id = "artistBody">
        <?php 
         
         createNavBar(); //generate naviagtion bar
            
        echo "<div id='artist_panel'>";

        //check artist id is not null and exist
        if (isset($_GET['artistID'] ) and $_GET['artistID'] != ""){
            
            $artistID = $_GET['artistID']; //acquire artist id
            
            $artistAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/artist.php?artistID=$artistID"; //api
            $data = fetch($artistAPI);
            
           //loop through api data
            foreach($data as $key){
                
                $img_file = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=artists/full/" . $key->ArtistID;
                
                echo "<div class='profile'>
                <h1 id='artistName' class='caption'>$key->FirstName $key->LastName</h1>
                <a href=$img_file><img src='$img_file' alt='$key->LastName' /></a>
                <p class='caption'>Nationality: $key->Nationality</p>
                <p class='caption'>Gender: $key->Gender</p>
                <p class='caption'>Year of Birth: $key->YearOfBirth</p>
                <p class='caption'>Year of Death: $key->YearOfDeath</p>
                <details>
                <summary id='detials' class='caption'>Details</summary>
                <p>$key->Details</p>
                </details>
                <p class='caption'><a href='$key->ArtistLink' target='_blank'>Wiki Link </a></p>
                </div>";
            }
        
        echo "</div>
        <div id='painting_panel'>
                <section>
              <h2 id='p_heading'>Paintings of This Artist</h2>  
              <table id='painting_table'>
                <tbody id='table_body'></tbody>
              </table>
            </section>     
            
        </div>";
        }
        else{
            
            echo "<p>Opps! Page Requires Artist ID</p>";
        }
         
         ?>   
    </body>
    </html>
        
