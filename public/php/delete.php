<?php 
if (isset($_POST)) {
	require $_SERVER['DOCUMENT_ROOT'] . "/php/function/isOwner.php";
	require $_SERVER['DOCUMENT_ROOT'] . "/php/init.php";
	$user->init();

	$body	 = json_decode(file_get_contents('php://input'));
	$id 	 = $body -> id;

	if (isOwner()) {
		$sql = "
			DELETE FROM Posts
			WHERE id = $id;
		";
		$conn->query($sql);
	}
}
