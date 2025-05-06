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
