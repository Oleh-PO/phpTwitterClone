<?php

$files = glob($_SERVER['DOCUMENT_ROOT'] . "/php/function/*.php");

foreach ($files as $file) {
  require_once($file);
}


class Init
{

  use createPost, https, getBio, isOwner, pullPost;

  public $userId       = false;
  public $userName     = false;
  public $getUserId    = false;
  public $getUserName  = false;
  public $postId       = false;

  public function __construct() {
    global $conn;

    require_once $_SERVER['DOCUMENT_ROOT'] . "/php/sql.php";//connects to mysql via sql.php file

    session_start();
    $conn = $mySql->sqlInit();

    if (isset($_SESSION['id'])) {//get data from session
      $this->userId = $_SESSION['id'];
      $this->userName = $_SESSION['username'];
    }

    if (isset($_GET['user'])) {
      $this->getUserId = $_GET['user'];
      $sql = "
        SELECT login FROM Users
        WHERE id = $this->getUserId
      ";

      $result = $conn->query($sql)->fetch_assoc();

      if (!$result) {
        die("user ($this->getUserId) not found :(");
      }

      $this->getUserName = $result["login"];
    }

    if (isset($_GET['post'])) {
      $this->postId = $_GET['post'];
      $sql = "
        SELECT id FROM Posts
        WHERE id = '$this->postId'
      ";
      if (!$conn->query($sql)->fetch_assoc()) {
        die("post ($this->postId) not found :(");
      }
    }
  }

  public function jsInit() {
    if ($this->getUserId) {
      echo "userId = 'user=$this->getUserId;'";
    } else {
      echo "userId = false;";
    }
    if (isset($_COOKIE['toggleTheme'])) {
      echo "toggleTheme(".$_COOKIE['toggleTheme'].");";
    }
  }
}
