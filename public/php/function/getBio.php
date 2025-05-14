<?php
function getBio() {
  global $conn;
  $sql = "
    SELECT bio FROM Users
    WHERE id = '$user->getUserId';
  ";

  $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

  if ($result["bio"]) { //get user bio from mySQL
    return $result["bio"];
  } else {
    return "nothing here";
  }
}
