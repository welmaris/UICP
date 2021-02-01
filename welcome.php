<?php
include 'stationData.php';
?>

<!DOCTYPE html>
<html>
<head>

  <link rel="icon" href="/favicon.ico">
	<title>Login</title>
        <script src='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' rel='stylesheet' />
    

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background-color: #f7f8fc;
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
  margin-left:30px;
  display: inline-block;

}

input[type=button] {
background-color: #1FB062;
  color: white;
  font-weight : bold;
  font-size : 16px;
  padding: 5px 8px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  border-radius: 4px;
}

.dropbtn {
  background-color: #1FB062;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  padding: 5px 8px;
  border-radius: 4px;
}

.dropdown {

  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
    background-color: #f1f1f1
    }

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}

.map{
  width: 1200px; 
  height: 700px;
  margin-left:30px;
  margin-top: 30px;
  display: inline-block;
  border: 1.5px solid black;
}

.mapboxgl-popup{
    transform:none !important;
    top: 5%;
    left: 10px;
    height: 500px;
}
.mapboxgl-popup-anchor-top .mapboxgl-popup-tip,
.mapboxgl-popup-anchor-bottom .mapboxgl-popup-tip,
.mapboxgl-popup-anchor-center .mapboxgl-popup-tip,
.mapboxgl-popup-anchor-left .mapboxgl-popup-tip,
.mapboxgl-popup-anchor-right .mapboxgl-popup-tip,
.mapboxgl-popup-anchor-bottom-right .mapboxgl-popup-tip,
.mapboxgl-popup-anchor-bottom-left .mapboxgl-popup-tip,
.mapboxgl-popup-anchor-top-right .mapboxgl-popup-tip, 
.mapboxgl-popup-anchor-top-left .mapboxgl-popup-tip{
    display:none !important;
}

.mapboxgl-popup-content{
    width: min-content;
    

}



</style>
</head>
<body>

<div class="topnav">
   <img src="UIC2.png"> 
   <a class="rightSideMenu" href = "logout.php">Sign Out</a>
</div>

<div class='map' id='map'></div>
<div class='info' id = 'info'></div>
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
            var pakistanTable = <?php echo $pakistanData; ?>;
            for (var i = 0; i < stations.length; i++){
                
                var station = stations[i];
                var nr = station[0];
                var content = "<h3>".concat(station[1], ", ", station[2], " ", nr, " ", pakistanTable[nr], "</h3>");
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
            var afghanistanTable = <?php echo $afghanistanData; ?>;
            for (var i = 0; i < stations.length; i++){
                var station = stations[i];
                var nr = station[0];
                var h = humidity[nr];
                if(h >= 80){
                    var content = "<h3>".concat(station[1], ", ", station[2], " ", nr, " ", afghanistanTable[nr], "</h3>");

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
            var iranTable = <?php echo $iranData; ?>;
            for (var i = 0; i < stations.length; i++){
                var station = stations[i];
                var nr = station[0];
                var h = humidity[nr];
                if(h >= 80){
                    var content = "<h3>".concat(station[1], ", ", station[2], " ", nr, " ", iranTable[nr], "</h3>");
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
            var indiaTable = <?php echo $indiaData; ?>;
            for (var i = 0; i < stations.length; i++){
                var station = stations[i];
                var nr = station[0];
                var h = humidity[nr];
                if(h >= 80){
                    var content = "<h3>".concat(station[1], ", ", station[2], " ", nr, " ", indiaTable[nr], "</h3>");
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
            var chinaTable = <?php echo $chinaData; ?>;
            for (var i = 0; i < stations.length; i++){
                var station = stations[i];
                var nr = station[0];
                var h = humidity[nr];
                if(h >= 80){
                    var content = "<h3>".concat(station[1], ", ", station[2], " ", nr, " ", chinaTable[nr], "</h3>");
                    china[i] = new mapboxgl.Marker({
                        color: "#1A2364"
                    }).setLngLat([station[4], station[3]])
                    .setPopup(new mapboxgl.Popup().setHTML(content))
                    .addTo(map);
                }
            }

        </script>
<div class="dropdown">
    <button class="dropbtn">Dropdown</button>
    <div class="dropdown-content">
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
    </div>
</div>

<div class="tableTopFive">
    <?php arrayToTopFive() ?>
    <input type="button" name="download" value="Download">
</div>

<div class="footer"> 
<p><small>&copy; <?php echo date("Y");?>, Storm Metrics Company. All Rights Reserved.</small></p>
</div>

</body>
</html>