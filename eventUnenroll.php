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
		<title>Student Event Unenroll</title>
		<!-- Styles -->
		<link rel="stylesheet" type="text/css" href="normalize.css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="theme.css" />
		<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Cuprum&amp;subset=latin' />
		<link rel="stylesheet" type="text/css" href="forms/view.css" media="all" />
		<link rel="stylesheet" type="text/css" href="jquery.confirm/jquery.confirm.css" />
		<!-- Scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="forms/view.js"></script>
		<script src="jquery.confirm/jquery.confirm.js"></script>
	</head>
	<body>
		<div id="title">
			<a href="Student.php">
				<h2 id="titleName">
					<img id="titleIcon" src="img/bot2.jpg"  alt="icon"> Holmen High School Robotics Club 
				</h2>
			</a>
			<input id="log" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
			<input id="changePassword" class="button"  type="button" onClick="location.href='changePassword.php'" value="Change password">
		</div>      
		<div id="label">
			<input id = "clockIn" class="labelButton"  type="button" onClick="location.href='clockIn.html'" value="Clock in">            
			<input id = "viewNote" class="labelButton"  type="button" onClick="location.href='viewNote.html'" value="View Note">        
			<input id = "eventSignUp" class = "labelButton" type = "button" onClick="location.href='eventSignUp.php'" value="Event Sign Up">
			<input id = "eventUnEnroll" class = "labelButton" type = "button" onClick="location.href='eventUnenroll.php'" value="Event Unenroll">
		</div>
		<div id="main_body">
			<div id="form_container">
				<h2>&nbsp;<a style="width: 637px">Events you are signed up for</a></h2>
				<?php 
				// Create connection
				$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
				// Check connection
				if (mysqli_connect_errno($connection)) {
					echo "<div>";
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
					echo "</div>";
				}
				$user = $_SESSION['login_user'];
				//get user id
                $userObject = mysqli_query($connection, "select * from users WHERE username = '$user' ");
                $row = $userObject->fetch_object();
                $userid = $row->id;
				// Gets results for events that have not been removed that students have signed up for
				$result = mysqli_query($connection, "select * from events join eventParticipation on 
										events.eventId = eventParticipation.eventId where events.removed != 1 
										AND eventParticipation.removed != 1 AND eventParticipation.userId = $userid");
				if (mysqli_num_rows($result)) {
					echo '<div style="position: relative; left: 25px; top: 0px; width: 30%; display: inline-block; float: left;"><label class="description">Title</label></div>
						<div style="float: left; width: 25%; display: inline-block;"><label class="description">Starts</label></div>
						<div style="float: left; width: 25%; display: inline-block;"><label class="description">Ends</label></div>
						<div style="float: left; width: 20%; display: inline-block;"><label class="description">Sign up</label></div>
						<table cellpadding="25" style="width: 90%;">';
					// output data of each row  
					while($row = mysqli_fetch_assoc($result)) {
						$eventid = $row["eventId"];
						echo '<tr><form action="" class="appnitro" method="post"><input type="hidden" name="event" value="'
						.$row["eventId"].'"><td>'.$row["title"]."</td><td>".$row["startDateTime"]."</td><td>".$row["endDateTime"]
						."</td>".'<td><input id="signup" class="button_text" type="submit" name="submit" value="Unenroll"></td></form></tr>';
					}	
					echo "</table>";
				} else {
					echo "You are not currently signed up for any events.";
				}
				?>
			</div>
			<img id="bottom" src="forms/bottom.png" alt="">
		</div>
	</body>
</html>
			
<?php 
// Handles submission of form - event unenroll
if (isset($_POST['submit'])) {
	$event = $_POST['event'];
	$eventData = mysqli_query($connection, "select * from events where eventId = $event");
	
	if($eventData->num_rows){
		$row = $eventData->fetch_object();
		$maxStud = $row->maxStudents;
		$sql = "DELETE FROM eventParticipation where (eventId=$event AND userId=$userid)";
		
		if (mysqli_query($connection, $sql)){
			echo '<meta http-equiv="refresh" content="0">';
			$maxStud ++;
			if (!mysqli_query($connection, "UPDATE events SET maxStudents=$maxStud where eventId=$event")){
				echo "<div>Events Database Error!!!</div>";
			}
			else { 
				echo ("<script>$.confirm({
					'title'		: '',
					'message'	: '<div align=\"center\">Unenrolled successfully</div>',
					'buttons'	: {
							'OK'	: {
										'class'	: 'blue',
									}
								},
					});</script>");
			}
		}
		else {
			echo '<div style="position: absolute; top: 150; left: 100;">Unenroll not completed.</div>';
		}
	}
	mysqli_close($connection); // Closing Connection;
}
?>