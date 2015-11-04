<?php
include('session.php');
if (!isset($_SESSION['login_auth'])){
	header("location: Guest.html");
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
    <title>Reset Password</title>
 	<!-- Styles --> 
    <link rel="stylesheet" type="text/css" href="theme.css">
	<link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
	<!-- Scripts -->
	<script src='fullcalendar/lib/jquery.min.js'></script>
	<script src='fullcalendar/lib/moment.min.js'></script>
	<script src='fullcalendar/fullcalendar.js'></script>
  </head>
  <body>
	  <div id = "title">
		<h2 id = "titleName">
		  <img id = "titleIcon" src = "calendar-icon.png"  alt="icon"> Holmen High School Robotics Club 
		</h2>
		<input id = "log" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
		<input id = "changePassword" class="button"  type="button" onClick="location.href='changePassword.html'" value="Change password">
	  </div>      
	  <div id="label">
		<input id = "ModifykHours" class="labelButton" type="button" onClick="location.href='modifyStudentHours.html'" value="Modify student WorkHours ">
		<input id = "addevent" class="labelButton" type="button" onClick="location.href='addEvent.html'" value="Add event">
		<input id = "modifyuser" class="labelButton" type="button" onClick="location.href='modifyUser.php'" value="Modify user">
		<input id = "modifyItems" class="labelButton" type="button" onClick="location.href='modifyItems.html'" value="Modify donation items">
		<input id = "seeMessage" class="labelButton" type="button" onClick="location.href='seeMessage.html'" value="See message">
		<input id = "adminHome" class="labelButton" type="button" onClick="location.href='Admin.php'" value="Admin Home">
	  </div>
	  <div>
		<?php 
		// Fetch username from GET variable
		$user = htmlspecialchars($_GET["username"]);
		// Create connection
		$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
		// Check connection
		if (mysqli_connect_errno($connection)) {
			echo "<div>";
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			echo "</div>";
		}
		// SQL query to fetch information from target user.
		$result = mysqli_query($connection, "select * from users where username ='$user'");
		if ($result) {
			$newPassword = "";
			$i = 0;
			while($i < 5){
			  $rand = rand(0, 61);
			  if ($rand < 10){
				$newPassword .= "$rand";  
			  }
			  else if ($rand < 36){
				  $rand += 55;
				  $newPassword .= chr($rand);
			  }
			  else {
				  $rand += 61;
				  $newPassword .= chr($rand);
			  }
			  $i++;
			}
			$sql = "UPDATE Users SET password='$newPassword' WHERE username='$user'";
			if (!mysqli_query($connection, $sql)) {
				echo "Error updating record: " . mysqli_error($conn);
			}
			echo "<h3>User " . $user . "'s new password is: ". $newPassword ."</h3>";
		}
		else {
			echo "Zero results.";
		}
		mysql_close($connection); // Closing Connection;
		?>
	  </div>
  </body>
</html>