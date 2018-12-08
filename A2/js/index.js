// index page is getting done through JS

window.addEventListener('load', function() {
    //localStorage.clear();

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
        
        //create slideshow <div>s each <div> has 10 items init and # of total <div>s are based on how many items in the array / 10,
        let count=1;
        for (let g_list of GalleryList_Local_Data_Parsed){
            if(count ==11){count=1;}
            if (count ==1){
                galleryList.innerHTML += "<div class='slidesGal fade'></div>";
            }
            count++;
        }
        
        //when slideshow <div>s are ready when can populate each <div>s with 10 items each
        count=1;
        let i=0;
        let slides = document.querySelectorAll('.slidesGal');
        for (let g_list of GalleryList_Local_Data_Parsed){
            
            let galleryLink = "https://comp3512-assignment-hamid786.c9users.io/A2/singleGallery.php?galleryID="+ g_list.GalleryID;
            
            if (count <11){
                slides[i].innerHTML += "<a href="+galleryLink+"><li>" + g_list.GalleryName + "</li></a>";
            }
            count++;
            if (count==11){count=1; i++;}
            }
           
           slideShowGal();
        }
        
        
    //slideShow for Gallery List
    var indexGal=0;    
    function slideShowGal(){
        var up = document.getElementById('up');
        var down = document.getElementById('down');
        let slides = document.querySelectorAll('.slidesGal');
        
        up.disabled=true;
        up.style.visibility="hidden";
        slides[indexGal].style.display="block";
        
        down.addEventListener('click', ()=>{
            up.style.visibility="visible";
            up.disabled=false;
            slides[indexGal].style.display="none";
            slides[indexGal+1].style.display="block";
            
            if (indexGal == (slides.length-2)){
                ++indexGal;
                down.disabled = true;
                down.style.visibility="hidden"
            }else{indexGal++;}
        });
        
        up.addEventListener('click', ()=>{
            down.disabled= false;
            down.style.visibility = "visible";
            slides[indexGal].style.display="none";
            slides[indexGal-1].style.display="block";
            
            if (indexGal== 1){
                indexGal--;
                up.disabled = true;
                up.style.visibility ="hidden"; 
            }else{indexGal--;}
        });
    }
    
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

    //otherwise calls directly to popluate artist list from local storage
    } else {
        populate_Artist();
    }

    //local storage creation method
    //calling populate artist list method
    function Create_Artist_Local_Storage(data){

        localStorage.setItem('Artist_Local_Data', JSON.stringify(data));

        populate_Artist(); 
    }

    //popluate artist list method, creating artist list from local storage
    function populate_Artist(){
       
        var Artist_Local_Data_Parsed = JSON.parse(localStorage.getItem('Artist_Local_Data'));

        var artist_panel = document.querySelector('#artist_panel');
        
        //create slideshow <div>s each <div> has 4 items init and # of total <div>s are based on how many items in the array / 4
         let count=1;
        for (let a_list of Artist_Local_Data_Parsed){
            
            if(count ==5){count=1;}
            if (count ==1){
                artist_panel.innerHTML +="<div class='slidesA fade'></div>";
                }
            count++;
        }
        
        //when slideshow <div>s are ready when can populate each <div>s with 4items each
        count=1;
        let i=0;
        let slides = document.querySelectorAll('.slidesA');
        for (let a_list of Artist_Local_Data_Parsed){
            let width=100;
            let img_file = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=artists/square/" + a_list.ArtistID + "&width="+width;
            
            let artistLink = "https://comp3512-assignment-hamid786.c9users.io/A2/singleArtist.php?artistID="+ a_list.ArtistID;
            
            let artistName;
            
            if (a_list.FirstName != null){
                
                artistName = a_list.FirstName + "<br>" + a_list.LastName;
                
            } else{
                
                artistName = "<br>" + a_list.LastName;
            }
            
            if (count<5){
                slides[i].innerHTML += "<div class='artist_box'>" + 
                                            "<a href="+ artistLink + ">" +
                                                "<img src=" + img_file + "alt=" + a_list.LastName + "/>" +
                                                "<div class='caption_artist'>" + artistName + "</div>" +
                                            "</a>"+
                                        "</div>";
            }
            count++;
            if (count==5){count=1; i++;}
        }


        numberingA();
        slideShowA();
    }
    
    //helper method for previous condition on last index
    function minCondition(previous){
        previous.disabled=true;
        previous.style.visibility="hidden";
    }
    
    //helper method for next condition on last index
    function maxCondition(next){
        next.disabled=true;
        next.style.visibility="hidden";
    }
    
    //helper method for next and previous condition on middle indexes
    function middleCondition(previous, next){
        next.style.visibility="visible"
        next.disabled=false;
        previous.style.visibility="visible";
        previous.disabled=false;
    }
    
    //slideShow for artist List
    var indexA=0;
    function slideShowA(){
        var numbers = document.querySelectorAll('.numA');
        var next = document.getElementById('nextA');
        var previous = document.getElementById('previousA');
        let slides = document.querySelectorAll('.slidesA');
        minCondition(previous);
        slides[indexA].style.display="block";
        numbers[indexA].style.backgroundColor="rgb(80, 156, 133)";
            next.addEventListener('click', ()=>{
                middleCondition(previous, next);
            slides[indexA].style.display="none";
            numbers[indexA].style.backgroundColor="black";
            slides[indexA+1].style.display="block";
            numbers[indexA+1].style.backgroundColor="rgb(80, 156, 133)";

            if (indexA == (slides.length-2)){
                ++indexA;
                maxCondition(next);
            }else{indexA++;}
        });

        previous.addEventListener('click', ()=>{
            middleCondition(previous, next);
            slides[indexA].style.display="none";
            numbers[indexA].style.backgroundColor="black";
            slides[indexA-1].style.display="block";
            numbers[indexA-1].style.backgroundColor="rgb(80, 156, 133)";
            if (indexA == 1){
                indexA--;
                minCondition(previous);
            }else{indexA--;}
        });
    }

//helper method to display numbering index for artist panel
function numberingA(){
    let panel_slidesA = document.querySelectorAll('.slidesA');
    let panelA = document.querySelector('#artist_panel .numbers');
    for (let i=1; i<=panel_slidesA.length; i++){
        panelA.innerHTML += "<div class='numA'>"+i+"</div>";
    }
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

    //otherwise calls directly to popluate genre list from local storage
    } else {
        populate_Genre();
    }

    //local storage creation method
    //calling populate genre list method
    function Create_Genre_Local_Storage(data){

        localStorage.setItem('Genre_Local_Data', JSON.stringify(data));

        populate_Genre(); 
    }

    //popluate genre list method, creating genre list from local storage
    function populate_Genre(){

        var Genre_Local_Data_Parsed = JSON.parse(localStorage.getItem('Genre_Local_Data'));

        var genre_panel = document.querySelector('#genre_panel');
        
        //create slideshow <div>s each <div> has 4 items init and # of total <div>s are based on how many items in the array / 4
        let count=1;
        for (let gen_list of Genre_Local_Data_Parsed){
            if(count ==5){count=1;}
            if (count ==1){
                    genre_panel.innerHTML +="<div class='slidesG fade'></div>";
                }
            count++;
        }
            
        //when slideshow <div>s are ready when can populate each <div>s with 4items each
        count=1;
        let i=0;
        let slides = document.querySelectorAll('.slidesG');
        for (let gen_list of Genre_Local_Data_Parsed){
            
            let width =100;
            
            let img_file = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=genres/" + gen_list.GenreID + "&width="+width;
            
            let genreLink = "https://comp3512-assignment-hamid786.c9users.io/A2/singleGenre.php?genreID="+ gen_list.GenreID;
            
            if (count<5){
            slides[i].innerHTML += "<div class= 'genre_box' >" + 
                                                "<a href="+ genreLink + ">" +
                                                    "<img src=" + img_file + "alt=" + gen_list.GenreName + "/>" +
                                                    "<div class='caption_genre'>" + gen_list.GenreName + "</div>" +
                                                "</a>"+
                                            "</div>";
            }
            count++;
            if (count==5){count=1; i++}
    }
        numberingG();
        slideShowG();
}

    //Slide Show for genre list
    var indexG=0;
    function slideShowG(){
        var numbers = document.querySelectorAll('.numG');
        var next = document.getElementById('nextG');
        var previous = document.getElementById('previousG');
        let slides = document.querySelectorAll('.slidesG');
        minCondition(previous);
        slides[indexG].style.display="block";
        numbers[indexG].style.backgroundColor="rgb(80, 156, 133)";
            next.addEventListener('click', ()=>{
                middleCondition(previous, next);
            slides[indexG].style.display="none";
            numbers[indexG].style.backgroundColor="black";
            slides[indexG+1].style.display="block";
            numbers[indexG+1].style.backgroundColor="rgb(80, 156, 133)";

            if (indexG == (slides.length-2)){
                ++indexG;
                maxCondition(next);
            }else{indexG++;}
        });

        previous.addEventListener('click', ()=>{
            middleCondition(previous, next);
            slides[indexG].style.display="none";
            numbers[indexG].style.backgroundColor="black";
            slides[indexG-1].style.display="block";
            numbers[indexG-1].style.backgroundColor="rgb(80, 156, 133)";
            if (indexG == 1){
                indexG--;
                minCondition(previous);
            }else{indexG--;}
        });
    }

//helper method to display numbering index for genre panel
function numberingG(){
    let panel_slidesG = document.querySelectorAll('.slidesG');
    let panelG = document.querySelector('#genre_panel .numbers');
    for (let i=1; i<=panel_slidesG.length; i++){
        panelG.innerHTML += "<div class='numG'>"+i+"</div>";
    }
}

//loading animation run for 2 secs enough for fetching time, 
// Reson for putting here and not on fecthing:
// can't put on actual fecthing because it will be very quick as 4 items per diplay is very short time and animation will never be seen or play in real
    window.setTimeout( ()=> {
        document.getElementById('loading').style="display:none"; 
    }, 2000);

});