<?php //mySQL connection
function sqlInit() {
	$servername = "mySQL-8.2";
	$username   = "root";
	$password   = "";
	$dbname     = "phpmytwitter";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}
	return $conn;
}
