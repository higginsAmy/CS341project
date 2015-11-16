<?php
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
?>
<!doctype html>
<html>
  <head>
  	<meta charset="utf-8">
    <title>Admin | Holmen Robotics</title>
 	<!-- Styles --> 
    <link rel="stylesheet" type="text/css" href="theme.css">
	<link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
	<!-- Scripts -->
	<script src='fullcalendar/lib/jquery.min.js'></script>
	<script src='fullcalendar/lib/moment.min.js'></script>
	<script src='fullcalendar/fullcalendar.js'></script>
      
	<script>
		$(document).ready(function() {
    		// page is now ready, initialize the calendar...
    		$('#calendar').fullCalendar({
				editable: true,
        		weekmode: 'variable',
				eventClick: function(event) {
					if (event.url) {
						window.open(event.url);
						return false;
					}
				},
        		eventSources: [
				// your event source
					{
						events:  [
							<?php 
							// Create connection
							$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
							$query = mysqli_query($connection, "SELECT * FROM events");
							while ($event = mysqli_fetch_assoc($query)) {
								$eventID = $event["eventId"];
								$title = $event["title"];
								$start = $event["startDateTime"];
								$end = $event["endDateTime"];
								$MinVols = $event["minVolunteers"];
								$MaxVols = $event["maxVolunteers"];
								$MinStud = $event["minStudents"];
								$MaxStud = $event["maxStudents"];
								$Desc = $event["description"];
								if ($event["removed"] == 1) {
									$color = red;
									$textColor = white;
								} else {
									$color = blue;
									$textColor = white;
								}
								
								echo "{";
								echo "title : '$title',";
								echo "start : '$start',";
								echo "end : '$endDateTime',";
								echo "url : 'viewEvent.php?eventID=$eventID',";
								echo "color : '$color',";
								echo "textColor : '$textColor'";
								//echo "MinVols: '$MinVols'";
								//echo "MaxVols: '$MaxVols'";
								//echo "MinStud: '$MinStud'";
								//echo "MaxStud: '$MaxStud'";
								//echo "Desc : '$Desc'";
								echo "},";
							}
    						?>
						],
					}
					// any other event sources...
				]
    		})
		});
	</script>
  </head>
  <body>
  <div id = "title">
    <a href="Admin.php">
		<h2 id = "titleName">
			<img id = "titleIcon" src = "calendar-icon.png"  alt="icon"> Holmen High School Robotics Club 
		</h2>
    </a>
    <input id = "log" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
    <input id = "changePassword" class="button"  type="button" onClick="location.href='changePassword.php'" value="Change password">
  </div>      
  <div id="label">
    <input id = "modifyHours" class="labelButton"  type="button" onClick="location.href='modifyStudentHours.html'" value="Modify student WorkHours ">
    <input id = "addevent" class="labelButton"  type="button" onClick="location.href='forms/newEvent.php'" value="Add event">
	<input id = "modifyevent" class="labelButton"  type="button" onClick="location.href='modifyEvent.php'" value="Modify event">
    <input id = "modifyuser" class="labelButton"  type="button" onClick="location.href='modifyUser.php'" value="Modify user">
    <input id = "modifyItems" class="labelButton"  type="button" onClick="location.href='modifyItems.html'" value="Modify donation items">
    <input id = "seeMessage" class="labelButton"  type="button" onClick="location.href='seeMessage.html'" value="See message">
  </div>
  <div id='calendar' style="background:white; position:relative; top: 10px; width:75%; display:inline-block;"></div>
  </body>
</html>
