<?php
$servername = "128.199.28.101";
$username = "kec_sathana";
$password = "dh8BKY_QyF";
$dbname="mapims";
$port="3306";
$conn = mysqli_connect($servername, $username, $password,$dbname);


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


	
 
?>