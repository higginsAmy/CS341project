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
case "V":
	header("location: Volunteer.php"); // Redirecting To Volunteer Page
	break;			
}
$userid = htmlspecialchars($_GET["userid"]);
?>

<html>
	<head>
		<title>Change Username</title>
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
		<input id="log" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
		<input id="changePassword" class="button"  type="button" onClick="location.href='changePassword.php'" value="Change password">
		</div>
		<div id="label">
			<input id = "help" class="labelButton"  type="button" onClick="location.href='help.html'" value="Help">
			<input id = "searchData" class="labelButton"  type="button" onClick="location.href='SearchData.php'" value="Search for Events">
			<input id = "addEvent" class="labelButton"  type="button" onClick="location.href='newEvent.php'" value="Add event">
			<input id = "modifyEvent" class="labelButton"  type="button" onClick="location.href='modifyEvent.php'" value="Modify event">
			<input id = "modifyUser" class="labelButton"  type="button" onClick="location.href='modifyUser.php'" value="Modify user">
		</div>
		<div id="main_body">&nbsp;
			<div id="form_container" style="height: 250px;">
				<h2>&nbsp;<a style="width: 637px">Change Username</a></h2>
				<form class="appnitro" method="post" action="">
					<div class="form_description">
						Fill in the new username
					</div>
					<ul style="width: 103%;">
						<li style="left: 0px; top: -3px; width: 45%; height: 65px">
							<label class="description">New Username: </label>
							<div>
								<input name="newUsername"  class="element text medium" type="text" maxlength="255" value="" required/>
							</div>
						</li>
						
						<li style="left: 342px; top: -73px; width: 41%; height: 65px">
							<label class="description">New Username confirm:</label>
							<div>
								<input name="newUsernameConfirm" class="element text medium" type="text" maxlength="255" value="" required/>
							</div>
						</li>
						<li class="buttons" style="left: 4px; top: -100px">
							<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
						</li>
					</ul>
					<div id="message">
						<?php if(isset($message)){ echo $message; } ?>
					</div>
				</form>
			</div>
			<img id="bottom" src="forms/bottom.png" alt="">
		</div>
	</body>
</html>

<?php
if (isset($_POST['submit'])) {
	$newUsername=$_POST['newUsername'];
	$newUsernameConfirm=$_POST['newUsernameConfirm'];
	// Create connection
	$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
	// Check connection
	if (mysqli_connect_errno($connection)) {
		echo "<div>";
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		echo "</div>";
	}
	// SQL query to fetch information of registered users and finds user match.
	$result = mysqli_query($connection, "select * from users where id=$userid");
	if ($result) {
		if($newUsername == $newUsernameConfirm){
			if(mysqli_query($connection,"UPDATE users SET username='$newUsernameConfirm' WHERE id=$userid")){
				echo ("<script>$.confirm({
							'title'		: '',
							'message'	: '<div align=\"center\">Changed username successfully.</div>',
							'buttons'	: {
								'OK'	: {
											'class'	: 'blue',
										}
									},
						});</script>");
				echo "<script> window.location.replace('modifyUser.php') </script>";
				
			}else{
				echo ("<script>$.confirm({
							'title'		: '',
							'message'	: '<div align=\"center\">New username has been taken.</div>',
							'buttons'	: {
								'OK'	: {
											'class'	: 'blue',
										}
									},
						});</script>");
			}
		}else{
			echo ("<script>$.confirm({
							'title'		: '',
							'message'	: '<div align=\"center\">Usernames are not consistent.</div>',
							'buttons'	: {
								'OK'	: {
											'class'	: 'blue',
										}
									},
						});</script>");
		}
	}
mysqli_close($connection); // Closing Connection
}
?>