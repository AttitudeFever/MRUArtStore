
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
        
    </head>
    <body>
        <?php createNavBar(); ?>
        
        
        <div class = "container"> 
        <?php 
            if(isset($_GET['galleryID']) && $_GET['galleryID'] != "" ) 
            {
                $galleryID = $_GET['galleryID'];    
            }
            $gallaryAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/gallery.php?galleryID=$galleryID";
            $JSONdata = file_get_contents($galleryAPI);
            $data = json_decode($JSONdata);
            
            foreach($data as $key)
            {
                echo "$key->GalleryName"; //testing, not working, will need to look into 
                echo "<div id='galleryInfo'> </div> 
                      <div id='galleryMap'> </div>
                      <div id='paintingList'> </div>
                
                
                ";
            }
        
        ?>
        
        </div>
    </body>
    
</html>
