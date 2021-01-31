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

?>