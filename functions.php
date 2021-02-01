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

    function arrayDailyTopFive($day){

        $stations = [
            [415300,'PESHAWAR','PAKISTAN',34.017,71.583,360],
            [415710,'ISLAMABAD AIRPORT','PAKISTAN',33.617,73.1,508],
            [416410,'LAHORE AIRPORT','PAKISTAN',31.517,74.4,217],
            [417490,'NAWABSHAH','PAKISTAN',26.25,68.367,38],
            [417560,'JIWANI','PAKISTAN',25.067,61.8,57],
            [417800,'KARACHI AIRPORT','PAKISTAN',24.9,67.133,22]
        ];

        // print_r ($day);
        
        $data=[];
        // Loop through Days
        $listing = [];

            foreach($stations as $station){
                $nr = $station[0];
                $dataDay = getDailyData($nr, $day);

                if(!empty($dataDay)){
                    
                    $average = getAverage($dataDay, 'prcp');

                    $data[$nr] = $average;
                }
            }
            arsort($data, SORT_DESC);


        $p=1;
        $string = "<table>";
        echo "<tr><th>Position</th><th>Stationnumber</th><th>Average rainfall</th<</tr>";
        foreach ($data as $key => $value) {
            if($p<6){
                $string .= "<tr>";
                $string .= "<td>".$p++."</td>";
                $string .= "<td>".$key."</td>";
                $string .= "<td>".$value."</td>";
                $string .= "</tr>";
            }
        } 
        $string .= "</table>";
        return $string;
    }

    function getWeek(){

        $days = [];
        for ($i=0; $i < 7; $i++){
            $strpast = '-'.$i.' days';
            $current = date('Y-m-d', strtotime($strpast));
            $days[$i] = $current;
        }
        return $days;
    }

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
?>  
