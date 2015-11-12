<?php
include('../session.php');
if (!isset($_SESSION['login_auth'])){
	header("location: ../Guest.php");
}
switch($_SESSION['login_auth']){
case "S":
	header("location: ../Student.php"); // Redirecting To Student Page
	break;		
case "V":
	header("location: ../Volunteer.php"); // Redirecting to Volunteer Page
	break;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Add User</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<link rel="stylesheet" type="text/css" href="../theme.css">
<script type="text/javascript" src="view.js"></script>
<script type="text/javascript" src="calendar.js"></script>
    
<style type="text/css">
.auto-style1 {
	margin-top: 0;
}
</style>
</head>
<body>
    <div id = "title">
    <a href="../Admin.php">
	<h2 id = "titleName">
		<img id = "titleIcon" src = "../calendar-icon.png"  alt="icon"> Holmen High School Robotics Club 
    </h2>
    </a>
    <input id = "log" class="button"  type="button" onClick="location.href='../logout.php'" value="Log out">
    <input id = "changePassword" class="button"  type="button" onClick="location.href='../changePassword.html'" value="Change password">
  </div>      
  <div id="label">
    <input id = "ModifykHours" class="labelButton"  type="button" onClick="location.href='../modifyStudentHours.html'" value="Modify student WorkHours ">
    <input id = "addevent" class="labelButton"  type="button" onClick="location.href='newform.php'" value="Add event">
    <input id = "modifyuser" class="labelButton"  type="button" onClick="location.href='../modifyUser.php'" value="Modify user">
    <input id = "modifyItems" class="labelButton"  type="button" onClick="location.href='../modifyItems.html'" value="Modify donation items">
    <input id = "seeMessage" class="labelButton"  type="button" onClick="location.href='../seeMessage.html'" value="See message">
  </div>
	<div id="main_body">
	&nbsp;<div id="form_container">
	
		<h1><a style="width: 637px">Add a New User</a></h1>
		<form id="form_1059751" class="appnitro"  method="post">
					<div class="form_description">
		</div>						
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
		//echo ("<script>alert('$success');</script>"); 
		?>
	</div>
  </body>
</html>
		