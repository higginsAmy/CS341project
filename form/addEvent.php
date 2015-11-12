<?php 
		//set misc variables and put into ISO 8601
		$startDateTime = $_POST[SYear] . '-' . $_POST[SMonth] . '-' . $_POST[SDay] . ' ' . $_POST[SHour]. ':' . $_POST[SMin].':00';  
		$endDateTime = $_POST[EYear] . '-' . $_POST[EMonth] . '-' . $_POST[EDay] . ' ' . $_POST[EHour]. ':' . $_POST[EMin].':00';		
		
$title = $_POST[Title];
$description = $_POST[Desc];
$maxVol = $_POST[MaxVol];
$minVol = $_POST[MinVol];
$minStud = $_POST[MinStud];
$maxStud = $_POST[MaxStud];

		
		//Get username of person creating event
		$user = $_SERVER['login_user'];
		// Create connection
$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
		// Check connection
		if (mysqli_connect_errno($connection)) {
			echo "<div>";
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			echo "</div>";
		}

$sqlInsert = "INSERT INTO events (title, description, startDateTime, endDateTime, minVolunteers, maxVolunteers, minStudents, maxStudents, creator, Removed) 
		VALUES ('{$title}', '{$description}', '{$startDateTime}', '{$endDateTime}', '{$minVol}', '{$maxVol}', '{$minStud}', '{$maxStud}', '{$user}', 0)";
		// SQL query to fetch information of registerd users and finds user match.
$user = $_SESSION['login_user'];
if(!mysqli_query($connection, $sqlInsert)){
    echo 'error';
}

header("location: ../Admin.php");

mysql_close($connection); // Closing Connection;
?>