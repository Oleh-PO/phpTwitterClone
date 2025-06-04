<?php

trait isOwner {
	function isOwner() {
		$sql = "
			SELECT user_id FROM Posts
			WHERE	id = $this->id;
		";

		if ($result = $this->conn->query($sql)->fetch_assoc()["user_id"] === $this->userId) {
			return true;
		}
		return false;
	}
}
