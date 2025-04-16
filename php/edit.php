<?php 
	if (isset($_POST)) {
		require $_SERVER['DOCUMENT_ROOT'] . "/php/isOwner.php";

		$textData = $body -> content;

		if ($id[0] === "p") {
			$id = ltrim($id, "p");

			if (!isOwner()) {
				die("wrong post");
			}

			$sql = "
				UPDATE Posts SET content = '$textData'
				WHERE id = $id;
			";
		} else if ($id === "bio") {
			$sql = "
				SELECT id FROM Users
				WHERE	id = $login;
			";

			if (!mysqli_query($conn, $sql)) {
				die("wrong post");
			}
			$sql = "
				UPDATE Users SET bio = '$textData'
				WHERE id = $login;
			";
		}

		mysqli_query($conn, $sql);
		mysqli_close($conn);
	}
