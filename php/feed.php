<?php
	session_start();
	$conn 	= require $_SERVER['DOCUMENT_ROOT'] . "\php\sql.php";
	$many 	= 8;
	$offset = intval($_GET['offset']);
	$order	= filter_var($_GET['order'], FILTER_VALIDATE_BOOLEAN);
	$upd 		= $offset * $many;
	$userSort 	= "";
	$userSettings = "";

	if ($order) {
		$sort = "ASC";
	} else {
		$sort = "DESC";
	}

	if (isset($_SESSION['id'])) {
		$userSort = "WHERE Users.id !=".$_SESSION['id'];
	}

	if (isset($_GET['user'])) {
		$userSort = "WHERE Users.id =".$_GET['user'];
	}

	$sql = "
		SELECT login, content, date, Users.id as user_id, Posts.id
		FROM Posts 
		INNER JOIN Users
		ON Posts.user_id = Users.id
		$userSort
		ORDER BY date $sort
		LIMIT $upd, $many;
	";

	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while($row = $result->fetch_assoc()) {
			require $_SERVER['DOCUMENT_ROOT']."/html/postTemplate.php";
		}
	}
  mysqli_close($conn);