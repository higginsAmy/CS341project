<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

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
$success=''; // Variable to hold reporting of success or failure of mySQL update.
?>
<!doctype html>
<html>
  <head>
  	<meta charset="utf-8">
    <title>Delete Event</title>
 	<!-- Styles --> 
    <link rel="stylesheet" type="text/css" href="theme.css">
  </head>
  <body>
	  <div id = "title">
		<a href="Volunteer.php">
			<h2 id = "titleName">
			  <img id = "titleIcon" src = "calendar-icon.png"  alt="icon"> Holmen High School Robotics Club 
			</h2>
		</a>
		<input id = "log" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
		<input id = "changePassword" class="button"  type="button" onClick="location.href='changePassword.php'" value="Change password">
	  </div>      
	  <div id="label">
	  </div>
	  <div id="body">
		<?php 
		// Fetch eventID from GET variable
		$event = htmlspecialchars($_GET["eventID"]);
		// Create connection
		$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
		// Check connection
		if (mysqli_connect_errno($connection)) {
			echo "<div>";
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			echo "</div>";
		}
		// SQL query to fetch information from target user.
		$result = mysqli_query($connection, "select * from events where eventId=$event");
		if ($result) {
			if(mysqli_query($connection, "Update events SET removed=1 WHERE eventID=$event")){
				$success = "Successfully updated event";
			}
			else {
				$success = "Update failed.";
			}
		}
		else {
			echo "Zero results.";
		}
		mysql_close($connection); // Closing Connection;
		?>
		<div style="position: absolute; top: 350px; left: 500px;"><?php echo $success; ?></div>
	  </div>
  </body>
</html>