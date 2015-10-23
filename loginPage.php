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
        <h2 id = "titleName"> 
            <img id = "titleIcon" src = "calendar-icon.png"  alt="icon"> Holmen High School Robotics Club 
        </h2>
        <form action="forgetPassword.html">
            <input id = "forgetPassword" class="button"  type="submit" value="Forget paassword">
        </form>
    </div>    
    <div id="label">
        <form action="contact.html"> 
            <input id = "contact" class="labelButton"  type="submit" value="Contact">
        </form>
        <form action="donate.html"> 
            <input id = "donate" class="labelButton"  type="submit" value="Donate">
        </form>
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
		<span><?php echo $error; ?></span>
    </form>

</body>
</html>