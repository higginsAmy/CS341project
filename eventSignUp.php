<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

include('session.php');
if (!isset($_SESSION['login_auth'])){
	header("location: Guest.php");
}
switch($_SESSION['login_auth']){
case "A":
	header("location: Admin.php"); // Redirecting To Admin Page
	break;
case "V":
	header("location: Volunteer.php"); // Redirecting To Volunteer Page
	break;			
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  	<meta charset="utf-8">
    <title>Student Event SignUp</title>
 	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="forms/view.css" media="all">
    <link rel="stylesheet" type="text/css" href="theme.css">
  </head>
  <body>
	  <div id="title">
		<a href="Student.php">
			<h2 id="titleName">
				<img id="titleIcon" src="calendar-icon.png"  alt="icon"> Holmen High School Robotics Club 
			</h2>
		</a>
		<input id="log" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
		<input id="changePassword" class="button"  type="button" onClick="location.href='changePassword.php'" value="Change password">
	  </div>      
	  <div id="label">
	  </div>
	  <div id="main_body">
		<h2 align="center">Event Signup</h2>
		<div id="form_container">
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
			// Gets results for events that have not been removed and have not reached their maximum number of students
			// (decremented upon signup).
			$result = mysqli_query($connection, "select * from events where removed != 1 AND maxStudents > 0");
			if ($result) {
				echo '<div style="position: relative; left: 20px; top: 0px; width: 35%; display: inline-block; float: left;"><label class="description">Title</label></div>
					<div style="float: left; width: 25%; display: inline-block;"><label class="description">Starts</label></div>
					<div style="float: left; width: 25%; display: inline-block;"><label class="description">Ends</label></div>
					<div style="float: left; width: 15%; display: inline-block;"><label class="description">Sign up</label></div>
					<table cellpadding="25" style="width: 90%;">';
				// output data of each row  
				while($row = mysqli_fetch_assoc($result)) {
					$eventsAttended = mysqli_query($connection, "select * from eventparticipation where user = '$user'");
					$check = true;
					while ($signedUp = mysqli_fetch_assoc($eventsAttended)){
						if($signedUp["eventId"] == $row["eventId"]){
							$check = false;
						}
					}
					// Only displays events that the students are not already signed up for.
					if ($check){
						echo '<tr><form action="" class="appnitro" method="post"><input type="hidden" name="event" value="'
						.$row["eventId"].'"><td>'.$row["title"]."</td><td>".$row["startDateTime"]."</td><td>".$row["endDateTime"]
						."</td>".'<td><input id="signup" class="button" type="submit" name="submit" value="Sign Up"></td></tr></form>';
					}
				}	
				echo "</table>";
			} else {
				echo "0 results";
			}
			// Handles submission of form - event signup
			if (isset($_POST['submit'])) {
				$maxStud = 0;
				$overlap = false;
				$event = $_POST[event];
				$addEvent = mysqli_query($connection, "select * from events WHERE eventId = '$event' ");
				if($addEvent->num_rows){
					$row = $addEvent->fetch_object();
					$end = $row->endDateTime;
					$start = $row->startDateTime;
					$maxStud = $row->maxStudents;
		  
		  			// Check for schedule conflict
					$signUpEvent = mysqli_query($connection, "select * from eventparticipation WHERE user = '$user'");
					if($signUpEvent->num_rows){
						while($rows = $signUpEvent->fetch_object()){
							$theEvent = mysqli_query($connection, "select * from events WHERE eventId = '$rows->eventId'");
							$theRow = $theEvent->fetch_object();
							$end2 = $theRow->endDateTime;
							$start2 = $theRow->startDateTime;
							if($start <= $end2 && $end >= $start2){
								$overlap = true;
							}
						}
					}		 
				}
				if($overlap == false){
					$sql = "INSERT INTO eventparticipation (eventId, user, type) VALUES($event, '$user', 'S')";
					if (mysqli_query($connection, $sql)){
						echo '<meta http-equiv="refresh" content="0">';
						$maxStud --;
						if (!mysqli_query($connection, "UPDATE events SET maxStudents=$maxStud where eventId=$event")){
							echo "<div>Error!!!</div>";
						}
						echo ("<script>alert('Signup successful!');</script>");
					}
					else {
						echo '<div style="position: absolute; top: 150; left: 100;">Signup not completed.</div>';
					}
				} else{
					echo '<div style="position: absolute; color: red; top: 155px; left: 450px;">Cannot sign up for event: Scheduling Conflict </div>';
				}
				mysql_close($connection); // Closing Connection;
			}
			?>
	  </div>
	</div>
  </body>
</html>