<?php
include('session.php');
if (!isset($_SESSION['login_auth'])){
	header("location: Guest.php");
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
<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
    <title>Search Events | Holmen Robotics</title>
    <!-- Styles -->
	<link rel="stylesheet" type="text/css" href="normalize.css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="theme.css" />

	<link rel="stylesheet" type="text/css" href="jquery.confirm/jquery.confirm.css" />
	
	<link rel="Stylesheet" href="Dropit-1.1.1/dropit.css" type="text/css" />
	
	<!-- Scripts -->
	<script src='fullcalendar/lib/jquery.min.js'></script>
	<script src='fullcalendar/lib/moment.min.js'></script>
	<script src='fullcalendar/fullcalendar.js'></script>
	<script src="jquery.confirm/jquery.confirm.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script src="Dropit-1.1.1/dropit.js"></script>

  </head>
  <body>
  <div id = "title">
    <a href="Admin.php">
		<h2 id = "titleName">
			<img id = "titleIcon" src = "img/bot2.jpg"  alt="icon"> Holmen High School Robotics Club 
		</h2>
    </a>
    <input id = "log" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
    <input id = "changePassword" class="button"  type="button" onClick="location.href='changePassword.php'" value="Change password">
  </div>      
  <div id="label">
    <input id = "SearchData" class="labelButton"  type="button" onClick="location.href='SearchData.php'" value="Search for Events">
    <input id = "addEvent" class="labelButton"  type="button" onClick="location.href='newEvent.php'" value="Add event">
	<input id = "modifyevent" class="labelButton"  type="button" onClick="location.href='modifyEvent.php'" value="Modify event">
    <input id = "modifyUser" class="labelButton"  type="button" onClick="location.href='modifyUser.php'" value="Modify user">
    <input id = "modifyItems" class="labelButton"  type="button" onClick="location.href='modifyItems.html'" value="Modify donation items">
    <input id = "seeMessage" class="labelButton"  type="button" onClick="location.href='seeMessage.html'" value="See message">
  </div>
  
  <div>
	  <h1> Search events by user </h1>
	  <div>
		  <form action="">
			  <select name="Users">
				  <option value=" ">          </option>
					  
					<?php
						// Create connection
						$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
						// Check connection
						if (mysqli_connect_errno($connection)) {
							echo "<div>";
							echo "Failed to connect to MySQL: " . mysqli_connect_error();
							echo "</div>";
						}
						$query = "SELECT first, last from users where id IN (SELECT * from events) GROUP BY(first, last)";
						
						$result=mysqli_query($connection, $query);
						while($row = nysqli_fetch_assoc($result)) {
							$first = $row['first'];
							$last = $row['last'];
							
							echo('<option value=\""$first" "$last"\">"$first" "$last"</option>');
						}
						
					?>
	  
	  			</select>
			</form>		  
	 </div>
  </div>
  <div>
		<h1> Search events by date </h1>
		<div>
		  <form action="">
			  <select name="Users">
					
					<option value=" ">          </option>
					<?php
						// Create connection
						$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
						// Check connection
						if (mysqli_connect_errno($connection)) {
							echo "<div>";
							echo "Failed to connect to MySQL: " . mysqli_connect_error();
							echo "</div>";
						}
						$query = "SELECT startDateTime from event";
						
						$result=mysqli_query($connection, $query);
						while($row = nysqli_fetch_assoc($result)) {
							
							$N_datetime = $row['startDateTime'];
							
							$timestamp = strtotime($N_datetime);
							$N_date = date('m/d/y', $timestamp);
							
							echo('<option value=\""$N_date"\">"$N_date"</option>');
						}
						
					?>
	  
	  			</select>
			</form>		  
	 </div>
  </div>
  <div class="buttons">
	  <input id = "SubmitButton" class="button_text" type="submit" name="submit" value="Submit" />
  </body>
</html>
