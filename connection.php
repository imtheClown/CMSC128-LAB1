<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "cmsc128trial";

if(!$conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname)){
	die("cannot reach the database\n"); 
}
$conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

?>