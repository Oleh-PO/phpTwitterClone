<?php //universal sql connection 
	$servername = "mySQL-8.2";
	$username   = "root";
	$password   = "";
	$dbname     = "test";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}
	return $conn;