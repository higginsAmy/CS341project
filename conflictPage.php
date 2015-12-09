<?php
//error_reporting(-1);
//ini_set('display_errors', 'On');
//set_error_handler("var_dump");

include('session.php');
if (!isset($_SESSION['login_auth'])){
	header("location: Guest.php");
}
switch($_SESSION['login_auth']){
	case "A":
		header("location: admin.php"); // Redirecting To Student Page
		break;

}
$success='';
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Modify Event</title>
		<!-- Styles -->
		<link rel="stylesheet" type="text/css" href="normalize.css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="theme.css" />
		<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Cuprum&amp;subset=latin' />
		<link rel="stylesheet" type="text/css" href="forms/view.css" media="all">
		<link rel="stylesheet" type="text/css" href="jquery.confirm/jquery.confirm.css" />
		<!-- Scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="forms/view.js"></script>
		<script src="jquery.confirm/jquery.confirm.js"></script>

	</head>
	<body>
		<div id = "title">
			<a href="Volunteer.php">
				<h2 id = "titleName">
					<img id = "titleIcon" src = "img/bot2.jpg"  alt="icon"> Holmen High School Robotics Club
				</h2>
			</a>
			<input id = "log" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
			<input id = "changePassword" class="button"  type="button" onClick="location.href='changePassword.php'" value="Change password">
		</div>
		<div id="label">
			<input id = "help" class="labelButton"  type="button" onClick="location.href='help.html'" value="Help">
		</div>
		<div id="main_body">&nbsp;
			<div id="form_container">
				<h2>&nbsp;<a style="width: 637px">Delete Conflict Event</a></h2>
				<div class="form_description">
					You only can see the events are conflicted.
				</div>
				<?php
				// Fetch username from session
				$userid = $_SESSION['login_id'];
				$type = $_SESSION['login_auth'];
				// Create connection
				$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
				// Check connection
				if (mysqli_connect_errno($connection)) {
					echo "<div>";
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
					echo "</div>";
				}

				// SQL query to fetch events created by user

			  $eventsAttended = mysqli_query($connection, "SELECT * FROM eventParticipation WHERE userId = $userid");
        echo '<div style="position: relative; left: 80px; top: 0px; width: 35%; display: inline-block; float: left;"><label class="description">Event Title</label></div>
          <div style="float: left; width: 18%; display: inline-block;"><label class="description">Starts</label></div>
          <div style="float: left; width: 20%; display: inline-block;"><label class="description">Ends</label></div>
          <div style="float: left; width: 15%; display: inline-block;"><label class="description">Delete</label></div>
          <table align="center" cellpadding="25">';

          $rowsNumber = $eventsAttended->num_rows;
        if($rowsNumber>=2){
        		while($rows = $eventsAttended->fetch_object()){
        			$theEvent = mysqli_query($connection, "select * from events WHERE eventId = $rows->eventId");
        			$theRow = $theEvent->fetch_object();
        			$end = $theRow->endDateTime;
        			$start = $theRow->startDateTime;
        			$arrStartTime[]=$start;
        			$arrEndTime[]=$end;
              $arrEventID[]=$theRow->eventId;
              $arrEventName[]=$theRow->title;
              $print[] = false;
        		}
        		$conflictNumber = 1;
        		for($i = 0; $i < $rowsNumber-1; $i++){
        			$thisStart = $arrStartTime[$i];
        			$thisEnd = $arrEndTime[$i];
        			for($j = $i+1; $j < $rowsNumber; $j++){
        				$CompareStart = $arrStartTime[$j];
        				$CompareEnd = $arrEndTime[$j];
        				if($thisStart <= $CompareEnd && $thisEnd >= $CompareStart){
                  $print[$i] = true;
                  $print[$j] = true;
        				}
        			}
        		}

            for($i = 0; $i < $rowsNumber; $i++){
              if($print[$i]){
                echo '<tr><form class="appnitro" method="post" action=""><input type="hidden" name="event" value="'
                  .$arrEventID[$i].'"><td>'.$arrEventName[$i]."</td><td>".$arrStartTime[$i]."</td><td>"
                  .$arrEndTime[$i].'</td><td><input id="delete" class="button_text" type="submit" name="submit"
                  value="Delete Event"></td></tr>';
              }
            }

              echo "</table>";
        }

				?>
			</div>
			<img id="bottom" src="forms/bottom.png" alt="">
			<div style="position: absolute; top: 350px; left: 500px;"><?php echo $success; ?></div>
		</div>
	</body>
</html>

<?php
// Logic that handles submission of the form
if (isset($_POST['submit'])) {
  $connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
	$event = $_POST['event'];
  echo("<script>console.log('EventId: ".$event."');</script>");
  echo("<script>console.log('userId: ".$userid."');</script>");
	// SQL query to fetch information from target user.
	$result = mysqli_query($connection, "DELETE from eventparticipation where eventId=$event and userId =$userid");
  echo "<script> window.location.replace('student.php') </script>";
}
mysqli_close($connection); // Closing Connection;
?>
