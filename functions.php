<!DOCTYPE html>
<html>
<head>
<style>

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    margin-left: auto;
    margin-right: auto;
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
    // function to get data based on stationnr (int)
    function getData($stationnr){

        // Directory
        $dir = "../DATA/" . $stationnr;

        $data = array();

        // Looping through Files
        foreach (new DirectoryIterator($dir) as $f){
            if ($f->isDot()){
                continue;
            }

            // get file with filepath
            $path = $f->getPathname();

            // Check if file exists
            if ($f->isFile()) {
                $jsonfile = file_get_contents($path);
                $array = json_decode($jsonfile, true);
                
                // Check if it's actually the correct station. (remove if this part gets removed from file)
                if ($array['stn'] == $stationnr){
                    array_push($data, $array);
                }
            }
        }
        return ($data);
    }   


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

function getAverage($stnnr, $code){
    // Get all the data
    $data = getData($stnnr);

    $array = [];

    // for average humidity
    if($code == 'humid'){
        for($i = 0; $i < sizeof($data); $i++){
            $current = $data[$i];
            $dewp = $current['dewp'];
            $temp = $current['temp'];

            $h = getHumidity($dewp, $temp);

            // add humidity 
            array_push($array, $h);
        };
    } else {
        for($i = 0; $i < sizeof($data); $i++){
            $current = $data[$i];
            array_push($array, $current[$code]);
        }
    }

    // for other averages
    if (sizeof($array) > 0){
        $average = array_sum($array) / sizeof($array);
    } else {
        $average = 0;
    }

    return $average;
}


?>
</body>
</html>