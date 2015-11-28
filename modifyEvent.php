<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

include('session.php');
if (!isset($_SESSION['login_auth'])){
	header("location: Guest.php");
}
switch($_SESSION['login_auth']){
	case "S":
		header("location: Student.php"); // Redirecting To Student Page
		break;

}
$success=''; // Variable to hold reporting of success or failure of mySQL update.
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
		<div id="main_body">&nbsp;
			<div id="form_container">
				<h2>&nbsp;<a style="width: 637px">Modify An Event</a></h2>
				<div class="form_description">
					You may modify only events that you have created, 
					unless you are an administrator.  If you have not created any events, 
					none will show up here.
				</div>
				<?php 
				// Fetch username from session
				$user = $_SESSION['login_user'];
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
				if ($type == 'A'){
					$query = "select * from events where removed !=1 GROUP BY startDateTime";
				}
				else {
					$query = "select * from events where creator='$user' and removed!=1 GROUP BY startDateTime";
				}
				$result = mysqli_query($connection, $query);
				if (mysqli_num_rows($result)) {
					echo '<div style="position: relative; left: 10px; top: 0px; width: 20%; display: inline-block; float: left;"><label class="description">Event Title</label></div>
						<div style="float: left; width: 12%; display: inline-block;"><label class="description"># Students</label></div>
						<div style="float: left; width: 15%; display: inline-block;"><label class="description"># Volunteers</label></div>
						<div style="float: left; width: 18%; display: inline-block;"><label class="description">Starts</label></div>
						<div style="float: left; width: 20%; display: inline-block;"><label class="description">Ends</label></div>
						<div style="float: left; width: 15%; display: inline-block;"><label class="description">Delete</label></div>
						<table align="center" cellpadding="25">';
					// output data of each row
					while($row = mysqli_fetch_assoc($result)) {
						$id = $row['eventId'];
						$numStudents = 0;
						$numVolunteers = 0;
						if (!$result2 = mysqli_query($connection, "SELECT * FROM eventParticipation WHERE eventId=$id AND type='S'")){
							echo "<div>Database error finding student count</div>";
						}
						else {
							$numStudents = mysqli_num_rows($result2);
						}
						if (!$result2 = mysqli_query($connection, "SELECT * FROM eventParticipation WHERE eventId=$id AND type='V'")){
							echo "<div>Database error finding volunteer count</div>";
						}
						else {
							$numVolunteers = mysqli_num_rows($result2);
						}
						echo '<tr><form class="appnitro" method="post" action=""><input type="hidden" name="event" value="'
							.$row["eventId"].'"><td>'.$row["title"]."</td><td>".$numStudents."</td><td>".$numVolunteers
							."</td><td>".$row["startDateTime"]."</td><td>"
							.$row["endDateTime"].'</td><td><input id="signup" class="button_text" type="submit" name="submit" 
							value="Delete Event"></td></form></tr>';	
					}
					echo "</table>";
				}
				else {
					echo "Zero results.";
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
	$event = $_POST['event'];
	// SQL query to fetch information from target user.
	$result = mysqli_query($connection, "select * from events where eventId=$event");
	if (mysqli_num_rows($result)) {
		if(mysqli_query($connection, "Update events SET removed=1 WHERE eventID=$event")){
			echo ("<script>$.confirm({
				'title'		: '',
				'message'	: '<div align=\"center\">Successfully updated event</div>',
				'buttons'	: {
						'OK'	: {
									'class'	: 'blue',
								}
							},
				});</script>");
		}
		else {
			echo ("<script>$.confirm({
				'title'		: '',
				'message'	: '<div align=\"center\">Event update failed</div>',
				'buttons'	: {
						'OK'	: {
									'class'	: 'blue',
								}
							},
				});</script>");
			echo '<meta http-equiv="refresh" content="0">';
		}
	}
}
mysqli_close($connection); // Closing Connection;
?>