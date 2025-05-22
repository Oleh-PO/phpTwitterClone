<?php

trait pullPost {
  function pullPost($id) {
    $sql = "
      SELECT login, content, date, Users.id as user_id, Posts.id
      FROM Posts
      INNER JOIN Users
      ON Posts.user_id = Users.id
      WHERE Posts.id = $id;
    ";

    $row = $this->conn->query($sql)->fetch_assoc();
    $userSettings = "";

    $sName = $_SERVER['SERVER_NAME']."/?post=".$row['id'];

    //test for owner, if ownership true -> add edit and delete buttons
    if ($row['user_id'] === $this->userId) {
      $userSettings =
      "
        <button onclick='edit(p".$row['id'].")'>edit</button>
        <button onclick='deletePost(".$row['id'].")'>delete</button>
      ";
    }

    require $_SERVER['DOCUMENT_ROOT']."/html/postTemplate.php";
  }
}
