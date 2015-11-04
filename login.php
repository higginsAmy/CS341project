<?php
	session_start(); // Starting Session
	$error=''; // Variable To Store Error Message
	if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is missing!";
	} 
	else {
		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		// Create connection
		$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
		// Check connection
		if (mysqli_connect_errno($connection)) {
			echo "<div>";
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			echo "</div>";
		} 
		// SQL query to fetch information of registered users and finds user match.
		$result = mysqli_query($connection, "select * from users where password='$password' AND username='$username'");
		if (mysqli_num_rows($result)!=0) {
			$row = mysqli_fetch_assoc($result);
			$auth = $row['auth'];
			$_SESSION['login_user']=$username; // Initializing Session
			$_SESSION['login_auth']=$auth;
			switch($auth){
				case "A":
					header("location: Admin.php"); // Redirecting To Admin Page
					break;
				case "S":
					header("location: Student.php"); // Redirecting To Student Page
					break;
				case "V":
					header("location: Volunteer.php"); // Redirecting To Volunteer Page
					break;
			}
		}
		else {
			$result = mysqli_query($connection, "select * from users where username='$username'");
			if (mysqli_num_rows($result) == 0){
				$error = "Username is invalid.";
			}
			else {
				$error = "Password is invalid.";
			}
		}
	mysqli_close($connection); // Closing Connection
	}
}
?>