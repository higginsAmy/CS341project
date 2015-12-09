<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

include('login.php'); // Includes Login Script

if(isset($_SESSION['login_id']) && isset($_SESSION['login_auth'])){
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
		<a href="Guest.php">
			<h2 id = "titleName"> 
				<img id = "titleIcon" src = "img/bot2.jpg"  alt="icon"> Holmen High School Robotics Club 
			</h2>
		</a>
        <input id = "forgetPassword" class="button"  type="button" onClick="location.href='forgetPassword.php'" value="Forgot your password?">
    </div>    
    <div id="label"> 
        <input id = "help" class="labelButton"  type="button" onClick="location.href='help.html'" value="Help">
        <input id = "contact" class="labelButton"  type="button" onClick="location.href='contact.html'" value="Contact">
        <input id = "donate" class="labelButton"  type="button" onClick="location.href='donate.html'" value="Donate">
    </div>
	<div id="main_body">&nbsp;
			<div id="form_container">
				<h2>&nbsp;<a style="width: 637px">Holmen High School Robotics Login</a></h2>
				<form class="appnitro" method="post" action="">
					<div class="form_description">
						Please enter your username and password to log in.
					</div>
					<ul style="width: 103%; height: 200px" >
						<li style="left: 0px; top: -3px; width: 45%; height: 65px" >
							<label class="description">Username </label>
							<div>
								<input id="name" name="username" placeholder="username" class="element text medium" type="text" maxlength="255" value="" required/>
							</div>
						</li>

						<li style="left: 342px; top: -73px; width: 41%; height: 65px" >
							<label class="description">Password </label>
							<div>
								<input id="password" name="password" placeholder="**********" class="element text medium" type="password" maxlength="255" value="" required/>
							</div>
						</li>
						
						<li class="buttons" style="left: 4px; top: -80px">
							<input id="saveForm" class="button_text" type="submit" name="submit" value="Login" />
						</li>
					</ul>
				</form>
				<div class="required" style="position: relative; top: -65px; left: 50px;"><?php echo $error; ?></div>
			</div>
			<img id="bottom" src="forms/bottom.png" alt="">
        </div>
	</body>
</html>