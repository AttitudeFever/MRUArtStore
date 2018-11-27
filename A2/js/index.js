
window.addEventListener('load', function() {
    // localStorage.clear();

    var galleryAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/gallery.php";
    
    //this array will return an ampty array for the first time, next time data from local storage
    let temp_gallery_local_data_array = retrieveStorage_Gallery(); 

    // retrieve from storage or return empty array if doesn't exist
    function retrieveStorage_Gallery() {        
        return JSON.parse(localStorage.getItem('Gallery_Local_Data')) || [];
    } 

    
    //check if local storage exist, if not than the array will be empty and we require fetching
    if (temp_gallery_local_data_array == 0) {

        fetch(galleryAPI)

        .then(function(response){
            if (response.ok){

                return response.json();

            }else {
                return Promise.reject({
                    status: response.status,
                    statusText: response.statusText
                })
            }
        })
        .then((data)=> {
            Create_GalleryList_Local_Storage(data); //after fetch create local storage
        })
        .catch( (error)=> {
            console.log(error);
        });

    //otherwise calls directly to popluate gallery list from local storage
    } else {
        populate_galleryList();
    }

    //local storage creation method
    //calling populate gallery list method
    function Create_GalleryList_Local_Storage(data){

        localStorage.setItem('Gallery_Local_Data', JSON.stringify(data));

        populate_galleryList(); 
    }


    //popluate gallery list method, creating gallery list from local storage
    function populate_galleryList(){

        var GalleryList_Local_Data_Parsed = JSON.parse(localStorage.getItem('Gallery_Local_Data'));

        const galleryList =  document.getElementById('galleryList');
        
        for (let g_list of GalleryList_Local_Data_Parsed){
            
            let galleryLink = "https://comp3512-assignment-hamid786.c9users.io/A2/singleGallery.php?galleryID="+ g_list.GalleryID;
            
            galleryList.innerHTML += "<a href="+galleryLink+"><li>" + g_list.GalleryName + "</li></a>";
        }
           
        var galleryList_panel_ul = document.querySelectorAll('#galleryList_panel ul');
        for (let galleryList_panel of galleryList_panel_ul){
            verticalScroll(galleryList_panel);
        }
    }
    

    
///////////------------------------------without local storage -------------------------------------------------//////////////////// 
    // var galleryAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/gallery.php";
    //         fetch(galleryAPI)

    //     .then(function(response){
    //         if (response.ok){

    //             return response.json();

    //         }else {
    //             return Promise.reject({
    //                 status: response.status,
    //                 statusText: response.statusText
    //             })
    //         }
    //     })
    //     .then((data)=> {
    //           populate_galleryList(data); 
    //     })
    //     .catch( (error)=> {
    //         console.log(error);
    //     });
        
    //     //popluate gallery list method, creating gallery list from local storage
    //     function populate_galleryList(data){


    //     const galleryList =  document.getElementById('galleryList');
        
    //     for (let g_list of data){
    //         galleryList.innerHTML += "<li>" + g_list.GalleryName + "</li>";
    //     }
    //     }
///////////------------------------------without local storage -------------------------------------------------//////////////////// 


    var artistAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/artist.php";
    
    //this array will return an ampty array for the first time, next time data from local storage
    let temp_artist_local_data_array = retrieveStorage_Artist(); 

    // retrieve from storage or return empty array if doesn't exist
    function retrieveStorage_Artist() {        
        return JSON.parse(localStorage.getItem('Artist_Local_Data')) || [];
    } 

    
    //check if local storage exist, if not than the array will be empty and we require fetching
    if (temp_artist_local_data_array == 0) {

        fetch(artistAPI)

        .then(function(response){
            if (response.ok){

                return response.json();

            }else {
                return Promise.reject({
                    status: response.status,
                    statusText: response.statusText
                })
            }
        })
        .then((data)=> {
            Create_Artist_Local_Storage(data); //after fetch create local storage
        })
        .catch( (error)=> {
            console.log(error);
        });

    //otherwise calls directly to popluate gallery list from local storage
    } else {
        populate_Artist();
    }

    //local storage creation method
    //calling populate gallery list method
    function Create_Artist_Local_Storage(data){

        localStorage.setItem('Artist_Local_Data', JSON.stringify(data));

        populate_Artist(); 
    }

    //popluate gallery list method, creating gallery list from local storage
    function populate_Artist(){

        var Artist_Local_Data_Parsed = JSON.parse(localStorage.getItem('Artist_Local_Data'));

        var artist_imgs_box = document.querySelector('#artist_panel');
        
        
        for (let a_list of Artist_Local_Data_Parsed){
            
            let img_file = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=artists/square/" + a_list.ArtistID + "&width=100";
            
            let artistLink = "https://comp3512-assignment-hamid786.c9users.io/A2/singleArtist.php?artistID="+ a_list.ArtistID;
            
            let artistName;
            
            if (a_list.FirstName != null){
                
                artistName = a_list.FirstName + "<br>" + a_list.LastName;
                
            } else{
                
                artistName = "<br>" + a_list.LastName;
            }
                    
                    
                    artist_imgs_box.innerHTML += "<div class= 'artist_box' >" + 
                                                "<a href="+ artistLink + ">" +
                                                    "<img src=" + img_file + "alt=" + a_list.LastName + "/>" +
                                                    "<div class='caption_artist'>" + artistName + "</div>" +
                                                "</a>"+
                                            "</div>";
        }
           var artist_panel = document.getElementById('artist_panel');
           horizontalScroll(artist_panel);   
    }
    
    function horizontalScroll(panel){
        
        panel.style.overflowY="hidden";
        panel.style.overflowX="auto";
        panel.style.whiteSpace="nowrap";
    }
    
    function verticalScroll(panel){
        panel.style.overflowY="auto";
        panel.style.overflowX="hidden";
    }
    
    
    var genreAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/genre.php";
    
    //this array will return an ampty array for the first time, next time data from local storage
    let temp_genre_local_data_array = retrieveStorage_Genre(); 

    // retrieve from storage or return empty array if doesn't exist
    function retrieveStorage_Genre() {        
        return JSON.parse(localStorage.getItem('Genre_Local_Data')) || [];
    } 

    
    //check if local storage exist, if not than the array will be empty and we require fetching
    if (temp_genre_local_data_array == 0) {

        fetch(genreAPI)

        .then(function(response){
            if (response.ok){

                return response.json();

            }else {
                return Promise.reject({
                    status: response.status,
                    statusText: response.statusText
                })
            }
        })
        .then((data)=> {
            Create_Genre_Local_Storage(data); //after fetch create local storage
        })
        .catch( (error)=> {
            console.log(error);
        });

    //otherwise calls directly to popluate gallery list from local storage
    } else {
        populate_Genre();
    }

    //local storage creation method
    //calling populate gallery list method
    function Create_Genre_Local_Storage(data){

        localStorage.setItem('Genre_Local_Data', JSON.stringify(data));

        populate_Genre(); 
    }

    //popluate gallery list method, creating gallery list from local storage
    function populate_Genre(){

        var Genre_Local_Data_Parsed = JSON.parse(localStorage.getItem('Genre_Local_Data'));

        var genre_imgs_box = document.querySelector('#genre_panel');
        
        
        for (let gen_list of Genre_Local_Data_Parsed){

            let img_file = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=genres/" + gen_list.GenreID + "&width=100";
            
            let genreLink = "https://comp3512-assignment-hamid786.c9users.io/A2/singleGenre.php?genreID="+ gen_list.GenreID;
            
                    genre_imgs_box.innerHTML += "<div class= 'genre_box' >" + 
                                                "<a href="+ genreLink + ">" +
                                                    "<img src=" + img_file + "alt=" + gen_list.GenreName + "/>" +
                                                    "<div class='caption_genre'>" + gen_list.GenreName + "</div>" +
                                                "</a>"+
                                            "</div>";
       

        }
            var genre_panel = document.getElementById('genre_panel');
           horizontalScroll(genre_panel); 
    }
    
    

    window.setTimeout( ()=> {
        document.getElementById('loading').style="display:none"; 
    }, 7000);

});