<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user']) && isset($_SESSION['login_auth'])){
	switch($_SESSION['login_auth']){
	case "A":
		header("location: Admin.php"); // Redirecting To Admin Page
		break;
	case "S":
		header("location: Student.php"); // Redirecting To Student Page
		break;
	case "V":
		header("location: Volunteer.php"); // Redirecting To Volunteer Page
		break;
	}
}
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Holmen Robotics Login</title>
		<!-- Styles --> 
		<link rel="stylesheet" type="text/css" href="theme.css">
	</head>
<body>
    <div id = "title">
		<a href="Guest.php">
			<h2 id = "titleName"> 
				<img id = "titleIcon" src = "calendar-icon.png"  alt="icon"> Holmen High School Robotics Club 
			</h2>
		</a>
        <input id = "forgetPassword" class="button" type="button" onClick="forgetPassword.html" value="Forget paassword">
    </div>    
    <div id="label"> 
        <input id = "contact" class="labelButton"  type="button" onClick="contact.html" value="Contact">
        <input id = "donate" class="labelButton" type="button" onClick="donate.html" value="Donate">
    </div>
    <form action="" method="post">
    	<div id="body" align="center">
			<p></p>
			<table cellspacing="50">
				<tr>
					<td>
						<h3 style="display:inline">Username:
						<input id="name" name="username" placeholder="username" type="text">
						</h3>
					</td>
					<td>
						<h3 style="display:inline">Password:
						<input id="password" name="password" placeholder="**********" type="password">
						</h3>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input id="auth" name="submit" type="submit" value="Login">
					</td>
				</tr>
			</table>
        </div>
		<div style="position: absolute; top: 350px; left: 500px;"><?php echo $error; ?></div>
    </form>

</body>
</html>