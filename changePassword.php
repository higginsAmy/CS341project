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
    if($result->num_rows == 1){
        mysqli_query($connection,"UPDATE users SET password='$newPassword'
WHERE username='$username'");
       
    include('session.php');
	if (!isset($_SESSION['login_auth'])){
		header("location: Guest.php");
	}
	switch($_SESSION['login_auth']){
        case "A":
			header("location: Admin.php"); // Redirecting To Student Page
			break;    
		case "S":
			header("location: Student.php"); // Redirecting To Student Page
			break;
		case "V":
			header("location: Volunteer.php"); // Redirecting To Volunteer Page
			break;			
    }
        
    }else{
        header("location: changePasswordWrong.html"); 
    }

} 




mysqli_close($connection); // Closing Connection


?>