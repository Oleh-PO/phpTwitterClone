<?php 
	session_start();
	$login = $_SESSION['id'];
	$conn  = require $_SERVER['DOCUMENT_ROOT'] . "\php\sql.php";
	$body	 = json_decode(file_get_contents('php://input'));
	$id 	 = $body -> id;
	var_dump($body);
	
	function isOwner() {
		global $id, $conn, $login;
		$sql = "
			SELECT user_id FROM Posts
			WHERE	id = $id;
		";
		if (mysqli_fetch_assoc(mysqli_query($conn, $sql))["user_id"] === $login) {
			return true;
		}
		return false;
	}
