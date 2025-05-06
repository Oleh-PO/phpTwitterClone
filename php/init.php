<?php
function init() {
  global $conn, $userId, $userName, $getUserId, $getUserName, $postId;
  require $_SERVER['DOCUMENT_ROOT'] . "/php/sql.php";//connects to mysql via sql.php file

  session_start();
  $conn = sqlInit();

  $userId       = false;
  $userName     = false;
  $getUserId    = false;
  $getUserName  = false;
  $postId       = false;

  if (isset($_SESSION['id'])) {//get data from session
    $userId = $_SESSION['id'];
    $userName = $_SESSION['username'];
  }

  if (isset($_GET['user'])) {
    $getUserId = $_GET['user'];
    $sql = "
      SELECT login FROM Users
      WHERE id = $getUserId
    ";

    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    if (!$result) {
      die("user ($getUserId) not found :(");
    }

    $getUserName = $result["login"];
  }

  if (isset($_GET['post'])) {
    $postId = $_GET['post'];
    $sql = "
      SELECT id FROM Posts
      WHERE id = '$postId'
    ";
    if (!mysqli_fetch_assoc(mysqli_query($conn, $sql))) {
      die("post ($postId) not found :(");
    }
  }
}
function close() {
  global $conn;
  mysqli_close($conn);
}
