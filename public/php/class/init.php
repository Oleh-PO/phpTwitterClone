<?php


class init {

  use createPost, https, getBio, isOwner, pullPost;

  public $userId;
  public $userName;
  public $getUserId;
  public $getUserName;
  public $postId;

  protected $conn;

  public function __construct() {

    session_start();
    $mySql = new sql("phptwitter-db-1", "root", "12345678", "phpmytwitter");
    $this->conn = $mySql->sqlInit();

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

      $result = $this->conn->query($sql)->fetch_assoc();

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
      if (!$this->conn->query($sql)->fetch_assoc()) {
        die("post ($this->postId) not found :(");
      }
    }
  }

  public function __destruct() {
    $this->conn->close();
  }

  public function index() {
    if ($_SERVER['SERVER_NAME'] !== "localhost") {
      $this->https();
    }
    ob_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/html/index.php";
    ob_end_flush();
  }

  public function jsInit() {
    if ($this->getUserId) {
      echo "userId = 'user=$this->getUserId';";
    } else {
      echo "userId = false;";
    }
    if (isset($_COOKIE['toggleTheme'])) {
      echo "toggleTheme(".$_COOKIE['toggleTheme'].");";
    }
  }
}
