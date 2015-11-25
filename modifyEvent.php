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
        <a href="Volunteer.php">
			<h2 id = "titleName">
			  <img id = "titleIcon" src = "calendar-icon.png"  alt="icon"> Holmen High School Robotics Club 
			</h2>
          </a>
		<input id = "log" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
		<input id = "changePassword" class="button"  type="button" onClick="location.href='changePassword.php'" value="Change password">
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
		$result = mysqli_query($connection, "select * from events where creator='$user' and removed!=1 GROUP BY startDateTime");
		if ($result) {
			echo '<table align="center" cellpadding="25"><tr><th>Event Title</th><th># Students</th>
				<th># Volunteers</th><th>Starts</th><th>Ends</th><th>Delete</th></tr>';
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row['eventId'];
				$numStudents = 0;
				$numVolunteers = 0;
				if (!$result2 = mysqli_query($connection, "SELECT * FROM eventParticipation WHERE eventId=$id AND type='S'")){
					echo "<div>Database error finding student count</div>";
				}
				else {
					$numStudents = mysqli_num_rows($result2);
				}
				if (!$result2 = mysqli_query($connection, "SELECT * FROM eventParticipation WHERE eventId=$id AND type='V'")){
					echo "<div>Database error finding volunteer count</div>";
				}
				else {
					$numVolunteers = mysqli_num_rows($result2);
				}
				echo "<tr><td>".$row["title"]."</td><td>".$numStudents."</td><td>".$numVolunteers
					."</td><td>".$row["startDateTime"]."</td><td>"
					.$row["endDateTime"]."</td><td><a href='deleteEvent.php?eventID="
					.$row["eventId"]."'>Delete Event</a>";	
			}
		}
		else {
			echo "Zero results.";
		}
		// Logic that handles submission of the form
		if (isset($_POST['submit'])) {
			if(mysqli_query($connection, "DELETE FROM events WHERE ='$user'")){
				$success = "Successfully updated event: \"$event\"";
				echo '<meta http-equiv="refresh" content="0">';
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