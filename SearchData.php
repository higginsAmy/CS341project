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
		<meta name="description" content="Event search admin page for the Holmen High School Robotics Team">
		<meta name="author" content="Adam Geipel, Amy Higgins, Changsong Li">
		<title>Search Events | Holmen Robotics</title>
		<!-- Styles -->
		<link rel="stylesheet" type="text/css" href="normalize.css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="theme.css" />
		<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Cuprum&amp;subset=latin' />
		<link rel="stylesheet" type="text/css" href="forms/view.css" media="all" />
		<link rel="stylesheet" type="text/css" href="jquery.confirm/jquery.confirm.css" />
		<link rel="Stylesheet" href="Dropit-1.1.1/dropit.css" type="text/css" />
		<!-- Scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="forms/view.js"></script>
		<script src="jquery.confirm/jquery.confirm.js"></script>
		<script src="Dropit-1.1.1/dropit.js"></script>
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
	  
		<div id="main_body">
			<div id="form_container">
				<h2>&nbsp;<a style="width: 637px">Search Events</a></h2>
				<form class="appnitro" method="post" action="">
					<div class="form_description">
						Search events based on one or all search criteria below.
					</div>
					<ul style="width: 103%;">
						<li style="left: 0px; top: -3px; width: 100%; height: 65px">
							<span>
								<input type="radio" name="searchType" value="user" checked>Search by username
								&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="searchType" value="date">Search by date
								&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="searchType" value="both">Search by both
							</span>
						<li style="left: 0px; top: -36px; width: 45%; height: 65px">
							<label class="description">Search by user </label>
							<div>
								<select name="user">
									<option value=-1></option>
									<?php
									// Create connection
									$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
									// Check connection
									if (mysqli_connect_errno($connection)) {
										echo "<div>";
										echo "Failed to connect to MySQL: " . mysqli_connect_error();
										echo "</div>";
									}
									$query = "SELECT DISTINCT id, first, last FROM users WHERE id IN (SELECT creator from events)";
									$result=mysqli_query($connection, $query);
									
									while($row = mysqli_fetch_assoc($result)) {
										$first = $row['first'];
										$last = $row['last'];
										$userid = $row['id'];
										echo "<option value=$userid>".$first. " " .$last."</option>";
									}
									?>
								</select>
							</div>
						</li>
						
						<li style="left: 342px; top: -107px; width: 41%; height: 65px">
							<label class="description">Search by date </label>
							<span>
								<input id="SMonth" name="SMonth" class="element text" size="3" maxlength="2" value="" type="text" /> /
								<label for="SMonth">MM</label>
							</span>
							<span>
								<input id="SDay" name="SDay" class="element text" size="3" maxlength="2" value="" type="text" /> /
								<label for="SDay">DD</label>
						</span>
							<span>
								<input id="SYear" name="SYear" class="element text" size="5" maxlength="4" value="" type="text" />
								<label for="SYear">YYYY</label>
							</span>
						</li>
						<li class="buttons" style="left: 4px; top: -100px">
							<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
						</li>
					</ul>	  
				</form>	  
			</div>
			<img id="bottom" src="forms/bottom.png" alt="">
		</div>
	</body>
</html>

<?php
if (isset($_POST['submit'])) {
	$byUser=$_POST['user'];
	$searchType=$_POST['searchType'];
	$user=$_POST['user'];
	$month=$_POST['SMonth'];
	$day=$_POST['SDay'];
	$year=$_POST['SYear'];
	
	if ($searchType == "user" && $user != -1){
		$sql = "SELECT * FROM events WHERE creator = $byUser AND removed != 1";
	}
	else if ($searchType == "date" && $month && $day && $year){
		$sql = "SELECT * FROM events WHERE startDateTime LIKE '".$year."-".$month."-".$day."%' AND removed != 1";
	}
	else if ($searchType == "both" && $user != -1 && $month && $day && $year){
		$sql = "SELECT * FROM events WHERE creator = $byUser AND startDateTime LIKE '$year-$month-$day%' AND removed != 1";
	}
	else {
		echo ("<script>$.confirm({
				'title'		: '',
				'message'	: '<div align=\"center\">Incomplete search criteria</div>',
				'buttons'	: {
					'OK'	: {
								'class'	: 'blue',
							}
						},
				});</script>");			
	}
	if ($sql){	
		//echo "<div style='position: absolute; top: 300px; left: 200px;'>".$sql."</div>";
		$result = mysqli_query($connection, $sql);
		if (mysqli_num_rows($result)) {
			echo '<div style="position: relative; left: 25%; top: 0px; display: inline-block; float: left;"><label class="description">Event Title</label></div>
				<div style="position: relative; left: 28%; float: left; display: inline-block;"><label class="description"># Students</label></div>
				<div style="position: relative; left: 31%; float: left; display: inline-block;"><label class="description"># Volunteers</label></div>
				<div style="position: relative; left: 36%; float: left; display: inline-block;"><label class="description">Starts</label></div>
				<div style="position: relative; left: 41%; float: left; display: inline-block;"><label class="description">Ends</label></div>
				<div style="position: relative; left: 46%; float: left; display: inline-block;"><label class="description">Delete</label></div>
				<div style="position: relative; left: 52%; float: left; display: inline-block;"><label class="description">Modify</label></div>
				<table style="position: relative; top: 10px; left: -12%;" cellpadding="25">';
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row['eventId'];
				$numStudents = 0;
				$numVolunteers = 0;
				
				// Fetch count of students who are signed up for this event
				if (!$result2 = mysqli_query($connection, "SELECT * FROM eventParticipation WHERE eventId=$id AND type='S'")){
					echo "<div>Database error finding student count</div>";
				}
				else {
					$numStudents = mysqli_num_rows($result2);
				}
				
				// Fetch count of volunteers who are signed up to help for this event
				if (!$result2 = mysqli_query($connection, "SELECT * FROM eventParticipation WHERE eventId=$id AND type='V'")){
					echo "<div>Database error finding volunteer count</div>";
				}
				else {
					$numVolunteers = mysqli_num_rows($result2);
				}
				echo '<tr><form class="appnitro" method="post" action=""><input type="hidden" name="event" value="'
					.$row["eventId"].'"><td width="180px">'.$row["title"].'</td><td width="60px">'.$numStudents.'</td><td width="60px">'
					.$numVolunteers.'</td><td width="90px">'.$row["startDateTime"].'</td><td width="90px">'
					.$row["endDateTime"].'</td><td width="60px"><input id="delete" class="button_text" type="submit" name="delete" 
					value="Delete"></td></form><td width="60px"><input onClick="location.href=\'eventPage.php?event='
					.$id.'\'" id="signup2" class="button_text" type="submit" name="EditSubmit"
					value="Edit"></td></tr>';	
			}
			echo "</table>";
		}
		else {
			echo "<div>No results.</div>";
		}
	}
}

// Logic that handles pressing the "Delete" button
if (isset($_POST['delete'])) {
	$event = $_POST['event'];
	// SQL query to fetch information from target user.
	$result = mysqli_query($connection, "select * from events where eventId=$event");
	if (mysqli_num_rows($result)) {
		if(mysqli_query($connection, "Update events SET removed=1 WHERE eventID=$event")){
			echo '<meta http-equiv="refresh" content="0">';
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