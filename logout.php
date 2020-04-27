<?php
// Before deleting session, first recreate session
session_start();
include_once("db-config.php");

$userid = $_SESSION["id"];
$logindatetime = $_SESSION["logindatetime"];

date_default_timezone_set("Jamaica");
$time = date("H:i:s");
$date = date("Y-m-d");

$logoutDatetime =  $date." ".$time;
$update_query = "UPDATE activitylog SET LOGOUT ='$logoutDatetime' WHERE USERID ='$userid' AND LOGIN = '$logindatetime' ";
 $result   = mysqli_query($mysqli, $update_query);
// Destroy all session data to logout
session_destroy();

// Redirect to login page after logout
header("location: login.php");

exit();
?>
