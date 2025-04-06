<?php
	session_start();
	$conn = require $_SERVER['DOCUMENT_ROOT'] . "\php\sql.php";
	$q 		= intval($_GET['q']);

	$sql = "
		SELECT user_id, content FROM Posts
		WHERE id = $q;
	";

	$result = mysqli_fetch_assoc(mysqli_query($conn, $sql))["content"];
	echo "<span>$result</span><br>";