<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: Guest.php"); // Redirecting To Home Page
}
?>