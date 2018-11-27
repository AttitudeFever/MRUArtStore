function initMap() {}
initMap();
window.addEventListener('load', function(){
    
    let urlQuery = window.location.href;
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

    

var longitude;
var latitude;
var city;
    function populate_map(data){    

        for (let pointer of data){
            
            let  longi = pointer.Longitude;
            let lati = pointer.Latitude;
            let cit = pointer.GalleryCity;
            
            longitude = parseFloat(longi);
            latitude = parseFloat(lati);
            city = cit.toString(); 
            
            initMap(longitude, latitude);
            map.setTilt(45);
            createMarker(map, latitude, longitude, city);
           
        }
    }

    var map;
    function initMap(longitude, latitude) {
        map = new google.maps.Map(document.getElementById('galleryMap'), {
        center: {lat: latitude, lng: longitude},
        mapTypeId: 'satellite',
        zoom: 18
        });
        
    }
    
    
    function createMarker(map, latitude, longitude, city) {
        let imageLatLong = {lat: latitude, lng: longitude };
        let marker = new google.maps.Marker({
            position: imageLatLong,
            title: city,
            map: map
        });
    }
   

})
