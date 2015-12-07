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
			<input id = "SearchData" class="labelButton"  type="button" onClick="location.href='SearchData.php'" value="Search for Events">
			<input id = "addEvent" class="labelButton"  type="button" onClick="location.href='newEvent.php'" value="Add event">
			<input id = "modifyevent" class="labelButton"  type="button" onClick="location.href='modifyEvent.php'" value="Modify event">
			<input id = "modifyUser" class="labelButton"  type="button" onClick="location.href='modifyUser.php'" value="Modify user">
			<input id = "modifyItems" class="labelButton"  type="button" onClick="location.href='modifyItems.html'" value="Modify donation items">
			<input id = "seeMessage" class="labelButton"  type="button" onClick="location.href='seeMessage.html'" value="See message">
		</div>
	  
		<div id="main_body">
			<div id="form_container">
				<h2>&nbsp;<a style="width: 637px">Search Events</a></h2>
				<form class="appnitro" method="post" action="">
					<div class="form_description">
						Search events based on one or all search criteria below.
					</div>
					<ul style="width: 103%;">
						<li style="left: 0px; top: -3px; width: 45%; height: 65px">
							<label class="description">Search by user </label>
							<div>
								<select name="users">
									<option value=""></option>
									<?php
									// Create connection
									$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
									// Check connection
									if (mysqli_connect_errno($connection)) {
										echo "<div>";
										echo "Failed to connect to MySQL: " . mysqli_connect_error();
										echo "</div>";
									}
									$query2 = mysqli_query($connection, "SELECT creator from events");
									$query = "SELECT first, last, id FROM users WHERE username IN (SELECT creator from events)";
									$result=mysqli_query($connection, $query);
									
									while($row = mysqli_fetch_assoc($result)) {
										$first = $row['first'];
										$last = $row['last'];
										$userid = $row['id'];
										echo "<option value='$userid'>".$first. " " .$last."</option>";
									}
									?>
								</select>
							</div>
						</li>
						
						<li style="left: 342px; top: -73px; width: 41%; height: 65px">
							<label class="description">Search by date </label>
							<div>
								<select name="date">
									<option value=""></option>
									<?php
									// Create connection
									$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
									// Check connection
									if (mysqli_connect_errno($connection)) {
										echo "<div>";
										echo "Failed to connect to MySQL: " . mysqli_connect_error();
										echo "</div>";
									}
									$query = "SELECT startDateTime from events";
									
									$result=mysqli_query($connection, $query);
									while($row = mysqli_fetch_assoc($result)) {
										$N_datetime = $row['startDateTime'];
										$timestamp = strtotime($N_datetime);
										$N_date = date('m/d/y', $timestamp);
										
										echo('<option value="'.$N_datetime.'">'.$N_date.'</option>');
									}
									?>
								</select>
							</div>
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
	$byDate=$_POST['date'];
	
	if (!isset($_POST['user']) && !isset($_POST['date'])){
		echo ("<script>$.confirm({
				'title'		: '',
				'message'	: '<div align=\"center\">Please fill out one or both fields to search</div>',
				'buttons'	: {
					'OK'	: {
								'class'	: 'blue',
							}
						},
				});</script>");
	} else {
		if (isset($_POST['user']) && isset($_POST['date'])){
			$sql = "SELECT * FROM events WHERE creator = $byUser AND startDateTime = $byDate";
		}
		else if (isset($_POST['user'])){
			$sql = "SELECT * FROM events WHERE creator = $byUser";
		}
		else {
			$sql = "SELECT * FROM events WHERE startDateTime = $byDate";
		}
		$result = mysqli_query($connection, $sql);
	}
}
?>