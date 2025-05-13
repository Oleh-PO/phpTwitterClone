<?php //mySQL connection
function sqlInit() {
	$servername = "phptwitter-db-1";
	$username   = "root";
	$password   = "test";
	$dbname     = "phpmytwitter";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}
	return $conn;
}
