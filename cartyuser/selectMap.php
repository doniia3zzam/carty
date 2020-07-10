<script type="text/javascript"
src="https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyDS5AwUrTwTyRSjOA3KFWFnGFVe-6v8UOM">
</script>

                            <script>
                                /**
                                * Create new map
                                */
                                var infowindow;
                                var map;
                                var red_icon =  'http://maps.google.com/mapfiles/ms/icons/red-dot.png' ;
                              
                                myOptions = {
                                    zoom: 10,
                                    center: new google.maps.LatLng(30.033333, 31.233334),
                                    mapTypeId: 'roadmap'
                                };
                                map = new google.maps.Map(document.getElementById('map'), myOptions);

                            // // // // //Current Location // // // // //
                                if ("geolocation" in navigator){
                                navigator.geolocation.getCurrentPosition(function(position){ 
                                    var currentLatitude = position.coords.latitude;
                                    var currentLongitude = position.coords.longitude;
                                    var center= new google.maps.LatLng(currentLatitude, currentLongitude);
                                    map.setCenter(center);
                                    map.setZoom(18);
                    


                                    var newdiv = document.getElementById('currentLocation');
                                        newdiv.innerHTML = "<input name='latt' hidden value="+currentLatitude+"><input name='lngg' hidden value="+currentLongitude+"> ";

                                    // var infoWindowHTML ="You are here! ";
                                    // var infoWindow = new google.maps.InfoWindow({map: map, content: infoWindowHTML});
                                    var currentLocation = { lat: currentLatitude, lng: currentLongitude };
                                    var latlong = google.maps.LatLng(currentLatitude,currentLongitude)
                                    var marker = new google.maps.Marker({ position:latlong, map:map, title:"You are here!" });

                                    infowindow.setPosition(currentLocation);
                                  

                                  
                                });

                             
                            }
                       
                              


                        



                                /**
                                * Global marker object that holds all markers.
                                * @type {Object.<string, google.maps.LatLng>}
                                */
                                var markers = {};

                                /**
                                * Concatenates given lat and lng with an underscore and returns it.
                                * This id will be used as a key of marker to cache the marker in markers object.
                                * @param {!number} lat Latitude.
                                * @param {!number} lng Longitude.
                                * @return {string} Concatenated marker id.
                                */
                                var getMarkerUniqueId= function(lat, lng) {
                                    return lat + '_' + lng;
                                };

                                /**
                                * Creates an instance of google.maps.LatLng by given lat and lng values and returns it.
                                * This function can be useful for getting new coordinates quickly.
                                * @param {!number} lat Latitude.
                                * @param {!number} lng Longitude.
                                * @return {google.maps.LatLng} An instance of google.maps.LatLng object
                                */
                                var getLatLng = function(lat, lng) {
                                    return new google.maps.LatLng(lat, lng);
                                };
                                                        /**
                                * Binds click event to given map and invokes a callback that appends a new marker to clicked location.
                                */
                                var markersArray = [];

                                function clearOverlays() {
                                for (var i = 0; i < markersArray.length; i++ ) {
                                    markersArray[i].setMap(null);
                                }
                                markersArray.length = 0;
                                }

                                var addMarker = google.maps.event.addListener(map, 'click', function(e) {
                                    clearOverlays();
                               
                                    var lat = e.latLng.lat(); // lat of clicked point
                                    var lng = e.latLng.lng(); // lng of clicked point
                                    var newdiv = document.getElementById('currentLocation');
                                        newdiv.innerHTML = "<input name='latt' hidden value="+lat+"><input name='lngg' hidden value="+lng+"> ";
                                    var markerId = getMarkerUniqueId(lat, lng); // an that will be used to cache this marker in markers object.
                                    var marker = new google.maps.Marker({
                                        position: getLatLng(lat, lng),
                                        map: map,
                                        animation: google.maps.Animation.DROP,
                                        id: 'marker_' + markerId,
                                        
                                    });
                                    markers[markerId] = marker; // cache marker in markers object
                                    bindMarkerEvents(marker); // bind right click event to marker
                                    bindMarkerinfo(marker); // bind infowindow with click event to marker
                                    markersArray.push(marker);
                                    google.maps.event.addListener(marker,"click",function(){});
                                    });

                                /**
                                * Binds  click event to given marker and invokes a callback function that will remove the marker from map.
                                * @param {!google.maps.Marker} marker A google.maps.Marker instance that the handler will binded.
                                */
                                var bindMarkerinfo = function(marker) {
                                    google.maps.event.addListener(marker, "click", function (point) {
                                        var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng()); // get marker id by using clicked point's coordinate
                                        var marker = markers[markerId]; // find marker
                                        infowindow = new google.maps.InfoWindow();
                                        infowindow.setContent(marker.html);
                                        infowindow.open(map, marker);
                                        // removeMarker(marker, markerId); // remove it
                                    });
                                };

                                /**
                                * Binds right click event to given marker and invokes a callback function that will remove the marker from map.
                                * @param {!google.maps.Marker} marker A google.maps.Marker instance that the handler will binded.
                                */
                                var bindMarkerEvents = function(marker) {
                                    google.maps.event.addListener(marker, "rightclick", function (point) {
                                        var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng()); // get marker id by using clicked point's coordinate
                                        var marker = markers[markerId]; // find marker
                                        removeMarker(marker, markerId); // remove it
                                    });
                                };

                                /**
                                * Removes given marker from map.
                                * @param {!google.maps.Marker} marker A google.maps.Marker instance that will be removed.
                                * @param {!string} markerId Id of marker.
                                */
                                var removeMarker = function(marker, markerId) {
                                    marker.setMap(null); // set markers setMap to null to remove it from map
                                    delete markers[markerId]; // delete marker instance from markers object
                                };


                                function downloadUrl(url, callback) {
                                        var request = window.ActiveXObject ?
                                            new ActiveXObject('Microsoft.XMLHTTP') :
                                            new XMLHttpRequest;

                                        request.onreadystatechange = function() {
                                            if (request.readyState == 4) {
                                                callback(request.responseText, request.status);
                                            }
                                        };

                                        request.open('GET', url, true);
                                        request.send(null);
                                    }


                                </script>
