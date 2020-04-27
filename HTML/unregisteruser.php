<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "appliedwebdb");

$_SESSION["id"] = $currentuserid;

$sql = "Delete from users where ID = '$currentuserid'";

if($sql){
        header("location: register.php");
    }
    else echo '<script>alert("ERROR: USER ACCOUNT COULDNT BE DELETED, TRY AGAIN")</script>';

?>