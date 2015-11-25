<?php 
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
			('".$_POST['Title']."', '".$_POST['Location']."', '".$_POST['Desc']."', '$startDateTime', 
			'$endDateTime', ".$_POST['MinVol'].", ".$_POST['MaxVol'].", ".$_POST['MinStud'].", ".$_POST['MaxStud'].", '$user', 0)";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		if($result){
			echo "<div>Event successfully added to the database.</div>";
		}
		else {
			echo "<div>Event not added.</div>";
		}
		
		mysqli_close($connection); // Closing Connection
	}
?>