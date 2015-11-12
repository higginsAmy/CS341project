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
	$success=''; // Variable to hold reporting of success or failure of mySQL update.
?>
<!doctype html>
<html>
  <head>
  	<meta charset="utf-8">
    <title>Change Authorization</title>
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
		<input id = "modifyEvent" class="labelButton" type="button" onClick="location.href='modifyEvent.html'" value="Delete event">
		<input id = "modifyuser" class="labelButton" type="button" onClick="location.href='modifyUser.php'" value="Modify user">
		<input id = "modifyItems" class="labelButton" type="button" onClick="location.href='modifyItems.html'" value="Modify donation items">
		<input id = "seeMessage" class="labelButton" type="button" onClick="location.href='seeMessage.html'" value="See message">
		<input id = "adminHome" class="labelButton" type="button" onClick="location.href='Admin.php'" value="Admin Home">
	  </div>
	  <div>
		<?php 
		// Fetch username from session
		$user = $_SESSION['login_user'];
		// Create connection
		$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
		// Check connection
		if (mysqli_connect_errno($connection)) {
			echo "<div>";
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			echo "</div>";
		}
		// SQL query to fetch events created by user
		$result = mysqli_query($connection, "select * from events where creator ='$user' GROUP BY startTimeDate");
		if ($result) {
			echo '<table align="center" cellpadding="25"><tr><th>Event Title</th><th>Starts</th><th>Ends</th>'
				.'<th>Delete</th></tr>';
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				echo "<tr><td>".$row["title"]."</td><td>".$row["startDateTime"]."</td><td>".$row["endDateTime"]."</td><td>"
				.$row["username"]."'>Delete Event</a></td><td><a href='deleteEvent.php?eventID="	
		}
		}
		else {
			echo "Zero results.";
		}
		// Logic that handles submission of the form
		if (isset($_POST['submit'])) {
			if(mysqli_query($connection, "DELETE FROM events WHERE ='$user'")){
				$success = "Successfully updated event: \"$event\"";
			}
			else {
				$success = 'Update failed.';
			}
		}
		mysql_close($connection); // Closing Connection;
		?>
		<div style="position: absolute; top: 350px; left: 500px;"><?php echo $success; ?></div>
	  </div>
  </body>
</html>