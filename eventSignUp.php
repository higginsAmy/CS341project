<?php
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
<!doctype html>
<html>
  <head>
  	<meta charset="utf-8">
    <title>Student sign up for an Event</title>
 	<!-- Styles --> 
    <link rel="stylesheet" type="text/css" href="theme.css">
	<link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
	<!-- Scripts -->
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
		
		<input id = "StudentHome" class="labelButton" type="button" onClick="location.href='Student.php'" value="Student Home">
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
		$result = mysqli_query($connection, "select * from events");
		if ($result) {
			echo '<table align="center" cellpadding="25"><tr><th>Title</th><th>Starts</th><th>Ends</th>'
				.'<th>Sign up</th>';
			// output data of each row  
			while($row = mysqli_fetch_assoc($result)) {
				$eventsAttended = mysqli_query($connection, "select * from eventparticipation where user = '$user'");
				$check = true;
				while ($signedUp = mysqli_fetch_assoc($eventsAttended)){
					if($signedUp["eventId"] == $row["eventId"]){
						$check = false;
					}
				}
				if ($check){
					echo '<tr><form action="" method="post"><input type="hidden" name="event" value="'.$row["eventId"].'"><td>'.$row["title"]."</td><td>".$row["startDateTime"]."</td><td>"
					.$row["endDateTime"]."</td>".'<td><input id="signup" class="button" type="submit" name="submit" value="Sign Up"></td></tr></form>';
				}
			}	
			echo "</table>";
		} else {
			echo "0 results";
		}
		if (isset($_POST['submit'])) {
            $overlap = false;
            $event = $_POST[event];
            $addEvent = mysqli_query($connection, "select * from events WHERE eventId = '$event' ");
            if($addEvent->num_rows){
                $row = $addEvent->fetch_object();
            $end = $row->endDateTime;
            $start = $row->startDateTime;
       
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
             $sql = "INSERT INTO eventparticipation (eventId, user, type) VALUES('$event', '$user', 'S')";
               echo $sql;
			if (mysqli_query($connection, $sql)){
				echo '<meta http-equiv="refresh" content="0">';
			}
			else {
				echo '<div style="position: absolute; top: 150; left: 100;">Signup not completed.</div>';
			}
           } else{
               echo '<div style="position: absolute; color: red; top: 155px; left: 450px;">Cannot sign up for event: Scheduling Conflict </div>';
           }
			
		}
		mysql_close($connection); // Closing Connection;
		?>
	  </div>
	</div>
  </body