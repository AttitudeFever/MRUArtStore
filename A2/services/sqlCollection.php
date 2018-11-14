<?php

function getAllArtistSQL(){
    
    $sql = 'SELECT ArtistID, FirstName, LastName, Nationality, Gender, YearOfBirth, YearOfDeath, Details, ArtistLink FROM Artists';
    $sql .= ' ORDER BY LastName';
    
    return $sql;
}


function getArtistSQL($artistID){
    
    $sql = 'SELECT ArtistID, FirstName, LastName, Nationality, Gender, YearOfBirth, YearOfDeath, Details, ArtistLink FROM Artists';
    $sql .=" WHERE ArtistID = $artistID";
 
    return $sql;
}


function getAllGallerySQL(){
    
    $sql = 'SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry, Latitude, Longitude, GalleryWebSite FROM Galleries';
    $sql .= " ORDER BY GalleryName";
    
    return $sql;
    
}

function getGallerySQL($galleryID){
    
    $sql = 'SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry, Latitude, Longitude, GalleryWebSite FROM Galleries';
    $sql .=" WHERE GalleryID = $galleryID";
    
    return $sql;
}

function getAllGenreSQL(){
    
    $sql = 'SELECT GenreID, GenreName, EraID, Description, Link FROM Genres';
    $sql .= " ORDER BY GenreName";
    
    return $sql;
}

function getGenreSQL($genreID){
    
    $sql = 'SELECT GenreID, GenreName, EraID, Description, Link FROM Genres';
    $sql .=" WHERE GenreID = $genreID";
    
    return $sql;
}


function getAllPaintingSQL(){
    
    $sql = 'SELECT PaintingID, ArtistID, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, ';
    $sql .= 'YearOfWork, Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings';
    $sql .= " ORDER BY Title";
    
    return $sql;
}

function getPaintingSQL($paintingID){
    
    $sql = 'SELECT PaintingID, ArtistID, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, ';
    $sql .= 'YearOfWork, Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings';
    $sql .=" WHERE PaintingID = $paintingID";
    
    return $sql;
}

function getPaintingArtistSQL($artistID){
    
    $sql = 'SELECT PaintingID, ArtistID, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, ';
    $sql .= 'YearOfWork, Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings';
    $sql .=" WHERE ArtistID = $artistID";
    
    return $sql;
}

function getPaintingGallerySQL($galleryID){
    
    $sql = 'SELECT PaintingID, ArtistID, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, ';
    $sql .= 'YearOfWork, Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings';
    $sql .=" WHERE GalleryID = $galleryID";
    
    return $sql;
}

function getPaintingGenreSQL($genreID){
    
    $sql = 'SELECT Paintings.PaintingID As PaintingID, PaintingGenres.GenreID, ArtistID, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, ';
    $sql .= 'YearOfWork, Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings INNER JOIN PaintingGenres ON Paintings.PaintingID = PaintingGenres.PaintingID';
    $sql .=" WHERE PaintingGenres.GenreID = $genreID";
    
    return $sql;
}

function getReviewPaintingSQL($paintingID){
    
    $sql = 'SELECT RatingID, PaintingID, ReviewDate, Rating, Comment FROM Reviews';
    $sql .= " WHERE PaintingID = $paintingID";
    
    return $sql;
} 

?>