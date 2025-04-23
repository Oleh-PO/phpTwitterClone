<?php 
	require $_SERVER['DOCUMENT_ROOT'] . "\php\init.php";
	init();

	$body	 = json_decode(file_get_contents('php://input'));
	$id 	 = $body -> id;
	
	function isOwner() {
		global $id, $conn, $user_id, $userId;
		$sql = "
			SELECT user_id FROM Posts
			WHERE	id = $id;
		";
		if (mysqli_fetch_assoc(mysqli_query($conn, $sql))["user_id"] === $userId) {
			return true;
		}
		return false;
	}
