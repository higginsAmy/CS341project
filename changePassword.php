<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

include('session.php');
require_once('PHPMailer/class.phpmailer.php');
if (!isset($_SESSION['login_auth'])){
	header("location: Guest.php");
}
$success = '';
?>
<html>
	<head>
		<!-- Styles --> 
		<link rel="stylesheet" type="text/css" href="theme.css">
		<!-- Scripts -->
		<title>Change Password</title>
	</head>
	<body>
		<div id = "title">
			<a href="Student.php">
				<h2 id = "titleName"> 
					<img id = "titleIcon" src = "calendar-icon.png"  alt="icon"> Holmen High School Robotics Club 
				</h2>
			</a>
        </div>
		<div id="label">
		</div>
		<div id="body">
			<form id = "logForm" method="post" action="">
				<div align="center">
					<h3 style="display:block"> Current Password:
						<input type="password" name="currentPassword"  class="password" required/>
						<span id="currentPassword" class="required"></span>
					</h3>
					<h3 style="display:block"> New Password:
						<input type="password" name="newPassword" class="password" required/>
						<span id="newPassword" class="required"></span>
					</h3>    
					<h3 style="display:block"> New Password Comfirm:
						<input type="password" name="confirmPassword"  class="password" required/>
						<span id="confirmPassword" class="required"></span>
					</h3>
					<input type="submit" name="submit" class="button"/>
				</div>
			</form>
			<?php
			$user = $_SESSION['login_user'];
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
				$result = mysqli_query($connection, "select * from users where username='$user' AND password='$password'");
				if ($result) {
					if($newPassword == $confirm){
						mysqli_query($connection,"UPDATE users SET password='$newPassword' WHERE username='$user'");
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
						$success = "Password update successful.";
					}
					else {
						$success = "Error: New Password and confirmation do not match.";
					}
				}
				else {
					$success = "Error: wrong password!";
				}
			mysqli_close($connection); // Closing Connection
			}
			?>
			<div class="required"><br><br><br><?php echo $success; ?></div>
			<div id="message">
				<?php if(isset($message)){ echo $message; } ?>
			</div>
		</div>
	</body>
</html>