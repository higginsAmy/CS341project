<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
	// Define $username and $password
	$username=$_POST['username'];
	$password=$_POST['password'];
	$checkSQLInjection = false;

	if (strpos($username,'\'') !== false || strpos($username,'=') !== false) {
	$checkSQLInjection = true;
	}
	if (strpos($password,'\'') !== false || strpos($password,'=') !== false){
	$checkSQLInjection = true;
	}

	if($checkSQLInjection){
		echo "<div style=\"position: absolute;color: red; top: 400px; left: 33%\">";
		echo "The username or password should not have character such as: '= . ";
		echo "</div>";
	}
	else{
		$hash = password_hash($password, PASSWORD_DEFAULT);
		//echo "<div style='position: absolute; top: 200px;'>$hash</div>";
		// Create connection
		$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
		// Check connection
		if (mysqli_connect_errno($connection)) {
			echo "<div>";
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			echo "</div>";
		}
		// SQL query to fetch information of registered users and finds user match.
		$result = mysqli_query($connection, "select * from users where username='$username'");
		if (mysqli_num_rows($result)!=0) {
			$row = mysqli_fetch_assoc($result);
			$auth = $row['auth'];
			$pwd = $row['password'];
			$userid = $row['id'];
			// Verify plaintext password against hash
			if (password_verify($password, $pwd)){
				$_SESSION['login_id']=$userid; // Initializing Session
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
			} else {
				$error = "Password is invalid.";
			}
		}
		else {
			$error = "Username is invalid.";
		}
		mysqli_close($connection); // Closing Connection
	}
}
?>
