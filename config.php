<?php

define('DB_SERVER', 'MYSQL5040.site4now.net');
define('DB_USERNAME', 'a66ed0_puebla');
define('DB_PASSWORD', 'astral00');
define('DB_NAME', 'db_a66ed0_puebla');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>
