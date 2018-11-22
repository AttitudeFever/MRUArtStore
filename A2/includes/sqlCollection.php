<?php

//single view All artists
function getAllArtistSQL(){
    
    $sql = "SELECT ArtistID, FirstName, LastName, Nationality, Gender, YearOfBirth, YearOfDeath, Details, ArtistLink FROM Artists";
    $sql .= " ORDER BY LastName";
    
    return $sql;
}

//single view particular artists
function getArtistSQL($artistID){
    
    $sql = 'SELECT ArtistID, FirstName, LastName, Nationality, Gender, YearOfBirth, YearOfDeath, Details, ArtistLink FROM Artists';
    $sql .=" WHERE ArtistID = $artistID";
 
    return $sql;
}

//single view All gallery
function getAllGallerySQL(){
    
    $sql = 'SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry, Latitude, Longitude, GalleryWebSite FROM Galleries';
    $sql .= " ORDER BY GalleryName";
    
    return $sql;
    
}

//single view particular gallery
function getGallerySQL($galleryID){
    
    $sql = 'SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry, Latitude, Longitude, GalleryWebSite FROM Galleries';
    $sql .=" WHERE GalleryID = $galleryID";
    
    return $sql;
}

//single view All genres
function getAllGenreSQL(){
    
    $sql = 'SELECT GenreID, GenreName, EraID, Description, Link FROM Genres';
    $sql .= " ORDER BY GenreName";
    
    return $sql;
}

//single view particular gallery
function getGenreSQL($genreID){
    
    $sql = 'SELECT GenreID, GenreName, EraID, Description, Link FROM Genres';
    $sql .=" WHERE GenreID = $genreID";
    
    return $sql;
}


//single view All paintings
function getAllPaintingSQL(){
    
    $sql = 'SELECT PaintingID, ArtistID, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, ';
    $sql .= 'YearOfWork, Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings';
    $sql .= " ORDER BY Title";
    
    return $sql;
}

//single view particular painiting
function getPaintingSQL($paintingID){
    
    $sql = 'SELECT PaintingID, ArtistID, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, ';
    $sql .= 'YearOfWork, Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings';
    $sql .=" WHERE PaintingID = $paintingID";
    
    return $sql;
}

//single view Ratings for particular painiting
function getRatingSQL($paintingID){
    
    $sql = 'SELECT RatingID, PaintingID, ReviewDate, Rating, Comment';
    $sql .= ' FROM Reviews';
    $sql .=" WHERE PaintingID = $paintingID";
    
    return $sql;
}


//helper for getting genreIDs for a single view particular painiting
function getGenreIDFromPaintingGenreSQL($paintingID){
    
    $sql = 'SELECT GenreID, PaintingID FROM PaintingGenres';
    $sql .= " WHERE PaintingID = $paintingID";
    return $sql;
}

// //table view paintings belongs to an artist
function getPaintingArtistSQL($artistID){
    
    $sql = 'SELECT PaintingID, ImageFileName, Title, Artists.ArtistID, YearOfWork, FirstName, LastName';
    $sql .= ' FROM Paintings INNER JOIN Artists ON Paintings.ArtistID = Artists.ArtistID';
    $sql .=" WHERE Artists.ArtistID = $artistID";
    
    return $sql;
}


//table view paintings belongs to a gallery
function getPaintingGallerySQL($galleryID){
    
    $sql = 'SELECT PaintingID, ImageFileName, Title, YearOfWork, Galleries.GalleryID, GalleryName';
    $sql .= ' FROM Paintings INNER JOIN Galleries ON Paintings.GalleryID = Galleries.GalleryID';
    $sql .=" WHERE Galleries.GalleryID = $galleryID";
    
    return $sql;
}

//table view paintings belongs to genres
function getPaintingGenreSQL($genreID){
    
    $sql = 'SELECT P.PaintingID, ImageFileName, Title, YearOfWork, PG.GenreID, G.GenreName';
    $sql .= " FROM Paintings P";
    $sql .= " INNER JOIN PaintingGenres PG ON P.PaintingID = PG.PaintingID";
    $sql .= " INNER JOIN Genres G ON G.GenreID = PG.GenreID";
    $sql .= " WHERE G.GenreID = $genreID";
    
    return $sql;
}

?>