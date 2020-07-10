<html>
    <head>
        <meta charset='utf-8' />
        <title>Google Maps: KML Layer</title>
        <script id='gm' async defer src="//maps.google.com/maps/api/js?key=AIzaSyAjp8cvAcEYCwzuCyTQORL3Z1iQPdQMg_8&callback=initMap&region=en-GB&language=en"></script>
        <script>

            var infowindow, map, Paisley, kmlLayer;
            var text, pos

            function initMap(){
                infowindow = new google.maps.InfoWindow;
                Paisley = { lat: 55.845890, lng: -4.423741 };

                map = new google.maps.Map( document.getElementById('map'), {
                    zoom: 17,
                    center: Paisley
                });

                kmlLayer = new google.maps.KmlLayer({
                    url: 'https://firebasestorage.googleapis.com/v0/b/just-don-t.appspot.com/o/Project%20examples.kml?alt=media&token=65140cfc-de3a-4658-8b2b-0354f4909d38',
                    suppressInfoWindows: true,
                    map: map
                });

                kmlLayer.addListener( 'click', function( event ) {
                    text = event.featureData.description;
                    showInContentWindow( text );
                });


                if( navigator.geolocation ) {
                    navigator.geolocation.getCurrentPosition( function( position ) {
                        pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        infowindow.setPosition( pos );
                        infowindow.setContent( 'Location found.' );
                        infowindow.open( map );
                        map.setCenter( pos );

                        console.info( 'Location found: %s, %s', pos.lat, pos.lng );
                    }, function() {
                        handleLocationError( true, infowindow, map.getCenter() );
                    });
                } else {
                    handleLocationError( false, infowindow, map.getCenter() );
                }

            }

            function showInContentWindow( text ) {
                document.getElementById('content-window').innerHTML = text;
            }
            function handleLocationError( browserHasGeolocation, infowindow, pos ) {
                infowindow.setPosition( pos );
                infowindow.setContent( browserHasGeolocation ? 'Error: The Geolocation service failed.' : 'Error: Your browser doesn\'t support geolocation.');
                infowindow.open( map );
            }
        </script>
        <style>
            body{ background:white; }
            #container{
                width: 90%;
                min-height: 90vh;
                height:auto;
                box-sizing:border-box;
                margin: auto;
                float:none;
                margin:1rem auto;
                background:whitesmoke;
                padding:1rem;
                border:1px solid gray;
                display:block;
            }
            #map {
                width: 100%;
                height: 100%;
                clear:none;
                display:block;
                z-index:1!important;
                background:white;
            }
        </style>
    </head>
    <body>
        <div id='container'>
            <div id='map'></div>
            <div id='content-window'></div>
        </div>
    </body>
</html>