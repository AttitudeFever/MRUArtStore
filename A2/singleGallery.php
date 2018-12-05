
<?php
    include('includes/nav-bar.inc.php');
    include('includes/phpFetch.php');
    
?>

<!DOC TYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/web/logo.png">
        <title>Single Gallery</title>
        <link rel="stylesheet" href="css/singleGallery.css">
        <link rel="stylesheet" href="css/navigation.css">
        <script src="js/hamburger-functionality.js"></script>
        <script src="js/paintingTable.js"></script>

    </head>
    <body id = "galleryBody">
        <?php createNavBar(); ?>
        
        <h2 id='mapHeading'>Gallery Location</h2>
        <div id='galleryMap'>
          
          </div> 
        
        

            
        <?php 
            if (isset($_GET['galleryID']) && $_GET['galleryID'] != "" ) 
            {
                $galleryID = $_GET['galleryID'];    
            }
            $galleryAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/gallery.php?galleryID=$galleryID";
            $data =  fetch($galleryAPI);
            
            foreach($data as $key)
            {
                echo "<div id='gallery_panel'>
                        <h2>Gallery Information</h2>
                        <p>Name: $key->GalleryName</p>
                        <p>Native Name: $key->GalleryNativeName </p>
                        <p>Complete Address: $key->GalleryAddress, $key->GalleryCity,  $key->GalleryCountry </p>
                     </div>";  
                      
            }
        ?>
        
            <div id="painting_panel">
            <section>
          <h2 id="p_heading">Paintings in this Gallery</h2>  
          <table id="painting_table">
            <tbody id="table_body"></tbody>
          </table>
        </section>     
        
    </div>
    </body>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_cSxrSlOMnMX1qhroYV3g1A1Inz02yfk&callback=initMap" async defer></script>
        <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCa5xDa-xIo3amiC2dSpUhz_5DpsVU0gOc&callback=initMap" async defer></script>-->
        <script src="js/map.js"></script>
</html>
