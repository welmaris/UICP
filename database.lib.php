<?php
require "config.lib.php";

function databaseConnect() {
    global $config;
    //connect to database
    $db_conn = mysqli_connect($config['mysql']['hostname'],                 
                            $config['mysql']['username'],
                            $config['mysql']['password'],
                            $config['mysql']['database']);
                
    // check connection
    if (mysqli_connect_errno()) {
        $errormessage = "Connect failed". mysqli_connect_error();
        die($errormessage);
        exit();
    }        
      
    return $db_conn;
}

function databaseDisconnect($db_conn) {
    mysqli_close($db_conn);
}
?>