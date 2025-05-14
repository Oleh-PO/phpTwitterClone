<?php
function createPost () {
	global $conn;
	if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["story"])) {
		$story = $_POST["story"];

		if (strlen($story) > 0) {//creating a post
			$sql = "
				INSERT INTO Posts (user_id, content, date)
				VALUES ('$user->userId', '$story', CURRENT_TIMESTAMP());
			";

			$conn->query($sql);
			header('Location: /');
			exit;
		}
	}
	echo '
		<div class="createPost">
			<form method="POST">
				<textarea required maxlength="255" minlength="1" id="story" name="story" rows="5" cols="33"></textarea>
				<input type="submit" name="submit">
			</form>
		</div>
	';
}
