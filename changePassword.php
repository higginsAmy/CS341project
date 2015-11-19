<?php
include('session.php');
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
		<title>Holmen Robotics Login</title>
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