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

/* body */
body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    background-color: #f7f8fc;
}

/* Top navigation bar */
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

/* Footer*/
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

/* Table */
table {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    display: block;
    height: 500px;
    width:100%;
    overflow-y:scroll;
}

td, th {
    border: 1.5px solid black;
    text-align: left;
    padding: 5px;
}

tr th {
    background-color: #1A2364;
    color: white;
}

tr:nth-child(even) {
    background-color: #f7f8fc;
}

tr:nth-child(odd) {
    background-color: #f07120;
}

tr:hover {
    background-color: #1FB062;
}


/* Top navigation bar */
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

/* Map*/
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


/* Download XML function */
.download{
    display: inline-block;
    border: 3px solid #f1f1f1;
    width: 420;
    margin: auto;
    margin-top: 10px;
    border-radius: 5px;
    background-color: #1FB062;
    padding: 10px;
}

input[type=text] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
    border-radius: 4px;
}

input[type=submit], {
        background-color: #f07120;
        color: white;
        font-weight : bold;
        font-size : 16px;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        border-radius: 4px;
    }  

/* Table */
    * {box-sizing: border-box}
    body {font-family: "Lato", sans-serif;}

    /* Style the tab */
    .tab {
    float: left;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    width: 30%;
    height: 300px;
    }

    /* Style the buttons inside the tab */
    .tab button {
    display: block;
    background-color: inherit;
    color: black;
    padding: 22px 16px;
    width: 100%;
    border: none;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
    font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
    background-color: #ddd;
    }

    /* Create an active/current "tab button" class */
    .tab button.active {
    background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
    float: left;
    padding: 0px 12px;
    border: 1px solid #ccc;
    width: 70%;
    border-left: none;
    height: 300px;
    }
</style>
</head>
<body>

<div class="topnav">
   <img src="UIC2.png"> 
   <a class="rightSideMenu" href = "logout.php">Sign Out</a>
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

            //Top 5 Table
            function openContent(evt, date) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(date).style.display = "block";
                evt.currentTarget.className += " active";
            }

            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();

        </script>

<!-- <div class='Top5'>
    <div class='tab'>
        <?php
            //$days = getWeek();
            //$bool = true;

            //foreach($days as $day){
                //if($bool){
                 //   $bool = false;
            ?>
                <button class='tablinks' onclick="openContent(event, '<?php //echo $day; ?>')", id='defaultOpen'><?php //echo $day; ?></button>
                <?php //}else { ?>
                
                    <button class='tablinks' onclick="openContent(event, '<?php //echo $day; ?>')"><?php //echo $day; ?></button>
                <?php //}

            //}
        ?>
    </div>
    <?php
        //foreach($days as $day){
            //$content = arrayDailyTopFive($day);
            //echo "<div id='$day' class='tabcontent'> $content </div>";
        //}
    ?>
    </div>
</div> -->

<div class="download">
    <form name = "submitknop" method = "get" action="xmldownload.php">
        <label for="stationnum">Station number:</label><br>
        <input type="text" id="stationnum" name="stationnum"><br>
        <input type="submit" name="submit" value="Download"/> 
    </form>
</div>

    
<div class="footer"> 
<p><small>&copy; <?php echo date("Y");?>, Storm Metrics Company. All Rights Reserved.</small></p>
</div>

</body>
</html>