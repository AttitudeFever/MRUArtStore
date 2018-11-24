
<?php
    include('includes/nav-bar.inc.php');
    
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
        
        
        <div id="gallery_panel">
        <?php 
            if (isset($_GET['galleryID']) && $_GET['galleryID'] != "" ) 
            {
                $galleryID = $_GET['galleryID'];    
            }
            $galleryAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/gallery.php?galleryID=$galleryID";
            $JSONdata = file_get_contents($galleryAPI);//file_get_contents converts the echo'd JSON into text
            $data = json_decode($JSONdata);//converts from JSON to object
            
            foreach($data as $key)
            {
                $imgfile = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=paintings/full/" . $key->PaintingID;
                
                echo "<div id='galleryInfo'>
                        <p>GalleryName: $key->GalleryName</p>
                        <p>GalleryNativeName: $key->GalleryNativeName </p>
                        <p>GalleryCity: $key->GalleryCity </p>
                        <p>GalleryAddress: $key->GalleryAddress </p>
                        <p>GalleryCountry: $key->GalleryCountry </p>
                        <p id='lati'> $key->Latitude </p>
                        <p id='long'> $key->Longitude </p> 
                     </div>
                     <div id='galleryMap'> 
                      
                     </div>
                     
                     ";  //outputting values into php and then calling it into js as a means of outputting map, will test for now and delete later
                      
            }
        ?>
        
        </div>
            <div id="painting_panel">
            <section>
          <h2 id="p_heading">Paintings in this Gallery</h2>  
          <table id="painting_table">
            <tbody id="table_body"></tbody>
          </table>
        </section>     
        
    </div>
    </body>
    
    <script src='js/test.js'> 
        let latitudePhp = <?php foreach($data as $key){echo json_encode("$key->Latitude")}; ?>
        let longitudePhp = <?php foreach($data as $key){echo json_encode("$key->Longitude")};?> 
    </script>
        <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCa5xDa-xIo3amiC2dSpUhz_5DpsVU0gOc&callback=initMap' async defer> </script>
    </script>
</html>
