<?php

define('DB_SERVER','localhost');
define('DB_USER','ascenttechsoluti_root');
define('DB_PASS' ,'r3qx?Y36yONU');
define('DB_NAME', 'ascenttechsoluti_cms');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>