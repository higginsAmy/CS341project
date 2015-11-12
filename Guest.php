<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>
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
									$MinVols = $event["MinVols"];
									$MaxVols = $event["MaxVols"];
									$MinStud = $event["MinStud"];
									$MaxStud = $event["MaxStud"];
									$Desc = $event["Desc"];

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
		
		function redirect(){
				var redirect = new String(window.location.href);
				redirect = redirect.replace("Guest.html", "Login.html");
				window.location.assign(redirect);
		}
	</script>
  </head>
  <body>
    <div id="container"> 
    	<div id="title">
      		<h1 id="titleName">
      		<img id = "icon"src="http://icons.iconarchive.com/icons/paomedia/small-n-flat/1024/calendar-icon.png">
      		<b>Holmen High School Robotics Club</b>
      		</h1>
    	</div>
		<div id='calendar' style="background:white; width:90%; display:inline-block;"></div>
      	<button id="login" class="button" type="button" onclick="redirect()"><b>Log in</b></button>
      	<button id="donate" class="button" type="button"><b>Donate</b></button>
      	<button id="contact" class="button" type="button"><b>Contact</b></button>
    </div>
  </body>
</html>
