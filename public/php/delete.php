<?php 
if (isset($_POST)) {
	require $_SERVER['DOCUMENT_ROOT'] . "/php/isOwner.php";
	require $_SERVER['DOCUMENT_ROOT'] . "/php/init.php";
	init();

	$body	 = json_decode(file_get_contents('php://input'));
	$id 	 = $body -> id;

	if (isOwner()) {
		$sql = "
			DELETE FROM Posts
			WHERE id = $id;
		";
		mysqli_query($conn, $sql);
	}
	close();
}
