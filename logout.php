<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: Guest.php"); // Redirecting To Home Page
}
?>