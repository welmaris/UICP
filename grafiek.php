<!DOCTYPE html>
<html>
<head>
<style>

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 2px solid black;
  text-align: left;
  padding: 5px;
}

tr th {
  background-color: #2e3192;
  color: white;
}

tr:nth-child(odd) {
  background-color: #ec7616;
}

</style>
</head>
<body>

<?php
//Open json
$jsonfile = file_get_contents("../data.json");
$array = json_decode($jsonfile, true);

//echo '<pre>'; print_r($array); echo '</pre>'; //print $array

//looping trough array and making a new one with relevant data
foreach($array as $value){
    $result[$value["STN"]][]=$value;
}
//echo '<pre>'; print_r($result); echo '</pre>'; //print $result

//Making a table from the array
function JsonToTable($data){
  echo '<table border="1">';
  $isHeaderGenerated = 0;

  foreach($data as $STN ){
    foreach($STN as $datapunten){
      //header
      if($isHeaderGenerated == 0){
        echo '<tr>';
        foreach(array_keys($datapunten) as $key){ 
          echo "<th>".$key."</th>";
        }
        echo '</tr>';
        $isHeaderGenerated = 1;
      }

      //rows
      echo '<tr>'; 
      foreach($datapunten as $key => $value ){
        echo '<td>'.$value.'</td>';
      }
      echo '</tr>';
    }
  }
  echo '</table>';
}

JsonToTable($result);
?>