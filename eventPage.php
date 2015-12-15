<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

include('session.php');
if (!isset($_SESSION['login_auth'])){
	header("location: Guest.php");
}
switch($_SESSION['login_auth']){
case "S":
	header("location: Student.php"); // Redirecting To Student Page
	break;
}

$event = htmlspecialchars($_GET["event"]);

$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
if($connection){
	// get event by the eventID
	$eventObject = mysqli_query($connection, "SELECT * FROM events WHERE eventId =".$event);
	if($eventObject){
		//fecth all previous imformation from database and fill to the placeholes to the page
		$row = $eventObject->fetch_object();
		$eventTitle = $row->title;
		$minVolunteers = $row->minVolunteers;
		$maxVolunteers = $row->maxVolunteers;
		$minStudents = $row->minStudents;
		$maxStudents = $row->maxStudents;
		$description = $row->description;
		$location = $row->location;

		//get startDateTime and endDateTime
		$startDateTime = $row->startDateTime;
		$endDateTime = $row->endDateTime;

		// break two DateTime to year, month, day, hour and minutes.
		$SYear = $startDateTime{0}.$startDateTime{1}.$startDateTime{2}.$startDateTime{3};
		$SMonth = $startDateTime{5}.$startDateTime{6};
		$SDay = $startDateTime{8}.$startDateTime{9};
		$SHour = $startDateTime{11}.$startDateTime{12};
		$SMin = $startDateTime{14}.$startDateTime{15};

		$EYear = $endDateTime{0}.$endDateTime{1}.$endDateTime{2}.$endDateTime{3};
		$EMonth = $endDateTime{5}.$endDateTime{6};
		$EDay = $endDateTime{8}.$endDateTime{9};
		$EHour = $endDateTime{11}.$endDateTime{12};
		$EMin = $endDateTime{14}.$endDateTime{15};
	}
	mysqli_close($connection);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Event modification page for the Holmen High School Robotics Team">
		<meta name="author" content="Adam Geipel, Amy Higgins, Changsong Li">
		<title>Event Creator</title>
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
			<a href="Volunteer.php">
				<h2 id="titleName">
					<img id="titleIcon" src="img/bot2.jpg"  alt="icon"> Holmen High School Robotics Club
				</h2>
			</a>
			<input id="log" class="button"  type="button" onClick="location.href='logout.php'" value="Log out">
			<input id="changePassword" class="button"  type="button" onClick="location.href='changePassword.php'" value="Change password">
		</div>
		<div id="label">
			<input id = "help" class="labelButton"  type="button" onClick="location.href='help.html'" value="Help">
		</div>
		<div id="main_body">&nbsp;
			<div id="form_container">
				<h2>&nbsp;<a style="width: 637px">Edit Event</a></h2>
				<form id="form_1059751" class="appnitro" method="post" action="">
					<div class="form_description">
						Fill in event details to edit the event.
					</div>
					<ul style="width: 103%; height: 927px" >
						<li id="Title" style="left: 0px; top: -3px; width: 45%; height: 65px" >
							<label class="description" for="Title">Title </label>
							<div>
								<input id="Title" name="Title" class="element text medium" type="text" maxlength="255" value="<?=$eventTitle?>" required/>
							</div>
						</li>

						<li id="Location" style="left: 342px; top: -73px; width: 41%; height: 65px" >
							<label class="description" for="description">Location </label>
							<div>
								<input id="description" name="Location" class="element text medium" type="text" maxlength="255" value="<?=$location?>" required/>
							</div>
						</li>

						<li id="StartDate" style="left: 4px; top: -48px; width: 44%" >
							<label class="description" for="StartDate">Start Date </label>
							<span>
								<input id="SMonth" name="SMonth" class="element text" size="3" maxlength="2" value="<?=$SMonth?>" type="text" required/> /
								<label for="SMonth">MM</label>
							</span>
							<span>
								<input id="SDay" name="SDay" class="element text" size="3" maxlength="2" value="<?=$SDay?>" type="text" required/> /
								<label for="SDay">DD</label>
						</span>
							<span>
								<input id="SYear" name="SYear" class="element text" size="5" maxlength="4" value="<?=$SYear?>" type="text" required/>
								<label for="SYear">YYYY</label>
							</span>
						</li>

						<li id="EndDate" class="auto-style1" style="left: 343px; top: -107px; width: 42%" >
							<label class="description" for="EndDate">End Date </label>
							<span>
								<input id="EMonth" name="EMonth" class="element text" size="3" maxlength="2" value="<?=$EMonth?>" type="text" required/> /
								<label for="EMonth">MM</label>
							</span>
							<span>
								<input id="EDay" name="EDay" class="element text" size="3" maxlength="2" value="<?=$EDay?>" type="text" required/> /
								<label for="EDay">DD</label>
							</span>
							<span>
								<input id="EYear" name="EYear" class="element text" size="5" maxlength="4" value="<?=$EYear?>" type="text" required/>
								<label for="EYear">YYYY</label>
							</span>
						</li>

						<li id="StartTime" style="left: 4px; top: -107px; width: 42%" >
							<label class="description" for="StartTime">Start Time </label>
							<span>
								<input id="SHour" name="SHour" class="element text " size="3" type="text" maxlength="2" value="<?=$SHour?>" required/> :
								<label>HH</label>
							</span>
							<span>
								<input id="SMin" name="SMin" class="element text " size="3" type="text" maxlength="2" value="<?=$SMin?>" required/>
								<label>MM</label>
							</span>
						</li>

						<li id="li_6" style="left: 343px; top: -174px; width: 42%" >
							<label class="description" for="EndTime">End Time </label>
							<span>
								<input id="EHour" name="EHour" class="element text " size="3" type="text" maxlength="2" value="<?=$EHour?>" required/> :
								<label>HH</label>
						</span>
							<span>
								<input id="EMin" name="EMin" class="element text " size="3" type="text" maxlength="2" value="<?=$EMin?>" required/>
								<label>MM</label>
							</span>
						</li>

						<li id="MinVol" style="left: 4px; top: -116px; width: 37%" >
							<label class="description" for="MinVol">Min Number of Volunteers </label>
							<div>
								<input id="MinVol" name="MinVol" class="element text small" type="text" maxlength="255" value="<?=$minVolunteers?>" style="width: 11%" required/>
							</div>
						</li>

						<li id="MaxVol" style="left: 343px; top: -170px; width: 37%" >
							<label class="description" for="MaxVol">Max Number of Volunteers </label>
							<div>
								<input id="MaxVol" name="MaxVol" class="element text small" type="text" maxlength="255" value="<?=$maxVolunteers?>" style="width: 11%" required/>
								</div>
						</li>

						<li id="MinStud" style="left: 4px; top: -154px; width: 36%" >
							<label class="description" for="MinStud">Min Number of Students </label>
							<div>
								<input id="MinStud" name="MinStud" class="element text small" type="text" maxlength="255" value="<?=$minStudents?>" style="width: 11%" required/>
							</div>
						</li>

						<li id="MaxStud" style="left: 343px; top: -210px; width: 36%" >
							<label class="description" for="MaxStud">Max Number of Students </label>
							<div>
								<input id="MaxStud" name="MaxStud" class="element text small" type="text" maxlength="255" value="<?=$maxStudents?>" style="width: 11%" required/>
							</div>
						</li>

						<li id="Desc" style="left: 4px; top: -112px; width: 95%" >
							<label class="description" for="Desc">Description </label>
							<div>
								<textarea id="Desc" name="Desc" placeholder="" class="element textarea medium"><?=$description?></textarea>
							</div>
						</li>

						<li class="buttons" style="left: 4px; top: -100px">
							<input type="hidden" name="form_id" value="1059751" />
							<input id="saveForm" class="button_text" type="submit" name="submit" value="Change" />
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
	// Set date variables and put into ISO 8601
	$maxVol = $_POST['MaxVol'];
	$minVol = $_POST['MinVol'];
	$minStud = $_POST['MinStud'];
	$maxStud = $_POST['MaxStud'];
	$today = date("Y-m-d H:i:s");
	$startDateTime = $_POST['SYear']. "-" .$_POST['SMonth']. "-" .$_POST['SDay']. " " .$_POST['SHour']. ":" .$_POST['SMin']. ":00";
	$endDateTime = $_POST['EYear']. "-" .$_POST['EMonth']. "-" .$_POST['EDay']. " " .$_POST['EHour']. ":" .$_POST['EMin']. ":00";

	// Check if values entered are valid
	if(!checkDateTime($startDateTime)){
		echo ("<script>$.confirm({
			'title'		: '',
			'message'	: '<div align=\"center\">Start Date is not a valid date</div>',
			'buttons'	: {
					'OK'	: {
								'class'	: 'blue',
							}
						},
			});</script>");
	}else if(!checkDateTime($endDateTime)){
		echo ("<script>$.confirm({
			'title'		: '',
			'message'	: '<div align=\"center\">End Date is not a valid date</div>',
			'buttons'	: {
					'OK'	: {
								'class'	: 'blue',
							}
						},
			});</script>");
	}else if(!ctype_digit( $maxVol )){
		echo ("<script>$.confirm({
			'title'		: '',
			'message'	: '<div align=\"center\">Max Volunteer number is not a integer</div>',
			'buttons'	: {
					'OK'	: {
								'class'	: 'blue',
							}
						},
			});</script>");
	}else if(!ctype_digit( $minVol )){
		echo ("<script>$.confirm({
			'title'		: '',
			'message'	: '<div align=\"center\">Min Volunteer number is not a integer</div>',
			'buttons'	: {
					'OK'	: {
								'class'	: 'blue',
							}
						},
			});</script>");
	}else if(!ctype_digit( $minStud )){
		echo ("<script>$.confirm({
			'title'		: '',
			'message'	: '<div align=\"center\">Min Student number is not a integer</div>',
			'buttons'	: {
					'OK'	: {
								'class'	: 'blue',
							}
						},
			});</script>");
	}else if(!ctype_digit( $maxStud )){
		echo ("<script>$.confirm({
			'title'		: '',
			'message'	: '<div align=\"center\">Max Student number is not a integer</div>',
			'buttons'	: {
					'OK'	: {
								'class'	: 'blue',
							}
						},
			});</script>");
	}else if($today > $startDateTime  ){
		echo ("<script>$.confirm({
			'title'		: '',
			'message'	: '<div align=\"center\">Start date is not onward from today</div>',
			'buttons'	: {
					'OK'	: {
								'class'	: 'blue',
							}
						},
			});</script>");
	}else if($endDateTime < $startDateTime  ){
		echo ("<script>$.confirm({
			'title'		: '',
			'message'	: '<div align=\"center\">End date is before start date</div>',
			'buttons'	: {
					'OK'	: {
								'class'	: 'blue',
							}
						},
			});</script>");
	}
	else{
		// Create connection
		$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
		// Check connection
		if (mysqli_connect_errno($connection)) {
			echo "<div>";
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			echo "</div>";
		}

		$title = mysqli_real_escape_string($connection, $_POST['Title']);
		$location = mysqli_real_escape_string($connection, $_POST['Location']);
		$description = mysqli_real_escape_string($connection, $_POST['Desc']);

		// Modify event in database
		$newQuery = "UPDATE events SET title='$title', description='$description', location='$location', startDateTime='$startDateTime',
			endDateTime='$endDateTime', minVolunteers=$minVol, maxVolunteers=$maxVol, minStudents=$minStud, maxStudents=$maxStud where eventId=$event";

		if(mysqli_query($connection, $newQuery)){
			echo ("<script>$.confirm({
					'title'		: '',
					'message'	: '<div align=\"center\">Successfully modified event</div>',
					'buttons'	: {
							'OK'	: {
										'class'	: 'blue',
									}
								},
					});</script>");
					echo "<script> window.location.replace('modifyEvent.php') </script>";
		}
		else {
			echo ("<script>$.confirm({
					'title'		: '',
					'message'	: '<div align=\"center\">Failed modify event in the database</div>',
					'buttons'	: {
							'OK'	: {
										'class'	: 'blue',
									}
								},
					});</script>");
		}
		mysqli_close($connection); // Closing Connection
	}
}

function checkDateTime($data) {
	if (date('Y-m-d H:i:s', strtotime($data)) == $data) {
		return true;
	} else {
		return false;
	}
}
?>
