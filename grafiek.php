<?php

//Open json
$jsonfile = file_get_contents("../data.json");

//json to array
$array = json_decode($jsonfile);
var_dump($array[0]);

?>