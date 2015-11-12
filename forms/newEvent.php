<?php
include('../session.php');
if (!isset($_SESSION['login_auth'])){
	header("location: ../Guest.php");
}
switch($_SESSION['login_auth']){
case "S":
	header("location: ../Student.php"); // Redirecting To Student Page
	break;		
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Event Creator</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<link rel="stylesheet" type="text/css" href="../theme.css">
<script type="text/javascript" src="view.js"></script>
<script type="text/javascript" src="calendar.js"></script>
    
<style type="text/css">
.auto-style1 {
	margin-top: 0;
}
</style>
</head>
<body>
    <div id = "title">
    <a href="../Admin.php">
	<h2 id = "titleName">
		<img id = "titleIcon" src = "../calendar-icon.png"  alt="icon"> Holmen High School Robotics Club 
    </h2>
    </a>
    <input id = "log" class="button"  type="button" onClick="location.href='../logout.php'" value="Log out">
    <input id = "changePassword" class="button"  type="button" onClick="location.href='../changePassword.html'" value="Change password">
  </div>      
 
	<div id="main_body">
	&nbsp;<div id="form_container">
	
		<h2>&nbsp;<a style="width: 637px">Create a new Event</a></h1>
		<form id="form_1059751" class="appnitro"  method="post" action="">
					<div class="form_description">
		</div>						
			<ul style="width: 103%; height: 927px" >
			
					
		<li id="Title" style="left: 0px; top: -3px; width: 45%; height: 65px" >
		<label class="description" for="Title">Title </label>
		<div>
			<input id="Title" name="Title" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		
		
		<li id="Location" style="left: 342px; top: -73px; width: 41%; height: 65px" >
		<label class="description" for="description">Location </label>
		<div>
			<input id="description" name="Location" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		
		
		<li id="StartDate" style="left: 4px; top: -48px; width: 44%" >
		<label class="description" for="StartDate">Start Date </label>
		<span>
			<input id="SMonth" name="SMonth" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="SMonth">MM</label>
		</span>
		<span>
			<input id="SDay" name="SDay" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="SDay">DD</label>
		</span>
		<span>
	 		<input id="SYear" name="SYear" class="element text" size="4" maxlength="4" value="" type="text">
			<label for="SYear">YYYY</label>
		</span>
		 
		</li>		
		
		<li id="EndDate" class="auto-style1" style="left: 343px; top: -107px; width: 42%" >
		<label class="description" for="EndDate">End Date </label>
		<span>
			<input id="EMonth" name="EMonth" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="EMonth">MM</label>
		</span>
		<span>
			<input id="EDay" name="EDay" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="EDay">DD</label>
		</span>
		<span>
	 		<input id="EYear" name="EYear" class="element text" size="4" maxlength="4" value="" type="text">
			<label for="EYear">YYYY</label>
		</span>
		 
		</li>		
		
		<li id="StartTime" style="left: 4px; top: -107px; width: 42%" >
		<label class="description" for="StartTime">Start Time </label>
		<span>
			<input id="SHour" name="SHour" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>HH</label>
		</span>
		<span>
			<input id="SMin" name="SMin" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>MM</label>
		</span>
		 
		</li>
 
		<li id="li_6" style="left: 343px; top: -174px; width: 42%" >
		<label class="description" for="EndTime">End Time </label>
		<span>
			<input id="EHour" name="EHour" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>HH</label>
		</span>
		<span>
			<input id="EMin" name="EMin" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>MM</label>
		</span>
		
		</li>		
 
		
		<li id="MinVol" style="left: 4px; top: -116px; width: 37%" >
		<label class="description" for="MinVol">Min Number of Volunteers </label>
		<div>
			<input id="MinVol" name="MinVol" class="element text small" type="text" maxlength="255" value="" style="width: 9%"/> 
		</div> 
		</li>		
		
		<li id="MaxVol" style="left: 343px; top: -170px; width: 37%" >
		<label class="description" for="MaxVol">Max Number of Volunteers </label>
		<div>
			<input id="MaxVol" name="MaxVol" class="element text small" type="text" maxlength="255" value="" style="width: 10%"/> 
		</div> 
		</li>		
		
		<li id="MinStud" style="left: 4px; top: -154px; width: 36%" >
		<label class="description" for="MinStud">Min Number of Students </label>
		<div>
			<input id="MinStud" name="MinStud" class="element text small" type="text" maxlength="255" value="" style="width: 11%"/> 
		</div> 
		</li>		
		
		<li id="MaxStud" style="left: 343px; top: -210px; width: 36%" >
		<label class="description" for="MaxStud">Max Number of Students </label>
		<div>
			<input id="MaxStud" name="MaxStud" class="element text small" type="text" maxlength="255" value="" style="width: 11%"/> 
		</div>
		
		</li>		
		
		<li id="Desc" style="left: 4px; top: -112px; width: 95%" >
		<label class="description" for="Desc">Description </label>
		<div>
			<textarea id="Desc" name="Desc" class="element textarea medium"></textarea> 
		</div> 
		</li>
			
					<li class="buttons" style="left: 4px; top: -100px">
			    <input type="hidden" name="form_id" value="1059751" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>	
				<?php 
		// Logic to handle submission of form
		if (isset($_POST['submit'])) {
			if (empty($_POST['Title'])){ 
				//|| empty($_POST['MinVol']) || empty($_POST['MaxVol']) || empty($_POST['SMonth']) || empty($_POST['SDay']) || empty($_POST['SYear']) || empty($_POST['EMonth']) || empty($_POST['EDay']) || empty($_POST['EYear']) || empty($_POST['SHour']) || empty($_POST['SMin']) || empty($_POST['EHour']) || empty($_POST['EMin']) || empty($_POST['MinStud']) || empty($_POST['MaxStud']) || empty($_POST['Location'])){
				echo "<div>Please fill out all fields to create event.</div>";
			}
			else{
				// Get username of person creating event
				$user = $_SESSION['login_user'];
				// Set date variables and put into ISO 8601
				$startDateTime = $_POST['SYear']. "-" .$_POST['SMonth']. "-" .$_POST['SDay']. " " .$_POST['SHour']. ":" .$_POST['SMin']. ":00";  
				$endDateTime = $_POST['EYear']. "-" .$_POST['EMonth']. "-" .$_POST['EDay']. " " .$_POST['EHour']. ":" .$_POST['EMin']. ":00";
				// Parse other variables
				$title = mysqli_real_escape_string($_POST['Title']);
				$location = mysqli_real_escape_string($_POST['Location']);
				$description = mysqli_real_escape_string($_POST['Desc']);
				$maxVol = $_POST['MaxVol'];
				$minVol = $_POST['MinVol'];
				$minStud = $_POST['MinStud'];
				$maxStud = $_POST['MaxStud'];
				// Create connection
				$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
				// Check connection
				if (mysqli_connect_errno($connection)) {
					echo "<div>";
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
					echo "</div>";
				}
				// Insert event into database
				$query = "INSERT INTO events (title, location, description, startDateTime, endDateTime, 
					minVolunteers, maxVolunteers, minStudents, maxStudents, creator, removed) VALUES 
					('$title', '$location', '$description', '$startDateTime', '$endDateTime', $minVol, $maxVol, 
					$minStud, $maxStud, '$user', 0)";
				$result = mysqli_query($connection, $query);
				if($result){
					echo '<div style="position: relative; top: 152px; left: 250px; margin: auto;">Event successfully added to the database.</div>';
				}
				else {
					echo '<div style="position: relative; top: 152px; left: 250px; margin: auto;">Event not added.</div>';
				}
				
				mysqli_close($connection); // Closing Connection
			}
		}
		
		?>
	</div>
	<img id="bottom" src="bottom.png" alt="">
    </div>
	</body>
</html>