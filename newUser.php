<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

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
		<title>Add New User</title>
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
		<div id="main_body">&nbsp;
			<div id="form_container" style="height: 400px;">
				<h2>&nbsp;<a style="width: 637px">Create new user</a></h2>
				<form class="appnitro" method="post" action="">
					<div class="form_description">
					</div>
					<ul style="width: 103%;">
						<li style="left: 0px; top: -3px; width: 45%; height: 65px">
							<label class="description">First Name </label>
							<div>
								<input id="first" name="first" class="element text medium" type="text" maxlength="255" value="" required/>
							</div>
						</li>
			
						<li style="left: 342px; top: -74px; width: 41%; height: 65px" >
							<label class="description">Last Name </label>
							<div>
								<input id="last" name="last" class="element text medium" type="text" maxlength="255" value="" required/>
							</div>
						</li>

						<li style="left: 4px; top: -48px; width: 44%; height: 65px">
							<label class="description">Email </label>
							<div>
								<input id="email" name="email" class="element text medium" type="email" maxlength="255" value="" required/>
							</div>
						</li>

						<li style="left: 343px; top: -119px; width: 42%; height: 65px">
							<label class="description">Username </label>
							<div>
								<input id="name" name="username" class="element text" maxlength="255" value="" type="text" required/>
							</div>
						</li>
						
						<li style="left: 4px; top: -107px; width: 42%; height: 65px">
							<label class="description">Password </label>
							<div>
								<input id="password" name="password" class="element text " type="text" maxlength="255" value="" required/> 
							</div>
						</li>

						<li style="left: 343px; top: -176px; width: 42%; height: 65px">
							<label class="description">User Type </label>
							<div>
								<select name="type">
									<option value="">Select...</option>
									<option value="A">Admin</option>
									<option value="V">Volunteer</option>
									<option value="S">Student</option>
								</select>
							</div>
						</li>
						
						<li class="buttons" style="left: 4px; top: -165px">
							<input id="addUser" class="button_text" type="submit" name="submit" value="Add User" />
						</li>
					</ul>
				</form>
			</div>
		</div>
	</body>
</html>

<?php 
// Create connection
$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
// Check connection
if (mysqli_connect_errno($connection)) {
	echo "<div>";
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	echo "</div>";
}
// Logic that handles submission of the form
if (isset($_POST['submit'])) {
	if (empty($_POST['type'])){
		echo "<div>Please fill out all fields to create new user.</div>";
	}
	else{
		$first = $_POST['first'];
		$last = $_POST['last'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$auth = $_POST['type'];
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$query = "INSERT INTO users (first, last, email, username, password, auth) VALUES "
			."('$first', '$last', '$email', '$username', '$hash', '$auth')";
		if(mysqli_query($connection, $query)){
			echo ("<script>$.confirm({
					'title'		: '',
					'message'	: '<div align=\"center\">User created successfully.</div>',
					'buttons'	: {
						'OK'	: {
									'class'	: 'blue',
								}
							},
					});</script>");
			echo "<script> window.location.replace('modifyUser.php') </script>";
		}
		else {
			echo ("<script>$.confirm({
					'title'		: '',
					'message'	: '<div align=\"center\">User not created.</div>',
					'buttons'	: {
						'OK'	: {
									'class'	: 'blue',
								}
							},
					});</script>");
		}
	}
}
mysqli_close($connection); // Closing Connection;
?>