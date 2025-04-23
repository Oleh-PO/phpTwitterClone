<?php
	require $_SERVER['DOCUMENT_ROOT'] . "\php\init.php";
	init();

	$many 	= 8;
	$offset = intval($_GET['offset']);
	$order	= filter_var($_GET['order'], FILTER_VALIDATE_BOOLEAN);
	$upd 		= $offset * $many;

	$userSort 		= "";
	$userSettings = "";

	if ($order) {
		$sort = "ASC";
	} else {
		$sort = "DESC";
	}

	if ($userId) {
		$userSort = "WHERE Users.id !=".$userId;
	}

	if ($getUserId) {
		$userSort = "WHERE Users.id =".$getUserId;
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
