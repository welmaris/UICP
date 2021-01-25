<?php

//Open json
$jsonfile = file_get_contents("../data.json");

//json to array
$array = json_decode($jsonfile, true);
var_dump($array["DATE"]);

?>