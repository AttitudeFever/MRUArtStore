<?php 
session_start();
$favourites = $_SESSION['favPaintingID'];

include('includes/nav-bar.inc.php');
include('includes/phpFetch.php');

?>

<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8"/>  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/web/logo.png">
        <title>Favourites</title>   
        <link rel="stylesheet" href="css/fav.css">
        <link rel="stylesheet" href="css/navigation.css">
        <script src="js/hamburger-functionality.js"></script>
    </head>
    <body id = "favBody">
    <?php createNavBar();
    echo "<div id='favs_panel'>";
    echo "<h2 id='fav_heading'>Favourite Paintings</h2>";  
    foreach($favourites as $paintingID){
        $paintingAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/painting.php?paintingID=$paintingID";
        $paintingAPIData = fetch($paintingAPI);
        foreach($paintingAPIData as $key){
            $paintingURL = "https://comp3512-assignment-hamid786.c9users.io/A2/singlePainting.php?paintingID=$paintingID";
            $artistURL = "https://comp3512-assignment-hamid786.c9users.io/A2/singleArtist.php?artistID=$key->ArtistID";
            
            $artistID = $key->ArtistID;
            $artistAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/artist.php?artistID=$artistID";
                      
             makeImage($key, $paintingURL);
             makeTitle($paintingURL, $key);
             makeArtist($artistAPI);
             makeYear($key);
             remove($paintingID);
        }
        echo "<br>";
    }
    removeAll();
    echo "</div>";
            
    function makeImage($key, $paintingURL){
        $img_file = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=paintings/full/" . $key->ImageFileName."&width=100";
         echo "<div id='p_image'><a href='$paintingURL'><img src='$img_file' alt='$key->Title;'/></a></div>";
    }
    
    function makeTitle($paintingURL, $key){
        echo "<div id='title'><a href='$paintingURL'>$key->Title</a></div>";
    }
    
    function makeArtist($artistAPI){
        $name;
        $artistAPIData = fetch($artistAPI, $artistURL);
        foreach($artistAPIData as $key){
            if($key->FirstName !=null){
                $name = $key->FirstName." ".$key->LastName;
            }else{
                $name = $key->FirstName;
            }
        }
        
        echo "<div id='artist'><a href='$artistURL'>".$name."</a></div>";
    }
    
    function makeYear($key){
        echo "<div id='year'>$key->YearOfWork</div>";
    }
    
    function remove($paintingID){
        echo "<div id='remove'>
            <a href='https://comp3512-assignment-hamid786.c9users.io/A2/services/remove_from_favorites.php?paintingID=$paintingID'>
                <img src='icons/remove.png' alt='remove' width='30'/>
            </a>
        </div>";
    }
    
    function removeAll(){
        echo "<div id='removeAll'>
            <a href='https://comp3512-assignment-hamid786.c9users.io/A2/services/remove_all_sessions.php'><img src='icons/remove_all.png' alt='remove All' width='30'/></a>
            <p>Remove All</p>
        </div>";
    }
    
    ?>
    </body>
    
</html>