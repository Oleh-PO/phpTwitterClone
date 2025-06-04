<?php 
if (isset($_POST)) {
	require $_SERVER['DOCUMENT_ROOT'] . "/php/class/preload.php";
	$load = new preload;
	$interaction = new interaction(json_decode(file_get_contents('php://input')));
	$interaction->edit();
}
