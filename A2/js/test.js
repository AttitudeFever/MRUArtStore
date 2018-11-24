window.addEventListener('load', function(){
    
// fetch("https://comp3512-assignment-hamid786.c9users.io/A2/services/gallery.php?galleryID=22")
// .then(function (response) {
//                     if (response.ok) {
//                         return response.json();
//                     }
//                     else {
//                         return Promise.reject({
//                             status: response.status,
//                             statusText: response.statusText
//                         })
//                     }
//                 })
//                 .then(function(data){
                    
//                 })
                


function initMap() {
        
            let lati = document.querySelector('#lati').value;
            let long = document.querySelector('#long').value;

            let map;
            map = new google.maps.Map(document.querySelector("#galleryMap"), {
                center: { lat: lati, lng: long },
                zoom: 18
            });
    }
initMap();    

})
