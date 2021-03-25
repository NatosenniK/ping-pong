<?php
$con = mysqli_connect("localhost","root","","ping-pong-tracking");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

// Perform query
if ($result = mysqli_query($con, "SELECT * FROM users WHERE email = 'mattkinne@gmail.com'")) {
  echo "Returned rows are: " . mysqli_num_rows($result);
  // Free result set

  /* fetch associative array */
	while ($row = mysqli_fetch_assoc($result)) {
		$username = $row["username"];
		echo $username;
	}
}

mysqli_close($con);
?>