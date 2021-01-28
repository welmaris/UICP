<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
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
$jsonfile = file_get_contents("../data.json");

//json to array
$array = json_decode($jsonfile, true);

echo '<table border="1">';
echo '<tr><th>STN</th><th>PRCP</th></th></tr>';

        function sortByPRCP($a, $b) {
            return $b['PRCP'] <=> $a['PRCP'];
        }
        
        usort($array, 'sortByPRCP');
        //print_r($array);

        $newArray = array_slice($array, 0, 5, true);

      foreach($newArray as $value) {?>
        <tr>
          <td><?PHP echo $value["STN"]; ?></td>
          <td><?PHP echo $value["PRCP"]; ?></td>
          </tr>
      <?php } echo '</table>'?> 
    </body>