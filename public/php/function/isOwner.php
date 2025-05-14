<?php
function isOwner() {
	global $id, $conn;
	$sql = "
		SELECT user_id FROM Posts
		WHERE	id = $id;
	";
	if ($result = $conn->query($sql)->fetch_assoc()["user_id"] === $user->userId) {
		return true;
	}
	return false;
}
