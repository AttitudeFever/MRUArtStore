<?php 
session_start();


include('includes/nav-bar.inc.php'); //navigation package
include('includes/phpFetch.php'); //php fetching package

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
        
    <?php 
    
    createNavBar(); //generate navigation bar
    
    //chekc if login session exist
    if (isset($_SESSION['sessionID'])){
        
        $favourites = $_SESSION['favPaintingID']; //acquire fav list
        $customerID = $_SESSION['sessionID']; //acquire custmer ID
        echo "<div id='favs_panel'>";
        echo "<h2 id='fav_heading'>Favourite Paintings</h2>";  
        foreach($favourites[$customerID] as $paintingID){ //loop though fav list array and make api
            $paintingAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/painting.php?paintingID=$paintingID";  //api
            $paintingAPIData = fetch($paintingAPI); //fetch api
            foreach($paintingAPIData as $key){ //loop through api
                $paintingURL = "https://comp3512-assignment-hamid786.c9users.io/A2/singlePainting.php?paintingID=$paintingID"; 
                $artistURL = "https://comp3512-assignment-hamid786.c9users.io/A2/singleArtist.php?artistID=$key->ArtistID";
                
                $artistID = $key->ArtistID;
                $artistAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/artist.php?artistID=$artistID";
                
                 makeImage($key, $paintingURL); //make painting image
                 makeTitle($paintingURL, $key); //make title of painting
                 makeArtist($artistAPI, $artistURL); //make artist of that painting
                 makeYear($key); //make year of work for that painting
                 remove($paintingID); //make remove icon and function for that painting
            }
            echo "<br>";
        }
        removeAll(); //make remove all icon and function for all paintings
        echo "</div>";
    }else {
        header('Location: index.php');
    }
            
    //helper method make image for the painting
    function makeImage($key, $paintingURL){
        $img_file = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=paintings/full/" . $key->ImageFileName."&width=100";
         echo "<div id='p_image'><a href='$paintingURL'><img src='$img_file' alt='$key->Title;'/></a></div>";
    }

    //helper method make title for the painting
    function makeTitle($paintingURL, $key){
        echo "<div id='title'>
        <p class='caption'>Title</p>
        <a href='$paintingURL'>$key->Title</a>
        </div>";
    }
    
    //helper method make artist for that painting
    function makeArtist($artistAPI, $artistURL){
        $name;
        $artistAPIData = fetch($artistAPI);
        foreach($artistAPIData as $key){
            if($key->FirstName !=null){
                $name = $key->FirstName." ".$key->LastName;
            }else{
                $name = $key->FirstName;
            }
        }
        
        echo "<div id='artist'>
        <p class='caption'>Artist</p>
        <a href='$artistURL'>".$name."</a>
        </div>";
    }
    
    //helper method make year of workd that painting
    function makeYear($key){
        echo "<div id='year'><p class='caption'>YOW</p>
        $key->YearOfWork
        </div>";
    }
    
    //helper method make remove icon and function for that painting
    function remove($paintingID){
        echo "<div id='remove'>
        <p class='caption'>Action</p>
            <a href='https://comp3512-assignment-hamid786.c9users.io/A2/services/remove_from_favorites.php?paintingID=$paintingID'>
                <img src='icons/remove.png' alt='remove'/>
            </a>
        </div>";
    }
    
    //helper method remove all
    function removeAll(){
        echo "<div id='removeAll'>
            <a href='https://comp3512-assignment-hamid786.c9users.io/A2/services/remove_all_paintings.php'><img src='icons/remove_all.png' alt='remove All'/>
            <p>Remove All</p></a>
            
        </div>";
    }
    ?>
    </body>
    
</html>