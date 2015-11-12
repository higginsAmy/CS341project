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
		<input id = "addevent" class="labelButton" type="button" onClick="location.href='forms/newEvent.php'" value="Add event">
		<input id = "modifyuser" class="labelButton" type="button" onClick="location.href='modifyUser.php'" value="Modify user">
		<input id = "modifyItems" class="labelButton" type="button" onClick="location.href='modifyItems.html'" value="Modify donation items">
		<input id = "seeMessage" class="labelButton" type="button" onClick="location.href='seeMessage.html'" value="See message">
		<input id = "adminHome" class="labelButton" type="button" onClick="location.href='Admin.php'" value="Admin Home">
	  </div>
	  <div id="body" align="center">
		<p></p>
		<form action="" method="post">
			<table cellspacing="50">
				<tr>
					<td>
						<h3 style="display:inline">First Name:
							<input id="first" name="first" type="text">
						</h3>
					</td>
					<td>
						<h3 style="display:inline">Last Name:
							<input id="last" name="last" type="text">
						</h3>
					</td>
					<td>
						<h3 style="display:inline">Email:
							<input id="email" name="email" type="email">
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
		</form>
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
			if (empty($_POST['first']) || empty($_POST['last']) || empty($_POST['email']) || 
				empty($_POST['username']) || empty($_POST['password']) || empty($_POST['type'])){
				echo "<div>Please fill out all fields to create new user.</div>";
			}
			else{
				$first = $_POST['first'];
				$last = $_POST['last'];
				$email = $_POST['email'];
				$username = $_POST['username'];
				$password = $_POST['password'];
				$auth = $_POST['type'];
				$query = "INSERT INTO users (first, last, email, username, password, auth) VALUES "
					."('$first', '$last', '$email', '$username', '$password', '$auth')";
				if(mysqli_query($connection, $query)){
					$success = "Successfully added user: \"$username\"";
				}
				else {
					$success = "Failed to add $username to the database.";
				}
			}
		}
		mysql_close($connection); // Closing Connection;
		?>
		<div style="position: absolute; top: 350px; left: 500px;"><?php echo $success; ?></div>
	</div>
  </body>
</html>