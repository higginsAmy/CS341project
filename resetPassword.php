<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

include('session.php');
require_once('PHPMailer/class.phpmailer.php');
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
?>
<!doctype html>
<html>
<head></head>
<body>
<?php
// Fetch username from GET variable
$userid = htmlspecialchars($_GET["userid"]);
// Create connection
$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
// Check connection
if (mysqli_connect_errno($connection)) {
	echo "<div>";
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	echo "</div>";
}
// SQL query to fetch information from target user.
$result = mysqli_query($connection, "select * from users where id = $userid");
if ($result) {
	$userRow = mysqli_fetch_assoc($result);
	$email = $userRow['email'];
	$first = $userRow['first'];
	$last = $userRow['last'];
	$user = $userRow['username'];
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
	$sql = "UPDATE Users SET password='$hash' WHERE id = $userid";
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
		echo "<script> window.location.replace('modifyUser.php') </script>";
	}
	else {
		echo ("<script>$.confirm({
			'title'		: '',
			'message'	: '<div align=\"center\">Password reset successful</div>',
			'buttons'	: {
					'OK'	: {
								'class'	: 'blue',
							}
						},
			});</script>");
		echo "<script> window.location.replace('modifyUser.php') </script>";
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
	echo "<script> window.location.replace('modifyUser.php') </script>";
}
mysqli_close($connection); // Closing Connection
?>
</body>
</html>