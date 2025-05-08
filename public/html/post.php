<?php
	if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["story"])) {
		$story = $_POST["story"];

		if (strlen($story) > 0) {//creating a post
			$sql = "
				INSERT INTO Posts (user_id, content, date)
				VALUES ('$id', '$story', CURRENT_TIMESTAMP());
			";

			mysqli_query($conn, $sql);
			header('Location: /');
			exit;
		}
	}
?>

<div class="createPost">
	<form method="POST">
		<textarea id="story" name="story" rows="5" cols="33"></textarea>
		<input type="submit" name="submit">
	</form>
</div>