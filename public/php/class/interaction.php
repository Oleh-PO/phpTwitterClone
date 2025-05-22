<?php
require $_SERVER['DOCUMENT_ROOT'] . "/php/class/init.php";


class interaction extends init {
  public $body;
  public $id;
  public $textData;

  public function __construct($input) {
    parent::__construct();
    $this->body = $input;
    $this->id   = $this->body->id;
  }
  public function delete() {

    if ($this->isOwner()) {
      $sql = "
        DELETE FROM Posts
        WHERE id = $this->id;
      ";
      $this->conn->query($sql);
    }
  }
  public function edit() {

    $this->textData = $this->body->content;//reads a payload

    if ($this->id[0] === "p") {//if p (post) - edit post with id
      $this->id = ltrim($this->id, "p");

      if (!$this->isOwner()) {
        die("wrong post by isOwner");
      }

      $sql = "
        UPDATE Posts SET content = '$this->textData'
        WHERE id = $this->id;
      ";
    } else if ($this->id === "bio") {//else if bio - edit bio of user

      $sql = "
        SELECT id FROM Users
        WHERE id = $this->userId;
      ";

      if (!$this->conn->query($sql)) {
        die("wrong user");
      }

      $sql = "
        UPDATE Users SET bio = '$this->textData'
        WHERE id = $this->userId;
      ";
    }
    $this->conn->query($sql);
  }
}
