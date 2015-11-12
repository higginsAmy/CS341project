<!doctype html>
<html>
  <head>
  	<meta charset="utf-8">
    <title>You are viewing this page as a guest</title>
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
						events:  [
   							<?php 
								// Create connection
								$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
        						$query = mysqli_query($connection, "SELECT * FROM events");
									while ($event = mysqli_fetch_assoc($query)) {
									
            						$title = $event["title"];
									
									$start = $event["startDateTime"];
									
									$end = $event["endDateTime"];
									
									//$MinVols = $event["MinVols"];
									
									//$MaxVols = $event["MaxVols"];
									
									//$MinStud = $event["MinStud"];
									
									//$MaxStud = $event["MaxStud"];
									
									//$Desc = $event["Desc"];
								
									
									echo "{";

            						echo "title : '$title',";
									
									echo "start : '$start',";
									
									echo "end : '$endDateTime',";
									
									//echo "StartDate: '$EndDate'";
									
									//echo "EndDate: '$EndDate'";
									
									//echo "MinVols: '$MinVols'";
									
									//echo "MaxVols: '$MaxVols'";
									
									//echo "MinStud: '$MinStud'";
									
									//echo "MaxStud: '$MaxStud'";
									
									//echo "Desc : '$Desc'";
									
									
									echo "},";
        						}
    						?>
						]
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
            <a href="Guest.html">
            <h2 id = "titleName"> 
                <img id = "titleIcon" src = "calendar-icon.png"  alt="icon"> Holmen High School Robotics Club 
            </h2>
            </a>
			<input id = "log" class="button" type="button" onClick="location.href='loginPage.php'" value="Log in">
            <input id = "forgetPassword" class="button"  type="button" onClick="location.href='forgetPassword.html'" value="Forgot your password?">
        </div>
        
        <div id="label">
            <input id = "contact" class="labelButton"  type="button" onClick="location.href='contact.html'" value="Contact">
            <input id = "donate" class="labelButton"  type="button" onClick="location.href='donate.html'" value="Donate">
        </div>
		<div id='calendar' style="background:white; position:relative; top: 10px; width:75%; display:inline-block;"></div>
    </body>
</html>
