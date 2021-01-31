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
include 'getData.php';

//Making a table from an aFrray
function arrayToTable($data){
    echo '<table border="1">';
    $isHeaderGenerated = 0;
    foreach($data as $datapunt ){
        if($isHeaderGenerated == 0){
        echo '<tr>';
        foreach(array_keys($datapunt) as $key){ 
          echo "<th>".$key."</th>";
        }
        echo '</tr>';
        $isHeaderGenerated = 1;
      }

      //rows
      echo '<tr>'; 
      foreach($datapunt as $key => $value ){
        echo '<td>'.$value.'</td>';
      }
      echo '</tr>';
    }
  
  echo '</table>';
}

arrayToTable(getData(14830));

?>