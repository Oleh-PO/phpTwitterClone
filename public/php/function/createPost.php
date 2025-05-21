<?php

trait createPost {
	public function createPost () {
		global $conn;
		if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["story"])) {
			$story = $_POST["story"];

			if (strlen($story) > 0) {//creating a post
				$sql = "
					INSERT INTO Posts (user_id, content, date)
					VALUES ('$this->userId', '$story', CURRENT_TIMESTAMP());
				";

				$conn->query($sql);
				header('Location: /');
				exit;
			}
		}
		require $_SERVER['DOCUMENT_ROOT'] . "/html/createPost.html";
	}
}
