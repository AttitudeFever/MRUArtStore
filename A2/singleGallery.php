
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
        <link rel="stylesheet" href="">
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
            $data = json_decode($JSONdata);//converts from JSON to associative array.
            
            foreach($data as $key)
            {
                
               #echo "<script> alert($key->GalleryName)</script>"; //testing, not working, will need to look into 
                $imgfile = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=paintings/full/" . $key->PaintingID;
                
                echo "<div id='galleryInfo'>
                        <p>GalleryName: $key->GalleryName</p>
                        <p>GalleryNativeName: $key->GalleryNativeName </p>
                        <p>GalleryCity: $key->GalleryCity </p>
                        <p>GalleryAddress: $key->GalleryAddress </p>
                        <p>GalleryCountry: $key->GalleryCountry </p>
                        <p id='galleryID' style='display:none'>$key->GalleryID </p>
                     </div> 
                      <div id='galleryMap'>
                        
                      </div>
                      <div id='paintingList'>
                      </div> ";
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
    
</html>
