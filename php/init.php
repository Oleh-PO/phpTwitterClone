<?php
  function init() {
    global $conn, $userId, $userName, $getUserId, $getUserName, $postId;
    require $_SERVER['DOCUMENT_ROOT'] . "\php\sql.php";//connects to mysql via sql.php file

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
      $getUserName = mysqli_fetch_assoc(mysqli_query($conn, $sql))["login"];
    }

    if (isset($_GET['post'])) {
      $postId = $_GET['post'];
    }
  }
