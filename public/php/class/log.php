<?php
require $_SERVER['DOCUMENT_ROOT'] . "/php/class/init.php";


class Log extends Init {
  public $error;

  public $login    = false;
  public $email    = false;
  public $password = false;
  public $passcon  = false;

  public $passwordError = false;
  public $loginError    = false;
  public $confirmError  = true;


  private $errorMessage = array(
      "passwordIncorrect"=>"Password incorrect",
      "loginMissing"=>"Nickname or email is missing",
      "nicknameTaken"=>"Nickname is already taken",
      "emailTaken"=>"Email is already registered",
      "passwordIncorrectLength"=>"Password must be between<br>8 and 16 characters",
      "passwordIncorrect"=>"Password not correct",
      "passwordNotMatch"=>"Passwords not match"
    );

  public function getErrorMessage($message) {
    return $this->errorMessage[$message];
  }

  public function invalidTest($test) {
    if ($test) {
      echo "invalid";
    }
  }
  public function formTest($test) {
    if ($test) {
      echo "value='$test'";
    }
  }
  public function validInput($input, $type, ) { //test for uniqueness
    global $conn;
    $length = strlen($input);

    if ($length > 0 && $length < 31) {
      $sql = "
        SELECT $type FROM Users
        WHERE $type = '$input';
      ";
      $result = $this->conn->query($sql)->fetch_assoc();
      return !is_array($result);
    }
  }

  public function validation() {

    if (!$this->validInput($this->login, "login")) {
      $this->error = "nicknameTaken";
      $this->loginError = true;
      return;
    }
    if (!$this->validInput($this->email, "email")) {
      $this->error = "emailTaken";
      $this->emailError = true;
      return;
    }
    if (strlen($this->password) < 8 && strlen($this->password) > 16) {
      $this->error = "passwordIncorrectLength";
      $this->passwordError = true;
      return;
    }
    if ($this->password !== $this->passcon) {
      $this->error = "passwordNotMatch";
      $this->passwordError = true;
      $this->confirmError  = true;
      return;
    }
    return true;
  }

  public function logIn() {

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      $this->login    = $_POST["login"];
      $this->password = $_POST["password"];

      $sql = "
        SELECT id, password, login FROM Users
        WHERE login = '$this->login' OR email = '$this->login';
      ";

      $result = $this->conn->query($sql)->fetch_assoc();


      if($result > 0) {
        if (password_verify($this->password, $result["password"])) {

          $_SESSION["id"]       = $result["id"];
          $_SESSION["username"] = $result["login"];//start session

          header("Location: /");
          exit();
        }
        $this->error = "passwordIncorrect";
        $this->passwordError = true;
      } else {
        $this->error = "loginMissing";
        $this->loginError = true;
      }
    }
  }
  public function singIn() {

    if ($_SERVER['REQUEST_METHOD'] === "POST") { //validate form
      $this->login    = $_POST["login"];
      $this->email    = $_POST["email"];
      $this->password = $_POST["password"];
      $this->passcon  = $_POST["passCon"];

      if ($this->validation()) {
        $hash = password_hash($this->password, PASSWORD_DEFAULT);

        $sql = "
          INSERT INTO Users (login, email, password)
          VALUES ('$this->login', '$this->email', '$hash');
        ";

        if ($this->conn->query($sql)) {

          $sql = "
            SELECT id FROM Users
            WHERE login = '$this->login';
          ";

          $result = $this->conn->query($sql)->fetch_assoc();

          $_SESSION["id"]       = $result["id"];
          $_SESSION["username"] = $this->login;//start session

          header("Location:/");
          exit();
        } else {
          echo("error");
        }
      }
    }
    $this->conn->close();
  }
}
