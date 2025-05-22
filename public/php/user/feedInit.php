<?php
if (isset($_GET)) {
  require $_SERVER['DOCUMENT_ROOT'] . "/php/class/feed.php";
  $feed = new feed(8, intval($_GET['offset']), filter_var($_GET['order'], FILTER_VALIDATE_BOOLEAN));
}
