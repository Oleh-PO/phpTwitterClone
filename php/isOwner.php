<?php
function isOwner() {
	global $id, $conn, $userId;
	$sql = "
		SELECT user_id FROM Posts
		WHERE	id = $id;
	";
	if (mysqli_fetch_assoc(mysqli_query($conn, $sql))["user_id"] === $userId) {
		return true;
	}
	return false;
}
