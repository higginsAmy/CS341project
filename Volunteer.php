<?php
include('session.php');
if (!isset($_SESSION['login_auth'])){
	header("location: Guest.php");
}
switch($_SESSION['login_auth']){
case "A":
	header("location: Admin.php"); // Redirecting To Admin Page
	break;
case "S":
	header("location: Student.php"); // Redirecting To Student Page
	break;
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Volunteer main page for the Holmen High School Robotics Team">
		<meta name="author" content="Adam Geipel, Amy Higgins, Changsong Li">
		<title>Volunteer | Holmen Robotics</title>
		<!-- Styles -->
		<link rel="stylesheet" type="text/css" href="normalize.css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="theme.css" />
		<link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
		<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Cuprum&amp;subset=latin' />
		<link rel="stylesheet" type="text/css" href="jquery.confirm/jquery.confirm.css" />
		<!-- Scripts -->
		<script src='fullcalendar/lib/jquery.min.js'></script>
		<script src='fullcalendar/lib/moment.min.js'></script>
		<script src='fullcalendar/fullcalendar.js'></script>
		<script src="jquery.confirm/jquery.confirm.js"></script>
		<?php include ('volCal.php'); ?>
	</head>
    <body>
        <div id = "title">
            <a href="Volunteer.php">
				<h2 id = "titleName">
					<img id = "titleIcon" src = "img/bot2.jpg"  alt="icon"> Holmen High School Robotics Club
				</h2>
            </a>
            <input id = "log" class="button" type="button" onClick="location.href='logout.php'" value="Log out">
            <input id = "changePassword" class="button" type="button" onClick="location.href='changePassword.php'" value="Change password">
        </div>
        <div id=label>
            <input id = "help" class="labelButton"  type="button" onClick="location.href='help.html'" value="Help">
			<input id = "addEvent" class="labelButton"  type="button" onClick="location.href='newEvent.php'" value="Add event">
			<input id = "modifyEvent" class="labelButton"  type="button" onClick="location.href='modifyEvent.php'" value="Modify event">
			<input id = "eventSignUp" class="labelButton"  type="button" onClick="location.href='volunteerSignUp.php'" value="Sign up for event">
			<input id = "eventUnEnroll" class="labelButton"  type="button" onClick="location.href='eventUnenroll.php'" value="Event Unenroll">
        </div>
		<div id="body" style="margin: 0 5px 5px 5px;">
			<div id='calendar' style="background:white; position:relative; top: 10px; width:75%; display:inline-block;"></div>
		</div>
	</body>
</html>

<?php
$userid = $_SESSION['login_id'];
$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
// Check connection
if (mysqli_connect_errno($connection)) {
	echo "<div>";
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	echo "</div>";
}
$eventsAttended = mysqli_query($connection, "SELECT * FROM eventParticipation WHERE userId = $userid");
$rowsNumber = $eventsAttended->num_rows;
if($rowsNumber>=2){
		while($rows = $eventsAttended->fetch_object()){
			$theEvent = mysqli_query($connection, "select * from events WHERE eventId = $rows->eventId");
			$theRow = $theEvent->fetch_object();
			$end = $theRow->endDateTime;
			$start = $theRow->startDateTime;
			$arrStartTime[]=$start;
			$arrEndTime[]=$end;
		}
		$overlap = false;
		for($i = 0; $i < $rowsNumber-1; $i++){
			$thisStart = $arrStartTime[$i];
			$thisEnd = $arrEndTime[$i];
			for($j = $i+1; $j < $rowsNumber; $j++){
				$CompareStart = $arrStartTime[$j];
				$CompareEnd = $arrEndTime[$j];
				if($thisStart <= $CompareEnd && $thisEnd >= $CompareStart){
					$overlap = true;
				}
			}
		}
		if($overlap){
			echo ("<script>$.confirm({
					'title'		: '',
					'message'	: '<div align=\"center\">Current schedule has conflict.<br> Click here to delete conflicting event(s)</div>',
					'buttons'	: {
						'OK'	: {
									'class'	: 'blue',
									'action' : function(){
										window.location.replace('conflictPage.php');
									}
								}
							},
					});</script>");
		}
}
?>
