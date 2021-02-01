<?php
include 'functions.php';
function getXMLdownload(){
if (isset($_GET['stationnum'])){
$dom = new DOMDocument();
$meting = getData($_GET['stationnum']);
$dom->encoding = 'utf-8';

$dom->xmlVersion = '1.0';

$dom->formatOutput = true;

$xml_file_name = 'station_data.xml';

foreach($meting as $waarde){

$root = $dom->createElement('weatherdata');

$station_node = $dom->createElement('measurement');

foreach($waarde as $key => $value){
    $child_node_date = $dom->createElement($key, $value);

    $station_node->appendChild($child_node_date);
}

$root->appendChild($station_node);

$dom->appendChild($root);
}

$dom->save($xml_file_name);

  echo "Data from station " .$_GET['stationnum']." can be downloaded.";
}
}
getXMLdownload();
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<form name = "submitknop" method = "get" action="">
  <label for="stationnum">Station number:</label><br>
  <input type="text" id="stationnum" name="stationnum"><br>
  <input type="submit" name="submit" value="Submit"/> <button class="btn"><i class="fa fa-download"></i> Download</button>
</form>

<a href='station_data.xml' download>

