<?php

session_start();

function PasswordPolicy($password){
	// Validate password strength
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);
	$specialChars = preg_match('@[^\w]@', $password);

	if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
	  	return true;
	}else{
	    
		return false;
	}
}


function resetPassword($token)
 	{
 		global $mysqli;
 		

 		$sql = "Select * From users where TOKEN = '$token' LIMIT 1";
 		$result = mysqli_query($mysqli, $sql);
 		$row = mysqli_fetch_assoc($result);
 		$_SESSION['email'] = $row['EMAIL'];
 		header("location: reset_password.php");
 		exit (0);
 	}

?>