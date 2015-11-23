<?php
include('session.php');
if (!isset($_SESSION['login_auth'])){
	header("location: Guest.php");
}
switch($_SESSION['login_auth']){
case "S":
	header("location: Student.php"); // Redirecting To Student Page
	break;
case "V":
	header("location: Volunteer.php"); // Redirecting To Volunteer Page
	break;			
}
?>
<!doctype html>
<html>
  <head>
  	<meta charset="utf-8">
    <title>Modify User Accounts</title>
 	<!-- Styles --> 
    <link rel="stylesheet" type="text/css" href="theme.css">
  </head>
  <body>
	  <div id = "title">
        <a href="Admin.php">
			<h2 id = "titleName">
			  <img id = "titleIcon" src = "calendar-icon.png"  alt="icon"> Holmen High School Robotics Club 
			</h2>
        </a>
		<input id = "log" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
		<input id = "changePassword" class="button"  type="button" onClick="location.href='changePassword.php'" value="Change password">
	  </div>      
	  <div id="label">
		<input id = "modifyHours" class="labelButton" type="button" onClick="location.href='modifyStudentHours.html'" value="Modify student WorkHours ">
		<input id = "addevent" class="labelButton" type="button" onClick="location.href='forms/newEvent.php'" value="Add event">
		<input id = "modifyuser" class="labelButton" type="button" onClick="location.href='modifyUser.php'" value="Modify user">
		<input id = "modifyItems" class="labelButton" type="button" onClick="location.href='modifyItems.html'" value="Modify donation items">
		<input id = "seeMessage" class="labelButton" type="button" onClick="location.href='seeMessage.html'" value="See message">
	  </div>
	  <div>
		<?php 
		// Create connection
		$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
		// Check connection
		if (mysqli_connect_errno($connection)) {
			echo "<div>";
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			echo "</div>";
		}
		// SQL query to fetch information of registerd users and finds user match.
		$user = $_SESSION['login_user'];
		$result = mysqli_query($connection, "select * from users where username !='$user'");
		if ($result) {
			echo '<table align="center" cellpadding="25"><tr><th>First Name</th><th>Last Name</th><th>Email</th>'
				.'<th>Username</th><th>Type</th><th>Password</th><th>Change User Type</th><th>Delete</th></tr>';
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				switch ($row["auth"]){
					case "A":
						$userType = 'Admin';
						break;
					case "V":
						$userType = 'Volunteer';
						break;
					default:
						$userType = 'Student';
						break;
				}
				echo "<tr><td>".$row["first"]."</td><td>".$row["last"]."</td><td>".$row["email"]."</td><td>"
					.$row["username"]."<a href='changeUsername.php?username="
					.$row["username"]."'> (Change)</a></td><td>".$userType."</td><td><a href='resetPassword.php?username="
					.$row["username"]."'>Reset Password</a></td><td><a href='changeAuth.php?username="
					.$row["username"]."'>Change User Type</a></td><td><a href='deleteUser.php?username="
					.$row["username"]."'>Delete User</a></td></tr>";
			}
			echo '<tr><td><input id="newUser" class="button" type="button" onClick="location.href=\'forms/newUser.php\'" value="Create New User"></td></tr>';
			echo "</table>";
		} else {
			echo "0 results";
		}
		mysqli_close($connection); // Closing Connection;
		?>
	  </div>
	</div>
  </body>
</html>