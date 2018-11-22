<?php 

include('includes/nav-bar.inc.php');

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
         <?php createNavBar(); ?>
            
    <div id="artist_panel">
        <?php 
        
        if (isset($_GET['artistID'] ) and $_GET['artistID'] != ""){
            
            $artistID = $_GET['artistID'];
        }
         
        $artistAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/artist.php?artistID=$artistID";
        $JSONdata = file_get_contents($artistAPI);
        $data = json_decode($JSONdata);
        
       
        foreach($data as $key){
            
            $img_file = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=artists/full/" . $key->ArtistID;
            
            echo "<div class='profile'>
            <h1 id='artistName'>$key->FirstName $key->LastName</h1>
            <img src='$img_file' alt='$key->LastName' />
            <p>Nationality: $key->Nationality</p>
            <p>Gender: $key->Gender</p>
            <p>Year of Birth: $key->YearOfBirth</p>
            <p>Year of Death: $key->YearOfDeath</p>
            <p><a href='$key->ArtistLink' target='_blank'>Wiki Link </a></p>
            <p>Details: $key->Details</p>
            </div>";
        }
        
        ?>
    </div>
    <div id="painting_panel">
            <section>
          <h2 id="p_heading">Paintings of This Artist</h2>  
          <table id="painting_table">
            <tbody id="table_body"></tbody>
          </table>
        </section>     
        
    </div>
            
    </body>
        
