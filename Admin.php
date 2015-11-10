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
?>
<!doctype html>
<html>
  <head>
  	<meta charset="utf-8">
    <title>You are logged as admin.</title>
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
        		eventSources: [
				// your event source
					{
						var events:  [
   							 <?php
        						$query = mysql_query("SELECT * FROM Event");
        						while ($event = mysql_fetch_assoc($query)) {
									
            						$title = $event["Title"];
									
									$StartTime = $event["StartTime"];
									
									$EndTime = $event["EndTime"];
									
									$StartDate = $event["StartDate"];
									
									$EndDate = $event["EndDate"];
									
									$MinVols = $event["MinVols"];
									
									$MaxVols = $event["MaxVols"];
									
									$MinStud = $event["MinStud"];
									
									$MaxStud = $event["MaxStud"];
									
									$Desc = $event["Desc"];
								
									
									echo "{";
									
            						echo "title : '$title'";
									
									echo "StartTime : '$StartTime'";
									
									echo "EndTime : '$EndTime'";
									
									echo "StartDate: '$EndDate'";
									
									echo "EndDate: '$EndDate'";
									
									echo "MinVols: '$MinVols'";
									
									echo "MaxVols: '$MaxVols'";
									
									echo "MinStud: '$MinStud'";
									
									echo "MaxStud: '$MaxStud'";
									
									echo "Desc : '$Desc'";
									
									
									echo "},";
        						}
    						?>
						];
						,
						color: 'blue',     // an option!
						textColor: 'white' // an option!
					}
					// any other event sources...

				]
    		})
		});
	</script>
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
    <input id = "ModifykHours" class="labelButton"  type="button" onClick="location.href='modifyStudentHours.html'" value="Modify student WorkHours ">
    <input id = "addevent" class="labelButton"  type="button" onClick="location.href='addEvent.html'" value="Add event">
    <input id = "modifyuser" class="labelButton"  type="button" onClick="location.href='modifyUser.php'" value="Modify user">
    <input id = "modifyItems" class="labelButton"  type="button" onClick="location.href='modifyItems.html'" value="Modify donation items">
    <input id = "seeMessage" class="labelButton"  type="button" onClick="location.href='seeMessage.html'" value="See message">
  </div>
  <div id='calendar' style="background:white; position:relative; top: 10px; width:75%; display:inline-block;"></div>
  </body>
</html>
