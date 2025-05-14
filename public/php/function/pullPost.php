<?php
function pullPost() {
  global $conn;
  $sql = "
    SELECT login, content, date, Users.id as user_id, Posts.id
    FROM Posts
    INNER JOIN Users
    ON Posts.user_id = Users.id
    WHERE Posts.id = $user->postId;
  ";

  $row = $conn->query($sql)->fetch_assoc();

  require $_SERVER['DOCUMENT_ROOT']."/html/postTemplate.php";
}
