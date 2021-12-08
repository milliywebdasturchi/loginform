<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "loginform";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$conn){
	die("MySQL database connection error!");
	exit();
}