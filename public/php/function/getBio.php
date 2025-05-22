<?php

trait getBio {
  function getBio() {
    $sql = "
      SELECT bio FROM Users
      WHERE id = '$this->getUserId';
    ";

    $result = $this->conn->query($sql)->fetch_assoc();

    if ($result["bio"]) { //get user bio from mySQL
      return $result["bio"];
    } else {
      return "nothing here";
    }
  }
}
