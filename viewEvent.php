<?php
include('session.php');	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  	<meta charset="utf-8">
    <title>View Event</title>
 	<!-- Styles --> 
    <link rel="stylesheet" type="text/css" href="theme.css">
	<link rel="stylesheet" type="text/css" href="forms/view.css" media="all">
  </head>
  <body>
	  <div id = "title">
		<a href="Student.php">
			<h2 id = "titleName">
			  <img id = "titleIcon" src = "calendar-icon.png"  alt="icon"> Holmen High School Robotics Club 
			</h2>
		</a>
		<input id = "log" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
		<input id = "changePassword" class="button"  type="button" onClick="location.href='changePassword.php'" value="Change password">
	  </div>      
	  <div id="label">
	  </div>
	  <div id="main_body">
		<?php 
		// Fetch username from GET variable
		$eventID = htmlspecialchars($_GET["eventID"]);
		if (!$eventID){
			echo "<div>No Event to display.</div>";
		}
		else {
			// Create connection
			$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
			// Check connection
			if (mysqli_connect_errno($connection)) {
				echo "<div>";
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
				echo "</div>";
			}
			// SQL query to fetch information from target user.
			$result = mysqli_query($connection, "select * from events where eventId=$eventID");
			if ($result) {
				while ($row = mysqli_fetch_assoc($result)){
					echo '<h2 align="center">'.$row["title"].'</h2><div id="form_container">
						<div style="position: relative; left: 30px; top: 0px; width: 38%; display: inline-block; float: left;">
						<label class="description">Start Date/Time</label></div><div style="width: 34%; display: inline-block; float: left;">
						<label class="description">End Date/Time</label></div><div style="width: 28%; display: inline-block; float: left;">
						<label class="description">Description</label></div>';

					echo '<table cellpadding="25" style="width: 90%;"><tr><td>'.$row["startDateTime"].'</td>
						<td>'.$row["endDateTime"].'</td><td>'.$row["description"].'</td></tr></table>
						<p></p>
						<div style="position: relative; left: 10px; top: 0px; width: 25%; display: inline-block; float: left;">
						<label class="description">Min Volunteers</label></div>
						<div style="width: 25%; display: inline-block; float: left;"><label class="description">Max Volunteers</label></div>
						<div style="width: 25%; display: inline-block; float: left;"><label class="description">Min Students</label></div>
						<div style="width: 25%; display: inline-block; float: left;"><label class="description">Max Students</label></div>
						<table cellpadding="25" style="width: 90%; text-align: center;"><tr><td>'.$row["minVolunteers"].'</td>
						<td>'.$row["maxVolunteers"].'</td><td>'.$row["minStudents"].'</td><td>'.$row["maxStudents"].'</td></tr></table>';
				}
			}
			else {
				echo "Zero results.";
			}
			mysql_close($connection); // Closing Connection;
		}
		?>
	  </div>
  </body>
</html>