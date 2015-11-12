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
    <title>Student sign up for an Event</title>
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
		<input id = "log" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
		<input id = "changePassword" class="button"  type="button" onClick="location.href='changePassword.html'" value="Change password">
	  </div>      
	  <div id="label">
		
		<input id = "StudentHome" class="labelButton" type="button" onClick="location.href='Student.php'" value="Student Home">
	  </div>
	  <div>
		<?php 
		// Create connection
		$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
		// Check connection
		if (mysqli_connect_errno($connection)) {
			echo "<div>";
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			echo "</div>";
		}
		// SQL query to fetch information of registerd users and finds user match.
		$user = $_SESSION['login_user'];
		$result = mysqli_query($connection, "select * from events");
		if ($result) {
			echo '<table align="center" cellpadding="25"><tr><th>Title</th><th>Starts</th><th>Ends</th>'
				.'<th>Sign up</th>';
			// output data of each row  
			while($row = mysqli_fetch_assoc($result)) {
				$eventsAttended = mysqli_query($connection, "select * from eventparticipation where user = '$user'");
				$check = true;
				while ($signedUp = mysqli_fetch_assoc($eventsAttended)){
					if($signedUp["eventId"] == $row["eventId"]){
						$check = false;
					}
				}
				if ($check){
					echo '<tr><form action="" method="post"><input type="hidden" name="event" value="'.$row["eventId"].'"><td>'.$row["title"]."</td><td>".$row["startDateTime"]."</td><td>"
					.$row["endDateTime"]."</td>".'<td><input id="signup" class="button" type="submit" name="submit" value="Sign Up"></td></tr></form>';
				}
			}	
			echo "</table>";
		} else {
			echo "0 results";
		}
		if (isset($_POST['submit'])) {
			$sql = "INSERT INTO eventparticipation (eventId, user, type) VALUES(".$_POST['event'].", '$user', 'S')";
			if (mysqli_query($connection, $sql)){
				header("Refresh:0");
			}
			else {
				echo '<div style="position: absolute; top: 150; left: 100;">Signup not completed.</div>';
			}
		}
		mysql_close($connection); // Closing Connection;
		?>
	  </div>
	</div>
  </body>
</html>