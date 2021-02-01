<?php
include 'functions.php';
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

if(file_exists($xml_file_name)) {
    header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="'.basename($xml_file_name).'"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($xml_file_name));
  flush(); // Flush system output buffer
  readfile($xml_file_name);
  die();
}
}
?>