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
    <title>Student | Holmen Robotics</title>
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
	<?php include ('studentCal.php'); ?>
  </head>
  <body>
    <div id = "title">
        <a href="Student.php">
			<h2 id = "titleName"> 
				<img id = "titleIcon" src = "img/bot2.jpg"  alt="icon"> Holmen High School Robotics Club 
			</h2>
        </a>
        <input id = "log" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
		<input id = "changePassword" class="button"  type="button" onClick="location.href='changePassword.php'" value="Change password">
    </div>
    <div id="label">
        <input id = "clockIn" class="labelButton"  type="button" onClick="location.href='clockIn.html'" value="Clock in">            
        <input id = "viewNote" class="labelButton"  type="button" onClick="location.href='viewNote.html'" value="View Note">        
        <input id = "eventSignUp" class = "labelButton" type = "button" onClick="location.href='eventSignUp.php'" value="Event Sign Up">
		<input id = "eventUnEnroll" class = "labelButton" type = "button" onClick="location.href='eventUnenroll.php'" value="Event Unenroll">		
    </div>
	<div id="body" style="margin: 0 5px 5px 5px;">
		<div id='calendar' style="background:white; position:relative; top: 10px; width:75%; display:inline-block;"></div>
	</div>
	</body>
</html>
