<?php

$errorMessage = array(
  "passwordIncorrect"=>"Password incorrect",
  "loginMissing"=>"Nickname or email is missing",
  "nicknameTaken"=>"Nickname is already taken",
  "emailTaken"=>"Email is already registered",
  "passwordIncorrect"=>"Password must be between 8 and 16 characters",
  "passwordNotMatch"=>"Passwords not match"
);

function invalidTest($test) {
  if ($test) {
    echo "invalid";
  }
}
function formTest($test) {
  if ($test) {
    echo "value='$test'";
  }
}
function validInput($input, $type, ) { //test for uniqueness
  global $conn;
  $length = strlen($input);

  if ($length > 0 && $length < 31) {
    $sql = "
      SELECT $type FROM Users
      WHERE $type = '$input';
    ";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return !is_array($result);
  }
}

function validation() {
  global $login, $email, $password, $passcon, $error, $loginError, $emailError, $passwordError, $confirmError;

  if (!validInput($login, "login")) {
    $error = "nicknameTaken";
    $loginError = true;
    return;
  }
  if (!validInput($email, "email")) {
    $error = "emailTaken";
    $emailError = true;
    return;
  }
  if (strlen($password) < 8 && strlen($password) > 16) {
    $error = "passwordIncorrect";
    $passwordError = true;
    return;
  }
  if ($password !== $passcon) {
    $error = "passwordNotMatch";
    $passwordError = true;
    $confirmError  = true;
    return;
  }
  return true;
}

function start() {
  global $passwordError, $loginError, $login, $password, $conn;
  $passwordError = false;
  $loginError    = false;
  $login         = false;
  $password      = false;

  if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $login    = $_POST["login"];
    $password = $_POST["password"];

    $sql = "
      SELECT id, password, login FROM Users
      WHERE login = '$login' OR email = '$login';
    ";

    $result = $conn->query($sql)->fetch_assoc();

    if($result > 0) {
      if (password_verify($password, $result["password"])) {

        $_SESSION["id"]       = $result["id"];
        $_SESSION["username"] = $result["login"];//start session

        header("Location: /");
        exit();
      }
      $error = "passwordIncorrect";
      $passwordError = true;
    } else {
      $error = "loginMissing";
      $loginError = true;
    }
  }
}
function startS() {
  global $login, $email, $password, $passcon, $conn;
  $login    = false;
  $email    = false;
  $password = false;
  $passcon  = false;

  if ($_SERVER['REQUEST_METHOD'] === "POST") { //validate form
    $login    = $_POST["login"];
    $email    = $_POST["email"];
    $password = $_POST["password"];
    $passcon  = $_POST["passCon"];

    if (validation()) {

      $sql = "
        INSERT INTO Users (login, email, password)
        VALUES ('$login', '$email', '$hash');
      ";

      if (mysqli_query($conn, $sql)) {

        $sql = "
          SELECT id FROM Users
          WHERE login = '$login';
        ";

        $result = $conn->query($sql)->fetch_assoc();

        $_SESSION["id"]       = $result["id"];
        $_SESSION["username"] = $login;//start session

        header("Location:/");
        exit();
      } else {
        echo("error");
      }
    }
  }
  mysqli_close($conn);
}
