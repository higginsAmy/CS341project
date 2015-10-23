<?php
include('session.php');
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
  <head>
  	<meta charset="utf-8">
    <title>Modify user accounts</title>
 	<!-- Styles --> 
    <link rel="stylesheet" type="text/css" href="theme.css">
	<!-- Scripts -->
  </head>
  <body>
    <div id="container"> 
    	<div id="title">
      		<h1 id="titleName">
      		<img id = "icon"src="http://icons.iconarchive.com/icons/paomedia/small-n-flat/1024/calendar-icon.png">
      		<b>Holmen High School Robotics Club</b>
      		</h1>
    	</div>
		<div>
			<?php 
			// Create connection
			$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
			// Check connection
			if (mysqli_connect_errno($connection)) {
				echo "<div>";
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
				echo "</div>";
			}
			// SQL query to fetch information of registerd users and finds user match.
			$user = $_SESSION['login_user'];
			$result = mysqli_query($connection, "select * from users where username !='$user'");
			if ($result) {
				echo "<table><tr><th>Username</th><th>Password</th><th>Authorization</th><th>Edit</th></tr>";
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr><td>".$row["username"]."</td><td>".$row["password"]."</td><td>".$row["auth"]."</td><td><a href='edit.php'>Edit</a></td></tr>";
				}
				echo "</table>";
			} else {
				echo "0 results";
			}
			mysql_close($connection); // Closing Connection;
?>
		</div>
		<button id = "logout" class="bigbutton" type="button" onClick="location.href='logout.php'"><b>Log Out</b></button>
      	<button id = "adminHome" class="bigbutton"  type="button" onClick="location.href='Admin.php'"><b>Admin Home</b></button>
      	<p id="news">*News on upcoming events/deadlines *other news.</p>
	</div>
  </body>
</html>