<?php
date_default_timezone_set('Asia/Kolkata'); 
define('DB_SERVER', 'localhost');
define('DB_USER', 'ascenttechsoluti_root');
define('DB_PASS', 'r3qx?Y36yONU');
define('DB_NAME', 'ascenttechsoluti_cms');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

function getcurrenttimme($time)
{
    
    date_default_timezone_set('Asia/Kolkata');
    return date('F d, Y h:i a', $time);
}
