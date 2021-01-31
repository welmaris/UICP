<!DOCTYPE html>
<?php include 'stationData.php'; ?>
<html>
    <head>
        <script src='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' rel='stylesheet' />
    </head>

    <body>
        <div id='map' style='width: 800px; height: 600px;'></div>
        <script>

            mapboxgl.accessToken = 'pk.eyJ1Ijoid2VsbWFyaXMiLCJhIjoiY2traWJ0dnFwMDUzbDJ0czdmYzJpeWpmdyJ9.Tr_OqxjnZ_9yjgri9TvZVA';

            //creation of map
            var map = new mapboxgl.Map({
                container: 'map',
                center: ['75', '31'],
                zoom: '4',
                style: 'mapbox://styles/mapbox/streets-v11'
            }).addControl(new mapboxgl.NavigationControl());

            // creation markers
            // Pakistan
            var pakistan = [];
            var stations = <?php echo $jsPakistan; ?>;
            for (var i = 0; i < stations.length; i++){
                
                var station = stations[i];
                var content = "<h3>".concat(station[1], ", ", station[2], "</h3>");
                
                pakistan[i] = new mapboxgl.Marker({
                    color: "#f07120"
                }).setLngLat([station[4], station[3]])
                .setPopup(new mapboxgl.Popup().setHTML(content))
                .addTo(map);
            }

            //Afghanistan
            var afghanistan = [];
            var stations = <?php echo $jsAfghanistan; ?>;
            var humidity = <?php echo $humAfghanistan; ?>;
            for (var i = 0; i < stations.length; i++){
                var station = stations[i];
                var nr = station[0];
                var h = humidity[nr];
                if(h >= 80){
                    var content = "<h3>".concat(station[1], ", ", station[2], "</h3>");

                    afghanistan[i] = new mapboxgl.Marker({
                        color: "#1A2364"
                    }).setLngLat([station[4], station[3]])
                    .setPopup(new mapboxgl.Popup().setHTML(content))
                    .addTo(map);
                }
            }

            // Iran
            var iran = [];
            var stations = <?php echo $jsIran; ?>;
            var humidity = <?php echo $humIran; ?>;
            for (var i = 0; i < stations.length; i++){
                var station = stations[i];
                var nr = station[0];
                var h = humidity[nr];
                if(h >= 80){
                    var content = "<h3>".concat(station[1], ", ", station[2], "</h3>");

                    iran[i] = new mapboxgl.Marker({
                        color: "#1A2364"
                    }).setLngLat([station[4], station[3]])
                    .setPopup(new mapboxgl.Popup().setHTML(content))
                    .addTo(map);
                }
            }

            // India
            var india = [];
            var stations = <?php echo $jsIndia; ?>;
            var humidity = <?php echo $humIndia; ?>;
            for (var i = 0; i < stations.length; i++){
                var station = stations[i];
                var nr = station[0];
                var h = humidity[nr];
                if(h >= 80){
                    var content = "<h3>".concat(station[1], ", ", station[2], "</h3>");

                    india[i] = new mapboxgl.Marker({
                        color: "#1A2364"
                    }).setLngLat([station[4], station[3]])
                    .setPopup(new mapboxgl.Popup().setHTML(content))
                    .addTo(map);
                }
            }

            // China
            var china = [];
            var stations = <?php echo $jsChina; ?>;
            var humidity = <?php echo $humChina; ?>;
            for (var i = 0; i < stations.length; i++){
                var station = stations[i];
                var nr = station[0];
                var h = humidity[nr];
                if(h >= 80){
                    var content = "<h3>".concat(station[1], ", ", station[2], "</h3>");

                    china[i] = new mapboxgl.Marker({
                        color: "#1A2364"
                    }).setLngLat([station[4], station[3]])
                    .setPopup(new mapboxgl.Popup().setHTML(content))
                    .addTo(map);
                }
            }

        </script>
    </body>
</html>