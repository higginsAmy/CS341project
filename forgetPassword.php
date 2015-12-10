<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

require_once('PHPMailer/class.phpmailer.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Forgot your password?</title>
		<!-- Styles -->
		<link rel="stylesheet" type="text/css" href="normalize.css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="theme.css" />
		<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Cuprum&amp;subset=latin' />
		<link rel="stylesheet" type="text/css" href="forms/view.css" media="all">
		<link rel="stylesheet" type="text/css" href="jquery.confirm/jquery.confirm.css" />
		<style type="text/css">
			.auto-style1 {
				margin-top: 0;
			}
		</style>
		<!-- Scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="forms/view.js"></script>
		<script type="text/javascript" src="forms/calendar.js"></script>
		<script src="jquery.confirm/jquery.confirm.js"></script>
	</head>
	<body>
		<div id="title">
		<a href="Guest.php">
			<h2 id="titleName">
				<img id="titleIcon" src="img/bot2.jpg"  alt="icon"> Holmen High School Robotics Club
			</h2>
		</a>
		<input id = "log" class="button" type="button" onClick="location.href='loginPage.php'" value="Log in">
		</div>
		<div id="label">
			<input id = "help" class="labelButton"  type="button" onClick="location.href='help.html'" value="Help">
            <input id = "contact" class="labelButton"  type="button" onClick="location.href='contact.html'" value="Contact">
            <input id = "donate" class="labelButton"  type="button" onClick="location.href='donate.html'" value="Donate">
		</div>
		<div id="main_body">&nbsp;
			<div id="form_container" style="height: 300px;">
				<h2>&nbsp;<a style="width: 637px">Forgot your password?</a></h2>
				<form class="appnitro" style="height: 300px;" method="post" action="">
					<div class="form_description">
						<p>Upon completion of this form, your password will be reset.</p>
					</div>
					<ul style="width: 103%;">
						<li id="Username" style="left: 0px; top: -3px; width: 45%; height: 65px" >
							<label class="description" for="Username">Username</label>
							<div>
								<input id="username" name="username" class="element text medium" type="text" maxlength="255" value="" required/>
							</div>
						</li>
						
						<li class="buttons" style="left: 4px;">
							<input id="reset" class="button_text" type="submit" name="submit" value="Submit" />
						</li>
					</ul>
				</form>
			</div>
			<img id="bottom" src="forms/bottom.png" alt="">
		</div>
	</body>
</html>

<?php 
// Logic to handle submission of form
if (isset($_POST['submit'])) {
	// Fetch username from form
	$user = $_POST['username'];
	// Create connection
	$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
	// Check connection
	if (mysqli_connect_errno($connection)) {
		echo "<div>";
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		echo "</div>";
	}
	// SQL query to verify username exists.
	$result = mysqli_query($connection, "select email, first, last from users where username ='$user'");
	if (mysqli_num_rows($result)) {
		$userRow = mysqli_fetch_assoc($result);
		$email = $userRow['email'];
		$first = $userRow['first'];
		$last = $userRow['last'];
		$newPassword = "";
		$i = 0;

		// Generate random 5-character password
		while($i < 5){
		  $rand = rand(0, 61);
		  // Digits 0-9
		  if ($rand < 10){
			$newPassword .= "$rand";  
		  }
		  // Characters a-z
		  else if ($rand < 36){
			  $rand += 55;
			  $newPassword .= chr($rand);
		  }
		  // Characters A-Z
		  else {
			  $rand += 61;
			  $newPassword .= chr($rand);
		  }
		  $i++;
		}
		// Hash password
		$hash = password_hash($newPassword, PASSWORD_DEFAULT);
		$sql = "UPDATE Users SET password='$hash' WHERE username='$user'";
		if (!mysqli_query($connection, $sql)) {
			echo ("<script>$.confirm({
				'title'		: '',
				'message'	: '<div align=\"center\">Error updating record: " .mysqli_error($conn). "</div>',
				'buttons'	: {
						'OK'	: {
									'class'	: 'blue',
								}
							},
				});</script>");
			echo "<div></div>";
		}
		// Setup to send email
		$mail = new PHPMailer(); // defaults to using php "mail()"
		$mail->IsSendmail(); // telling the class to use SendMail transport
		// Construct email message
		$line1 = "Hello from the Holmen High School Robotics team!";
		$line2 = "The password for your username " .$user. " has been reset to " .$newPassword;
		$line3 = "If you did not request this change, please notify an administrator immediately.";
		$line4 = "Have a good day!";
		$line5 = "- Holmen High School Robotics Web Team";
		$message = $line1. "\r\n\r\n" .$line2. "\r\n" .$line3. "\r\n\r\n" .$line4. "\r\n" .$line5;

		$mail->SetFrom('higgins.amy@uwlax.edu', 'Holmen Robotics Web Team');
		$mail->AddReplyTo("higgins.amy@uwlax.edu","Holmen Robotics Web Team");
		$mail->AddAddress($email, $first. " " .$last);
		$mail->Subject    = "[Auto-Notification] Holmen Robotics Password Reset";
		$mail->Body = $message;

		if(!$mail->Send()) {
			echo ("<script>$.confirm({
				'title'		: '',
				'message'	: '<div align=\"center\">Message failed! Mailer Error: " .$mail->ErrorInfo. "</div>',
				'buttons'	: {
						'OK'	: {
									'class'	: 'blue',
								}
							},
				});</script>");
		}
		else {
			echo ("<script>$.confirm({
				'title'		: '',
				'message'	: '<div align=\"center\">Password reset successful.  Please check your email.</div>',
				'buttons'	: {
						'OK'	: {
									'class'	: 'blue',
								}
							},
				});</script>");
		}
	}
	else {
		echo ("<script>$.confirm({
				'title'		: '',
				'message'	: '<div align=\"center\">Username invalid.  Please contact an administrator.</div>',
				'buttons'	: {
						'OK'	: {
									'class'	: 'blue',
								}
							},
				});</script>");
	}
mysqli_close($connection); // Closing Connection
}
?>