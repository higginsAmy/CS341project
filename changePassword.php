<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

include('session.php');
require_once('PHPMailer/class.phpmailer.php');
if (!isset($_SESSION['login_auth'])){
	header("location: Guest.php");
}
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Change Password</title>
		<!-- Styles --> 
		<link rel="stylesheet" type="text/css" href="normalize.css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="theme.css" />
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Cuprum&amp;subset=latin" />
		<link rel="stylesheet" type="text/css" href="forms/view.css" media="all">
		<link rel="stylesheet" type="text/css" href="jquery.confirm/jquery.confirm.css" />
		<!-- Scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="forms/view.js"></script>
		<script src="jquery.confirm/jquery.confirm.js"></script>
	</head>
	<body>
		<div id = "title">
			<a href="Student.php">
				<h2 id = "titleName"> 
					<img id = "titleIcon" src = "img/bot2.jpg"  alt="icon"> Holmen High School Robotics Club 
				</h2>
			</a>
			<input id = "log" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
        </div>
		<div id="label">
			<input id = "help" class="labelButton"  type="button" onClick="location.href='help.html'" value="Help">
		</div>
		<div id="main_body">&nbsp;
			<div id="form_container" style="height: 300px;">
				<h2>Change Password</h2>
				<form class="appnitro" method="post" action="">
					<div class="form_description">
						Please enter your current password, your new password, and then confirm your new password.
					</div>
					<ul style="width: 103%;">
						<li style="left: 0px; top: -3px; width: 45%; height: 65px">
							<label class="description">Current Password </label>
							<div>
								<input name="currentPassword" class="element text medium" type="password" maxlength="255" value="" required/>
							</div>
						</li>
						
						<li style="left: 4px; top: -5px; width: 44%; height: 65px">
							<label class="description">New Password </label>
							<div>
								<input name="newPassword" class="element text medium" type="password" maxlength="255" value="" required/>
							</div>
						</li>
	   
						<li style="left: 343px; top: -76px; width: 42%; height: 65px">
							<label class="description">New Password Comfirm </label>
							<div>
								<input name="confirmPassword" class="element text" maxlength="255" value="" type="password" required/>
							</div>
						</li>
				
						<li class="buttons" style="left: 4px; top: -80px;">
							<input class="button_text" type="submit" name="submit" value="Change Password" />
						</li>
					</ul>
				</form>
			</div>
		</div>
	</body>
</html>
<?php
$userid = $_SESSION['login_id'];
if (isset($_POST['submit'])) {
	$password=$_POST['currentPassword'];
	$newPassword=$_POST['newPassword'];
	$confirm=$_POST['confirmPassword'];
	// Create connection
	$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
	// Check connection
	if (mysqli_connect_errno($connection)) {
		echo "<div>";
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		echo "</div>";
	}
	// SQL query to fetch information of registered users and finds user match.
	$result = mysqli_query($connection, "select * from users where id=$userid");
	if ($userRow = mysqli_fetch_assoc($result)) {
		$user = $userRow['username'];
		$email = $userRow['email'];
		$first = $userRow['first'];
		$last = $userRow['last'];
		$pwd = $userRow['password'];
		// Verify plaintext password against hash
		if (password_verify($password, $pwd)){
			if($newPassword == $confirm){
				$hash = password_hash($newPassword, PASSWORD_DEFAULT);
				mysqli_query($connection,"UPDATE users SET password='$hash' WHERE id=$userid");
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
					echo "Message failed! Mailer Error: " . $mail->ErrorInfo;
				}
				else{
					echo ("<script>$.confirm({
						'title'		: '',
						'message'	: '<div align=\"center\">Password changed successfully.</div>',
						'buttons'	: {
							'OK'	: {
										'class'	: 'blue',
									}
								},
						});</script>");
					echo "<script> window.location.replace('Student.php') </script>";
				}
			}
			else {
				echo ("<script>$.confirm({
						'title'		: '',
						'message'	: '<div align=\"center\">Error: New Password and confirmation do not match.</div>',
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
					'message'	: '<div align=\"center\">Error: Current password is incorrect.</div>',
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
					'message'	: '<div align=\"center\">Database Error!</div>',
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