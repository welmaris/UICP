<?php
    // if(!isset($_SESSION["user"])){
    //     header("location: /", TRUE, 301);
    // }
    // include 'stationData.php'; 
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
/* H1 */
    h1 {
        color: #1A2364;
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 20px;
        line-height: 0.2;
        font-weight: bold;
        }

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
        margin-bottom: 30px;
    }

    .topnav a {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 16px 16px;
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

/* Tables */
    /* TopFive Table */
    .topfive{
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        display: block;
        height: 500px;
        width:100%;
        margin-top: 30px;
    }
    /*Table in the map*/
    .tableMap{
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        display: block;
        height: 500px;
        width:100%;
        overflow-y:scroll;
    }

    /* Common Table styles */
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

/* Map*/
    .map{
        margin: auto;
        width: 50%;
        border: 1.5px solid black;
        padding: 500px 300px 300px 30px;

    }

    .mapboxgl-popup{
        transform:none !important;
        top: 5%;
        left: 10px;
        height: 500px;
    }

    .maptext p {
            color: #1A2364;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;

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
        width: 420;
        margin-left: 265px;
        margin-top: 30px;
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

    input[type=submit] {
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

    input[type=submit]:hover {
        background-color: #1A2364;
    }

    .download p{
        color: white;
        text-align: left;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 16px;
    }

/* Navigation Tabs from top5 Table */
    /* Style the tab */
    .tab {
        float: left;
        border: 1px solid #ccc;
        background-color: #1A2364;
        width: 8%;
        box-sizing: border-box;
        margin-left: 255px;
        margin-top: 30px;
    }

    /* Style the buttons inside the tab */
    .tab button {
        display: block;
        background-color: inherit;
        color: black;
        padding: 12px 20px;
        width: 100%;
        border: none;
        outline: none;
        text-align: left;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 15px;
        color: white;
        cursor: pointer;
        transition: 0.3s;
        font-size: 17px;
        box-sizing: border-box;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #1FB062;
        box-sizing: border-box;
    }

    /* Create an active/current "tab button" class */
    .tab button.active {
        background-color: #1FB062;
        box-sizing: border-box;
    }

    /* Style the tab content */
    .tabcontent {
        float: left;
        padding: 0px 12px;
        width: 30%;
        box-sizing: border-box;
    }
</style>
</head>
<!-- Navigation bar on top -->
<body>
    <div class="topnav">
        <img src="UIC2.png"> 
        <a class="rightSideMenu" href = "logout.php">Sign Out</a>
    </div>

<!-- Map -->
    <div class=maptext>
        <h1>Welcome!</h1>
        <p>The map below shows Pakistan and its neighborting countries. On the map are markers which represent weather</br>stations with a humidity of >80%. The markers of Pakistan are orange, the neighboring countries are blue. When you  press</br>a markera table will pop-up  with all the  weather data of that weather station. The weather data can be downloaded below.</p>
    </div>
    <div class='map' id='map'></div>
            <script>
                mapboxgl.accessToken = 'pk.eyJ1Ijoid2VsbWFyaXMiLCJhIjoiY2traWJ0dnFwMDUzbDJ0czdmYzJpeWpmdyJ9.Tr_OqxjnZ_9yjgri9TvZVA';

                //creation of the map
                var map = new mapboxgl.Map({
                    container: 'map',
                    center: ['70', '31'], 
                    zoom: '4',
                    style: 'mapbox://styles/mapbox/streets-v11'
                }).addControl(new mapboxgl.NavigationControl());

                // creation markers per country
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
        
<!-- HTML Top 5 -->
    <div class='top5'>
        <div class='tab'>
            <?php
                $days = getWeek();
                $bool = true;

                foreach($days as $day){
                    if($bool){
                        $bool = false;
                ?>
                    <button class='tablinks' onclick="openContent(event, '<?php echo $day; ?>')" id='defaultOpen'><?php echo $day; ?></button>
                    <?php }else { ?>
                    
                        <button class='tablinks' onclick="openContent(event, '<?php echo $day; ?>')"><?php echo $day; ?></button>
                    <?php }
                }
            ?>
        </div>
        <?php
            foreach($days as $day){
                $content = arrayDailyTopFive($day);
                echo "<div id='$day' class='tabcontent'> $content </div>";
            }
        ?>
        </div>
    </div>

<!-- Script top 5 table -->
    <script>
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

<!-- HTML Download XML function -->
    <div class="download">
        <form name = "submitknop" method = "get" action="xmldownload.php">
            <h1>Download data to XML</h1>
            <p>Fill in a station number to download </br> its data in XML format. The data  </br> downloaded is from the last week.</p>
            <input type="text" id="stationnum" name="stationnum" placeholder="Station number" pattern="\d{5,6}" title="Please provide one excisting station number" required><br>
            <input type="submit" name="submit" value="Download"/> 
        </form>
    </div>

<!-- HTML Footer -->
    <div class="footer"> 
        <p><small>&copy; <?php echo date("Y");?>, Storm Metrics Company. All Rights Reserved.</small></p>
    </div>

</body>
</html>