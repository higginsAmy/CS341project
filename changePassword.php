<?php

// Define $username and $password
$username=$_POST['username'];
$password=$_POST['currentPassword'];
$newPassword=$_POST['newPassword'];
// Create connection
$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
// Check connection
if (mysqli_connect_errno($connection)) {
    echo "<div>";
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    echo "</div>";
} 
// SQL query to fetch information of registered users and finds user match.
$result = mysqli_query($connection, "select * from users where password='$password' && username='$username'");

if ($result) {
	$row = mysqli_fetch_assoc($result);
	$auth = $row['auth'];
	$_SESSION['login_user']=$username; // Initializing Session
	$_SESSION['login_auth']=$auth;
	switch($auth){
		case "A":
			mysqli_query($connection,"UPDATE users SET password='$newPassword'
WHERE username='$username'");
            header("location: Admin.php"); // Redirecting To Admin Page
			break;
		case "S":
			hmysqli_query($connection,"UPDATE users SET password='$newPassword'
WHERE username='$username'");
            header("location: Student.php"); // Redirecting To Student Page
			break;
		case "V":
			mysqli_query($connection,"UPDATE users SET password='$newPassword'
WHERE username='$username'");
            header("location: Volunteer.php"); // Redirecting To Volunteer Page
			break;
		default:
			header("location: changePasswordWrong.html"); // Redirecting To Guest Page
            echo "wrong previous paaword.";
	}
} 




mysqli_close($connection); // Closing Connection


?>