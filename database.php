<?php 

$hostname = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "users";



$conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);
if(!$conn) {
die("Something went wrong");
}
?>