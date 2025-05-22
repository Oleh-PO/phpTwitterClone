<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/php/class/init.php";
	$user = new init;//initiating a session and mySQL
	ob_start();
	require $_SERVER['DOCUMENT_ROOT'] . "/html/index.php";
	ob_end_flush();
?>
