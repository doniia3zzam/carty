// if HTML DOM Element that contains the map is found...
if (document.getElementById('map-canvas')) {
    var inputLong;
    var inputLat;
    var content;
    var latitude = 52.525595;
    var longitude = 13.393085;
    var map;
    var marker;
    navigator.geolocation.getCurrentPosition(loadMap);

    function loadMap(location) {
        if (location.coords) {
            latitude = location.coords.latitude;
            longitude = location.coords.longitude;
        }

        // Coordinates to center the map
        var myLatlng = new google.maps.LatLng(latitude, longitude);

        // Other options for the map, pretty much selfexplanatory
        var mapOptions = {
            zoom: 14,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        // Attach a map to the DOM Element, with the defined settings
        map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        inputLong = document.getElementById('inputLong');
        inputLat = document.getElementById('inputLat');
        content = document.getElementById('information');
        google.maps.event.addListener(map, 'click', function(e) {
          placeMarker(e.latLng);
        });
                                          
		    marker = new google.maps.Marker({
    	    map: map
		    });
    }
}
function placeMarker(location) {
    marker.setPosition(location);
    //map.setCenter(location)
    inputLong.value = location.lng();
    inputLat.value = location.lat();
    // content.innerHTML = "Lat: " + location.lat() + " / Long: " + location.lng();
    google.maps.event.addListener(marker, 'click', function(e) {
        new google.maps.InfoWindow({
            content: "Lat: " + location.lat() + " / Long: " + location.lng()

        }).open(map,marker);
    });
}