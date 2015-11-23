<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user']) && isset($_SESSION['login_auth'])){
	switch($_SESSION['login_auth']){
	case "S":
		header("location: Student.php"); // Redirecting To Student Page
		break;
	case "V":
		header("location: Volunteer.php"); // Redirecting To Volunteer Page
		break;
	}
}
$user = htmlspecialchars($_GET["username"]);
?>

<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="Javascript/changePassword.js"></script>
<link rel="stylesheet" type="text/css" href="theme.css">
<title>Holmen Robotics Login</title>
</head>
<body>
    <div id = "title">
       
            <h2 id = "titleName"> 
                <img id = "titleIcon" src = "calendar-icon.png"  alt="icon"> Holmen High School Robotics Club 
            </h2>
        </div>
    <div id="label">
    </div>
    <form id = "logForm" method="post">
    	<div align="center">
        <h3 style="display:block"> New Username:
        <input name="currentUsername"  class="password" />
            <span id="currentPassword" class="required"></span>
        </h3>
        <h3 style="display:block"> New Username comfirm:
        <input name="newUsernameConfirm" class="password" />
            <span id="newPassword" class="required"></span>
        </h3>
        <input type="submit" name="submit" value="Submit" class="button"/>
        </div>
        <div id="message">
            <?php if(isset($message)){ echo $message; } ?>
        </div>

    </form>

</body>
</html>

    <?php
            $user = htmlspecialchars($_GET["username"]);
    
			if (isset($_POST['submit'])) {
				$password=$_POST['password'];
				$currentUsername=$_POST['currentUsername'];
				$newUsernameConfirm=$_POST['newUsernameConfirm'];
				// Create connection
				$connection = mysqli_connect("localhost", "root", "091904", "holmenHighSchool");
				// Check connection
				if (mysqli_connect_errno($connection)) {
					echo "<div>";
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
					echo "</div>";
				}
				// SQL query to fetch information of registered users and finds user match.
				$result = mysqli_query($connection, "select * from users where username='$user'");
				if ($result) {
					if($currentUsername == $newUsernameConfirm){
						if(mysqli_query($connection,"UPDATE users SET username='$newUsernameConfirm' WHERE username='$user'")){
                            $success = "Changed username successfully.";
                            echo ("<script>alert('$success');</script>");
                            echo "<script> window.location.replace('modifyUser.php') </script>";
                            echo "Password update successful.";  
                            
                        }else{
                            $success =  "New username has been taken.";
                            echo ("<script>alert('$success');</script>");
                        }
					}else{
                        $success = "Usernames are not consistent.";
                        echo ("<script>alert('$success');</script>");
                    }
				}
			mysqli_close($connection); // Closing Connection
			}
			?>