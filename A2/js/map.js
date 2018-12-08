function initMap() {}
initMap();

//when page is loaded, 
window.addEventListener('load', function(){
    
    let urlQuery = window.location.href; //js will acquire the url and split it to get gallery id and make gallery api 
    let ID = urlQuery.split("=");
    var gal_ID = ID[1];
    var $galleryAPI = "https://comp3512-assignment-hamid786.c9users.io/A2/services/gallery.php?galleryID="+gal_ID;

    fetch($galleryAPI)
    .then(function (response) {
        if (response.ok) {
            return response.json();
        }else{
            return Promise.reject({
                status: response.status,
                statusText: response.statusText
            })
        }
    })
    .then(function(data){
        populate_map(data);            
    })  
    .catch( (error)=> {
        console.log(error)
    }); 

    
//popluate map from data received from gallery api data
var longitude;
var latitude;
var city;
    function populate_map(data){    

        for (let pointer of data){
            
            let  longi = pointer.Longitude;
            let lati = pointer.Latitude;
            let cit = pointer.GalleryCity;
            
            longitude = parseFloat(longi); //parse into float
            latitude = parseFloat(lati); //parse into float
            city = cit.toString(); 
            
            initMap(longitude, latitude);
            map.setTilt(45);
            createMarker(map, latitude, longitude, city);
           
        }
    }

//map api method
    var map;
    function initMap(longitude, latitude) {
        map = new google.maps.Map(document.getElementById('galleryMap'), {
        center: {lat: latitude, lng: longitude},
        mapTypeId: 'satellite',
        zoom: 18
        });
        
    }

//map marker creator method
    function createMarker(map, latitude, longitude, city) {
        let imageLatLong = {lat: latitude, lng: longitude };
        let marker = new google.maps.Marker({
            position: imageLatLong,
            title: city,
            map: map
        });
    }
   

})
