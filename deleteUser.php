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
	$success=''; // Variable to hold reporting of success or failure of mySQL update.
?>
<!doctype html>
<html>
  <head>
  	<meta charset="utf-8">
    <title>Change Authorization</title>
 	<!-- Styles --> 
    <link rel="stylesheet" type="text/css" href="theme.css">
	<link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
	<!-- Scripts -->
	<script src='fullcalendar/lib/jquery.min.js'></script>
	<script src='fullcalendar/lib/moment.min.js'></script>
	<script src='fullcalendar/fullcalendar.js'></script>
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
		<input id = "ModifykHours" class="labelButton" type="button" onClick="location.href='modifyStudentHours.html'" value="Modify student WorkHours ">
		<input id = "addevent" class="labelButton" type="button" onClick="location.href='newEvent.php'" value="Add event">
		<input id = "modifyuser" class="labelButton" type="button" onClick="location.href='modifyUser.php'" value="Modify user">
		<input id = "modifyItems" class="labelButton" type="button" onClick="location.href='modifyItems.html'" value="Modify donation items">
		<input id = "seeMessage" class="labelButton" type="button" onClick="location.href='seeMessage.html'" value="See message">
		<input id = "adminHome" class="labelButton" type="button" onClick="location.href='Admin.php'" value="Admin Home">
	  </div>
	  <div>
		<?php 
		// Fetch username from GET variable
		$user = htmlspecialchars($_GET["username"]);
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
			echo '<form action="" method="post"><div id="body" align="center"><p></p>'
				."<h3 style='display:inline'>Are you sure you want to delete $user? "
				.'</h3><input id="delete" name="submit" type="submit" value="Delete User">'
				.'</div></form>';
		}
		else {
			echo "Zero results.";
		}
		// Logic that handles submission of the form
		if (isset($_POST['submit'])) {
			if(mysqli_query($connection, "DELETE FROM users WHERE username='$user'")){
				$success = "Successfully updated user: \"$user\"";
			}
			else {
				$success = 'Update failed.';
			}
		}
		mysql_close($connection); // Closing Connection;
		?>
		<div style="position: absolute; top: 350px; left: 500px;"><?php echo $success; ?></div>
	  </div>
  </body>
</html>