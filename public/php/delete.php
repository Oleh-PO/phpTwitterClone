<?php 
	if (isset($_POST)) {
		require $_SERVER['DOCUMENT_ROOT'] . "/php/isOwner.php";

		if (isOwner()) {
			$sql = "
				DELETE FROM Posts
				WHERE id = $id;
			";
			mysqli_query($conn, $sql);
		}
		mysqli_close($conn);
	}
