<?php

//Open json
$jsonfile = file_get_contents("../data.json");

//json to array
$array = json_decode($jsonfile, true);
echo '<pre>'; print_r($array); echo '</pre>'; //print $array

//looping trough array and making a new one with relevant data
foreach($array as $value)
{
    $result[]=array($value["DATE"],$value["TIME"], $value["TEMP"], $value["PRCP"]);
}
//echo '<pre>'; print_r($result); echo '</pre>'; //print $result

?>                                                 