<?php

//Open json
$jsonfile = file_get_contents("../data.json");

//json to array
$array = json_decode($jsonfile, true);
print_r($array);

?>