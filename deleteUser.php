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
// Fetch username from GET variable
$user = htmlspecialchars($_GET["username"]);
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Delete User <?php echo $user; ?></title>
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
		<input id = "searchData" class="labelButton"  type="button" onClick="location.href='SearchData.php'" value="Search for Events">
		<input id = "addEvent" class="labelButton" type="button" onClick="location.href='newEvent.php'" value="Add event">
		<input id = "modifyUser" class="labelButton" type="button" onClick="location.href='modifyUser.php'" value="Modify user">
	  </div>
	  <div id="main_body">&nbsp;
		<div id="form_container" style="height: 250px;">
			<h2>&nbsp;<a style="width: 637px">Delete <?php echo $user; ?></a></h2>
			<?php 
			if (!$user){
				echo "<div align='center'>No user selected for delete.</div>";
			}
			else {
				// Create connection
				$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
				// Check connection
				if (mysqli_connect_errno($connection)) {
					echo "<div>";
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
					echo "</div>";
				}
				// SQL query to fetch information from target user.
				$result = mysqli_query($connection, "select * from users where username ='$user'");
				if ($result) {
					echo '<form class="appnitro" method="post" action=""><ul style="width: 103%;">
						<li style="left: 0px; top: -3px; width: 45%; height: 65px"><label class="description">
						Are you sure you want to delete '.$user.'? </label></li>
						<li class="buttons" style="left: 4px; top: -25px"><input id="saveForm" class="button_text" type="submit" name="submit" value="Yes, Delete User" />
						</li></ul></form>';
				}
				else {
					echo "Zero results.";
				}
				// Logic that handles submission of the form
				if (isset($_POST['submit'])) {
					if(mysqli_query($connection, "DELETE FROM users WHERE username='$user'")){
						echo ("<script>$.confirm({
							'title'		: '',
							'message'	: '<div align=\"center\">User deleted successfully.</div>',
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
							'message'	: '<div align=\"center\">User not deleted.</div>',
							'buttons'	: {
								'OK'	: {
											'class'	: 'blue',
										}
									},
							});</script>");
					}
				}
				mysqli_close($connection); // Closing Connection;
			}
			?>
	  </div>
  </body>
</html>