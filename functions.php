<!DOCTYPE html>
<html>
<head>
<style>

table {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;

    width:100%;
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

</style>
</head>
<body>
<?php
    // function to get data based on stationnr (int)
    function getData($stationnr){

        // Directory
        $dir = "../weatherdata-mounting-point/" . $stationnr;

        $data = [];

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

    function getDailyData($stationnr, $day){

        // Directory
        $dir = "../weatherdata-mounting-point/" . $stationnr;

        $data = [];

        // Looping through Files
        foreach (new DirectoryIterator($dir) as $f){
            if ($f->isDot()){
                continue;
            }
            

            // get file with filepath
            $path = $f->getPathname();
            
            // Check if file exists
            if ($f->isFile() and strpos($f, $day) !== false) {
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

    // Method to get humidity with dewpoint (C) and Temperature (C)
    function getHumidity($dewp, $temp){
        $result = (5*($dewp - $temp) + 100);
        return $result;
    }

    //Making a table from an array
    function arrayToTable($data){
        $string = '<table>';
        $string .= '<tr><th>Station</th><th>Date</th><th>Time</th><th>Temperature (C&#176;)</th><th>Dewpoint (C&#176;)</th><th>Airpressure (station level)</th><th>Airpressure (sea level)</th><th>Visibility (km)</th><th>Windspeed (km/h)<th>Precipitation (cm)</th><th>Snow Depth (cm)</th><th>Events</th><th>Cloudcover (%)</th><th>Wind direction (degrees)</th></th></tr>';

        foreach($data as $datapunt ){
      //rows
            $string .= '<tr>'; 
                foreach($datapunt as $key => $value ){
                    $string .= '<td>'.$value.'</td>';
                }
            $string .= '</tr>';
        }
        $string .= '</table>';
        return $string;
    }

    function getAverage($data, $code){

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
            $average = round(array_sum($array) / sizeof($array),2);
        } else {
            $average = 0;
        }

        return $average;
    }

    function arrayToTopFive(){
        $pakistan_Stations = [
            [415300,'PESHAWAR','PAKISTAN',34.017,71.583,360],
            [415710,'ISLAMABAD AIRPORT','PAKISTAN',33.617,73.1,508],
            [416410,'LAHORE AIRPORT','PAKISTAN',31.517,74.4,217],
            [417490,'NAWABSHAH','PAKISTAN',26.25,68.367,38],
            [417560,'JIWANI','PAKISTAN',25.067,61.8,57],
            [417800,'KARACHI AIRPORT','PAKISTAN',24.9,67.133,22]
        ];

        //array met de laatste 7 dagen
        $lastSevenDays = [];
        for ($i=0; $i<7; $i++){
            $day = date("Y-m-d", strtotime($i." days ago"));
            array_push($lastSevenDays, $day);      
        }
        //echo '<pre>'; print_r($lastSevenDays); echo '</pre>';
        

        //$averagePRCP = [];
        //for($i=0; $i < sizeof($pakistan_Stations); $i++){
        //    $STN = $pakistan_Stations[$i];
        //    $stationsnr= $STN[0];
        //    $averagePRCP[$stationsnr]=(getDailyData($stationsnr, "prcp"));
        //    arsort($averagePRCP);
        //}

        //loop door pakistan stations
        //gemiddelde opvragen per station per dag (voor één week)
        $averagePRCP = [];
        for($i=0; $i < sizeof($pakistan_Stations); $i++){
            $STN = $pakistan_Stations[$i];
            $stationsnr= $STN[0];
            for($i=0; $i < sizeof($lastSevenDays); $i++){
                $averagePRCP[$stationsnr]=(getAverage($stationsnr, "prcp"));
                arsort($averagePRCP);
            }
        }

        //echo '<pre>'; print_r($averagePRCP); echo '</pre>';

        //sort array
        $p=1;
        echo "<table>";
        echo "<tr><th>Positiion</th><th>Stationnumber</th><th>Average rainfall</th<</tr>";
        foreach ($averagePRCP as $key => $value) {
            if($p<6){
            echo "<tr>";
            echo "<td>".$p++."</td>";
            echo "<td>".$key."</td>";
            echo "<td>".$value."</td>";
            echo "</tr>";
            }
        } 
        echo "</table>";
    }

    arrayToTopFive();

?>  
</body>
</html>