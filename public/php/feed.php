<?php

require $_SERVER['DOCUMENT_ROOT'] . "/php/init.php";
$user->init();

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

if ($user->userId) {//filters post, so user cant see his own posts
	$userSort = "WHERE Users.id !=".$user->userId;
}

if ($user->getUserId) {//-> only show post from user on users page
	$userSort = "WHERE Users.id =".$user->getUserId;
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

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		require $_SERVER['DOCUMENT_ROOT']."/html/postTemplate.php";
	}
}
