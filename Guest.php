<!doctype html>
<html>
  <head>
  	<meta charset="utf-8">
    <title>Guest | Holmen Robotics</title>
    <!-- Styles --> 
    <link rel="stylesheet" type="text/css" href="normalize.css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="theme.css" />
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
	<link href='http://fonts.googleapis.com/css?family=Cuprum&amp;subset=latin' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="jquery.confirm/jquery.confirm.css" />
	<!-- Scripts -->
	<script src='fullcalendar/lib/jquery.min.js'></script>
	<script src='fullcalendar/lib/moment.min.js'></script>
	<script src='fullcalendar/fullcalendar.js'></script>
	<script src="jquery.confirm/jquery.confirm.js"></script>
	<?php include ('guestCal.php'); ?>
  </head>
    <body>
        <div id = "title">
            <a href="Guest.php">
				<h2 id = "titleName"> 
					<img id = "titleIcon" src = "img/bot2.jpg"  alt="icon"> Holmen High School Robotics Club 
				</h2>
            </a>
			<input id = "log" class="button" type="button" onClick="location.href='loginPage.php'" value="Log in">
            <input id = "forgetPassword" class="button"  type="button" onClick="location.href='forgetPassword.php'" value="Forgot your password?">
        </div>
        
        <div id="label">
            <input id = "contact" class="labelButton"  type="button" onClick="location.href='contact.html'" value="Contact">
            <input id = "donate" class="labelButton"  type="button" onClick="location.href='donate.html'" value="Donate">
        </div>
		<div id="body" style="margin: 0 5px 5px 5px;">
			<div id='calendar' style="background:white; position:relative; top: 10px; width:75%; display:inline-block;"></div>
		</div>
	</body>
</html>
