<?php
include 'stationData.php';
?>

<!DOCTYPE html>
<html>
<head>

        <script src='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' rel='stylesheet' />
    </head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background-color: #eeeff5;
}

.topnav {
  overflow: hidden;
  background-color: #1A2364;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a.rightSideMenu{
   float:right;
}

.topnav a:hover {
  background-color: #1FB062;
  color: white;
}

.topnav a.active {
  background-color: #f07120;
  color: white;
}

.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   height: 30px;
   background-color: #f07120 ;
   color: white;
   text-align: center;
}

.footer p{
   margin: 7.5px;
}

.tableTopFive{
  position: relative;
  top: 30px;
  border-radius: 5px;
  width:400px;
  height:300px;
  background-color: #ffffff;

}

.map{
  width: 800px; height: 600px;

}

</style>
</head>
<body>

<div class="topnav">
   <img src="UIC2.png"> <!--button van maken die naar home page gaat-->
   <a class="rightSideMenu" href = "logout.php">Sign Out</a>
</div>

<div class="tableTopFive">
    <?php arrayToTopFive() ?>
</div>

<div class="footer"> 
<p><small>&copy; Copyright 2021, Storm Metrics Company. All Rights Reserved.</small></p>
</div>

<div class='map' id='map'></div>
        <script>
            mapboxgl.accessToken = 'pk.eyJ1Ijoid2VsbWFyaXMiLCJhIjoiY2traWJ0dnFwMDUzbDJ0czdmYzJpeWpmdyJ9.Tr_OqxjnZ_9yjgri9TvZVA';

            //creation of map
            var map = new mapboxgl.Map({
                container: 'map',
                center: ['70', '31'], //naar links, omhoog
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