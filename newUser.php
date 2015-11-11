<?php
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
	$success=''; // Variable to hold reporting of success or failure of mySQL insert.
?>
<!doctype html>
<html>
  <head>
  	<meta charset="utf-8">
    <title>Add New User</title>
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
		<input id = "addevent" class="labelButton" type="button" onClick="location.href='addEvent.html'" value="Add event">
		<input id = "modifyuser" class="labelButton" type="button" onClick="location.href='modifyUser.php'" value="Modify user">
		<input id = "modifyItems" class="labelButton" type="button" onClick="location.href='modifyItems.html'" value="Modify donation items">
		<input id = "seeMessage" class="labelButton" type="button" onClick="location.href='seeMessage.html'" value="See message">
		<input id = "adminHome" class="labelButton" type="button" onClick="location.href='Admin.php'" value="Admin Home">
	  </div>
	  <div>
		<table>
			<tr>
				<td>
				// auth
					<h3 style="display:inline">First Name:
						<input id="first" name="fist" type="text">
					</h3>
				</td>
				<td>
					<h3 style="display:inline">Last Name:
						<input id="last" name="last" type="text">
					</h3>
				</td>
			</tr>
			<tr>
				<td>
					<h3 style="display:inline">Username:
						<input id="name" name="username" type="text">
					</h3>
				</td>
				<td>
					<h3 style="display:inline">Password:
						<input id="password" name="password" type="text">
					</h3>
				</td>
			</tr>
			<tr>
				<td>
					<h3 style="display: inline">User Type:
						<select name="type">
							<option value="">Select...</option>
							<option value="A">Admin</option>
							<option value="V">Volunteer</option>
							<option value="S">Student</option>
						</select>
					</h3>
				</td>
			</tr>
			<tr>
				<td align="center">
					<input id="addUser" name="submit" type="submit" value="Add User">
				</td>
			</tr>
		</table>
	  
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
			$first = $_POST['first'];
			$last = $_POST['last'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$auth = $_POST['type'];
			echo "<div>User details: $first , $last , $username , $password , $auth</div>";
			//if(mysqli_query($connection, "UPDATE users SET auth ='$type' where username='$user'")){
				//$success = "Successfully updated user: \"$user\"";
			//}
			//else {
				//$success = 'Update failed.';
			//}
		}
		mysql_close($connection); // Closing Connection;
		?>
		<div style="position: absolute; top: 350px; left: 500px;"><?php echo $success; ?></div>
	  </div>
  </body>
</html>