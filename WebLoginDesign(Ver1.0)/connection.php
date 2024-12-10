<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "login_demo";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
{
    die;
}

?>