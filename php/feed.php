<?php
	if (!isset($profile_id)) {
		$sql = "
			SELECT * FROM Posts
			WHERE user_id != '$id';
		";
	} else {
		$sql = "
		SELECT * FROM Posts
		WHERE user_id = '$profile_id';
	";
	}
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo $row["user_id"] . " " . $row["content"] . "<br>";
  }
} else {
  echo "0 results";
}

