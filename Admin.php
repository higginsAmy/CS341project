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
            events: [ // put the array in the `events` property
                {
                    title  : 'Lorem ipsum dolor sit amet',
                    start  : '2015-10-01'
                },
                {
                    title  : 'consectetur adipiscing elit',
                    start  : '2015-10-05',
                    end    : '2015-10-05'
                },
                {
                    title  : 'Ut faucibus pulvinar',
                    start  : '2015-10-09T12:30:00',
                }
            ],
            color: 'black',     // an option!
            textColor: 'yellow' // an option!
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
    <input id = "logOut" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
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
