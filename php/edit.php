<?php 
if (isset($_POST)) {
	require $_SERVER['DOCUMENT_ROOT'] . "/php/isOwner.php";
	require $_SERVER['DOCUMENT_ROOT'] . "/php/init.php";
	init();

	$body	 = json_decode(file_get_contents('php://input'));
	$id 	 = $body -> id;

	$textData = $body -> content;//reads a payload

	if ($id[0] === "p") {//if p (post) - edit post with id
		$id = ltrim($id, "p");

		if (!isOwner()) {
			die("wrong post by isOwner");
		}

		$sql = "
			UPDATE Posts SET content = '$textData'
			WHERE id = $id;
		";

	} else if ($id === "bio") {//else if bio - edit bio of user
		$sql = "
			SELECT id FROM Users
			WHERE	id = $userId;
		";

		if (!mysqli_query($conn, $sql)) {
			die("wrong user");
		}

		$sql = "
			UPDATE Users SET bio = '$textData'
			WHERE id = $userId;
		";
	}

	mysqli_query($conn, $sql);
	close();
}
