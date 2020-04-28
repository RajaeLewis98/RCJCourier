<?php
//creates a unique id with the 'about' prefix// 
/*$a = uniqid();
 echo $a; 
 
 echo "<br>";
 $a =substr($a, 6);

 echo $a;
 $a = "RCJ". $a;
 echo "<br>";
 echo $a;
 echo "<br>";*/
 
 //echo strtoupper($a);
 
 /*$hash = password_hash("123", PASSWORD_DEFAULT);
 echo $hash;*/
 /*$password = "Password123";
$hashpassword = password_hash($password, PASSWORD_DEFAULT);
echo $hashpassword;
*/
/*$hash = '$2y$10$gJhvAAVRsWBtlQbzlUj8IuzUeBEMrF9fTpj4FaRoTTzfzDFZ14YFy';


if (password_verify("Password99", $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.'."<br>";
}
date_default_timezone_set("Jamaica");
echo "The time is " . date("H:i:s"). "<br>";
echo "Today is " . date("Y/m/d") . "<br>";
echo "Today is " . date("Y.m.d") . "<br>";
echo "Today is " . date("Y-m-d") . "<br>";
echo "Today is " . date("l");*/

date_default_timezone_set("Jamaica");
$time = date("H:i:s");
$date = date("Y-m-d");

$timestamp =  $date." ".$time;
echo $timestamp;


?>
