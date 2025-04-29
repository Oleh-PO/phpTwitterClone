<?php
function pullPost() {
  global $conn, $postId, $userId;
  $sql = "
    SELECT login, content, date, Users.id as user_id, Posts.id
    FROM Posts
    INNER JOIN Users
    ON Posts.user_id = Users.id
    WHERE Posts.id = $postId;
  ";

  $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));

  require $_SERVER['DOCUMENT_ROOT']."/html/postTemplate.php";
}
