window.addEventListener('load' , ()=>{

var a_ID = document.getElementById('atristID').textContent;
var paintingsArtistAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/painting.php?artistID="+a_ID;
    //fetch and create local storage for paintings of that particular gallery


//fetch and create local storage for paintings of that particular gallery
        fetch(paintingsArtistAPI)
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
        .then((painting_data)=> {
            
            Create_Painting_Local_Storage(painting_data);
            
        })
        .catch( (error)=> {
            console.log(error);
        })
   

    //creating local storage for paintings of that particular gallery
    //calling populate paintings method
    function Create_Painting_Local_Storage(painting_data){

        localStorage.setItem('Painting_Local_Data', JSON.stringify(painting_data));

        populate_paintings();
    }


    //populate painthings methods is calling: 
    //Create Table Head Method: to create clickable headings for the painting table
    //based on artist method: when table is first created it will based on artist's last name
    //sorting_request method: listening for different type of sorting button clicks
    function populate_paintings(){

        let Painting_Local_Data_Parsed = JSON.parse(localStorage.getItem('Painting_Local_Data'));

        Create_Table_Head();
        basedOnArtist(Painting_Local_Data_Parsed);
        sorting_request(Painting_Local_Data_Parsed);   
        
    }

    //create table head method is creating painting table head with clickable buttons
    function Create_Table_Head() {
        document.getElementById('table_body').innerHTML="";

        var th_set = [];
        var tr = document.createElement('tr');
        tr.setAttribute('id', 'table_head');

        var th_img = document.createElement('th');
        th_img.textContent = "";
        th_set.push(th_img);

        var th_artist = document.createElement('th');
        th_artist.innerHTML = "<button id='btn_artist'>Artist &nbsp; &nbsp; &nbsp; &#9660;</button>";
        th_artist.setAttribute('id', 'artist');
        th_set.push(th_artist);

        var th_title = document.createElement('th');
        th_title.innerHTML = "<button id='btn_title'>Title &nbsp; &nbsp; &nbsp; &#9660;</button>";
        th_title.setAttribute('id', 'title');
        th_set.push(th_title);

        var th_year = document.createElement('th');
        th_year.innerHTML = "<button id='btn_year'>Year &nbsp; &nbsp; &nbsp; &#9660;</button>";
        th_year.setAttribute('id', 'year');
        th_set.push(th_year);

        for(let i=0; i<th_set.length; i++){
            tr.appendChild(th_set[i]);
        }
        
        document.getElementById('table_body').appendChild(tr);
        
        
        
        
    }

    //based on artist method is creating paintings table body from painting local storage for that particular clicked gallery
    //nested sort function to arrange based on artist's last name
    //calling helper methods: painting_details_Array_Object and populate_sorted_paintings
    //calling painting view window method: listening clicks on painting table rows
    function basedOnArtist(Painting_Local_Data_Parsed){

        let paintings_details = painting_details_Array_Object(Painting_Local_Data_Parsed); //helper method

        const sortedPaintingsByArtist = paintings_details.sort(function(a,b) { //sort function artist's last name
            if (a.artist < b.artist) {
                return -1;
            } else if (a.artist > b.artist) {
                return 1;
            }
            else {
                return 0;
            }
        });

        populate_sorted_paintings(sortedPaintingsByArtist); //helper method

    }

    //based on title method is creating paintings table body from painting local storage for that particular clicked gallery
    //nested sort function to arrange based on title
    //calling helper methods: painting_details_Array_Object and populate_sorted_paintings
    //calling painting view window method: listening clicks on painting table rows
    function basedOnTitle(Painting_Local_Data_Parsed){

        let paintings_details = painting_details_Array_Object(Painting_Local_Data_Parsed); //helper method

        const sortedPaintingsByTitle = paintings_details.sort(function(a,b) {
            if (a.title < b.title) {
                return -1;
            } else if (a.title > b.title) {
                return 1;
            }
            else {
                return 0;
            }
            });

        populate_sorted_paintings(sortedPaintingsByTitle); //helper method

    }

    //based on year method is creating paintings table body from painting local storage for that particular clicked gallery
    //nested sort function to arrange based on year
    //calling helper methods: painting_details_Array_Object and populate_sorted_paintings
    //calling painting view window method: listening clicks on painting table rows
    function basedOnYear(Painting_Local_Data_Parsed){
    
        let paintings_details = painting_details_Array_Object(Painting_Local_Data_Parsed); //helper method

        const sortedPaintingsByYear = paintings_details.sort(function(a,b) {
            if (a.year < b.year) {
                return -1;
            } else if (a.year > b.year) {
                return 1;
            }
            else {
                return 0;
            }
            });

        populate_sorted_paintings(sortedPaintingsByYear); //helper method

    }

    //Helper method painting_details_Array_Object creates and return an Array of Objects for painting local data for easy sorting
    function painting_details_Array_Object(Painting_Local_Data_Parsed){

        let paintings_details = [];
        
        
        for (let i=0; i < Painting_Local_Data_Parsed.length; i++){

            paintings_details[i] = {};

            paintings_details[i].img_id = Painting_Local_Data_Parsed[i].ImageFileName;

            paintings_details[i].artist = document.getElementById('artistName').textContent; 

            paintings_details[i].title = Painting_Local_Data_Parsed[i].Title;
            paintings_details[i].year = Painting_Local_Data_Parsed[i].YearOfWork;
            
            paintings_details[i].paintingID = Painting_Local_Data_Parsed[i].PaintingID;
        }

        return paintings_details;
    }

    //Helper method populate_sorted_paintings is populating sorted data into table rows
    function populate_sorted_paintings(sortedPaintings){

        for (let i=0; i< sortedPaintings.length; i++){
            let table_row_set = [];
            let table_row = document.createElement('tr');
            let table_data_img = document.createElement('td');
            let table_data_artist = document.createElement('td');
            let table_data_title = document.createElement('td');
            let table_data_year = document.createElement('td');


            let image_id = sortedPaintings[i].img_id;
            let img_url = "https://comp3512-assignment-hamid786.c9users.io/A2/services/img-maker.php?file=paintings/square/" + image_id + "&width=100";
            
            let paintingURL = "https://comp3512-assignment-hamid786.c9users.io/A2/singlePainting.php?paintingID="+sortedPaintings[i].paintingID;
            let anchor = document.createElement('a');
            anchor.setAttribute('href', paintingURL);
            
            let thumbnail = document.createElement('img');
            thumbnail.setAttribute('src', img_url);
            
            anchor.appendChild(thumbnail);
            table_data_img.appendChild(anchor);
            
            table_row_set.push(table_data_img);
            
            let artistURL = "https://comp3512-assignment-hamid786.c9users.io/A2/singleArtist.php?artistID="+a_ID;    
            table_data_artist.innerHTML = "<a href="+artistURL+">"+sortedPaintings[i].artist+"</a>";
            table_row_set.push(table_data_artist);

            table_data_title.innerHTML = "<a href="+paintingURL+">"+sortedPaintings[i].title+"</a>";
            table_data_title.setAttribute('class','p_title');
            table_row_set.push(table_data_title);

            table_data_year.textContent = sortedPaintings[i].year;
            table_row_set.push(table_data_year);

            for (let i=0; i < table_row_set.length; i++){
                table_row.appendChild(table_row_set[i]);
            }
            table_row.setAttribute('class', 'table_data');
            document.getElementById('table_body').appendChild(table_row);

        }

        thumbnail_effect();
    }

    //sorting_request method: listening to clicks button on table head, each button is calling different based on methods
    //whenever a based on method is requested, refresh table is called up to refresh the existing table body 
    function sorting_request(Painting_Local_Data_Parsed){

        let artist_sort = document.getElementById('btn_artist');
        let title_sort = document.getElementById('btn_title');
        let year_sort = document.getElementById('btn_year');

        artist_sort.addEventListener('click', ()=>{
            refresh_table_data();
            basedOnArtist(Painting_Local_Data_Parsed);
        });

        title_sort.addEventListener('click', ()=>{
            refresh_table_data();
            basedOnTitle(Painting_Local_Data_Parsed);
            });

        year_sort.addEventListener('click', ()=>{
            refresh_table_data();
            basedOnYear(Painting_Local_Data_Parsed);
        });
            
    }

    //refresh table method, refresh's the table body to make it ready for new requested arrangement
    function refresh_table_data(){

        let parentNode = document.getElementById('table_body');
        let currentNode = document.getElementById('table_head');

        let total_number_of_table_rows = document.getElementById("painting_table").rows.length;

        let number_of_rows_need_to_delete = total_number_of_table_rows - 1

        for (let i=0; i < number_of_rows_need_to_delete; i++){
            parentNode.removeChild(currentNode.nextSibling);
        }
    }

function thumbnail_effect(){

    var thumbnails = document.querySelectorAll('#table_body .table_data td img');
    
    var initialX;
    var initialY;
    
    for (let thumbnail of thumbnails){
        
        let img_url = thumbnail.getAttribute('src');
        
        thumbnail.addEventListener('mouseenter', ()=>{
            
            let new_imgURL = img_url.replace('width=100', 'width=200');
            
            thumbnail.setAttribute('src', new_imgURL);
            
            initialX = event.clientX;
            initialY = event.clientY;
            
        });
        
        
        thumbnail.addEventListener('mousemove', ()=>{
            
            var currentX = event.clientX;
            var CurrentY = event.clientY;
            
            let newX = initialX - currentX;
            let newY = initialY - CurrentY;
            
            thumbnail.style.left = newX+'px';
            thumbnail.style.top = newY+'px';
            
        });
        
         thumbnail.addEventListener('mouseleave', ()=>{
            
            let old_imgURL = img_url.replace('width=200', 'width=100');
      
            thumbnail.setAttribute('src', old_imgURL);

            thumbnail.style.left = 0+'px';
            thumbnail.style.top = 0+'px';
        
        });
        
    }
}


});