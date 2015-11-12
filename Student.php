<?php
include('session.php');
if (!isset($_SESSION['login_auth'])){
	header("location: Guest.html");
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
    <title>You are logged as Student</title>
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
                               // figure out student ID to see what events they're doing
                               $user = $_SERVER['login_user'];
								// Create connection
								$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
        						$query = mysqli_query($connection, "SELECT * FROM events LEFT JOIN eventparticipation 
                                ON (events.eventID = eventparticipation.eventID)");
									while ($event = mysqli_fetch_assoc($query)) {
									
                                        $title = $event["title"];
                                        
                                        $start = $event["startDateTime"];
                                        
                                        $end = $event["endDateTime"];
                                    
                                        
                                        //$MinStud = $event["MinStud"];
                                        
                                        //$MaxStud = $event["MaxStud"];
                                        
                                        //$Desc = $event["Desc"];
                                    
                                        
                                        echo "{";
    
                                        echo "title : '$title',";
                                        
                                        echo "start : '$start',";
                                        
                                        echo "end : '$endDateTime',";
                                        
                                        //echo "StartDate: '$StartDate'";
                                        
                                        //echo "EndDate: '$EndDate'";
                                        
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
        <a href="Student.php">
        <h2 id = "titleName"> 
            <img id = "titleIcon" src = "calendar-icon.png"  alt="icon"> Holmen High School Robotics Club 
        </h2>
        </a>
        <input id = "log" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
		<input id = "changePassword" class="button"  type="button" onClick="location.href='changePassword.html'" value="Change password">
    </div>
    <div id="label">
        <input id = "clockIn" class="labelButton"  type="button" onClick="location.href='clockIn.html'" value="Clock in">            
        <input id = "viewNote" class="labelButton"  type="button" onClick="location.href='viewNote.html'" value="View Note  ">        
    </div>
    <div id='calendar' style="background:white; position:relative; top: 10px; width:75%; display:inline-block;"></div>
    </body>
</html>
