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
<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
    <title>Admin | Holmen Robotics</title>
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
<<<<<<< HEAD
	<script src="jquery.confirm/jquery.confirm.js"></script>
	<?php include ('adminCal.php'); ?>
=======
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
								
								// Create connection
								$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
								// Check connection
								if (mysqli_connect_errno($connection)) {
									echo "<div>";
									echo "Failed to connect to MySQL: " . mysqli_connect_error();
									echo "</div>";
								}
								
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
>>>>>>> origin/backend-stuff
  </head>
  <body>
  <div id = "title">
    <a href="Admin.php">
		<h2 id = "titleName">
			<img id = "titleIcon" src = "img/bot2.jpg"  alt="icon"> Holmen High School Robotics Club 
		</h2>
    </a>
    <input id = "log" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
    <input id = "changePassword" class="button"  type="button" onClick="location.href='changePassword.php'" value="Change password">
  </div>      
  <div id="label">
	<input id = "help" class="labelButton"  type="button" onClick="location.href='help.html'" value="Help">
  	<input id = "searchData" class="labelButton"  type="button" onClick="location.href='SearchData.php'" value="Search for Events">
    <input id = "addEvent" class="labelButton"  type="button" onClick="location.href='newEvent.php'" value="Add event">
	<input id = "modifyEvent" class="labelButton"  type="button" onClick="location.href='modifyEvent.php'" value="Modify event">
    <input id = "modifyUser" class="labelButton"  type="button" onClick="location.href='modifyUser.php'" value="Modify user">
  </div>
  <div id="body" style="margin: 0 5px 5px 5px;">
	<div id='calendar' style="background:white; position:relative; top: 10px; width:75%; display:inline-block;"></div>
  </div>
  </body>
</html>
