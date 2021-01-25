<?php
//Open json
$strJsonFileContents = file_get_contents("../data.json");

//json to array
$array = json_decode($strJsonFileContents);
var_dump($array);

?>