<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>User Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>

		<div class="wrapper" style="background-image: url('images/bg-registration-form-2.jpg');">
			<div class="inner">
				<form action="login.php" method="POST" name="loginform">
					<h3>User Login</h3>
					<div class="form-group">
						
						
					</div>
					<div class="form-wrapper">
						<label for="">Email</label>
						<input type="text" name="email" class="form-control">
					</div>
					<div class="form-wrapper">
						<label for="">Password</label>
						<input type="password" name ="password" class="form-control">
					</div>
					<div>
						<button type="submit" name="login" value="Login">LOG IN</button>
						 <a href="register.php">Register</a>
						 
					</div>
					<div style="font-size: 0.8em; text-align: center;">
						<a href="forgot_password.php">Forgot Password?</a>
					</div>
					
				</form>
			</div>
		</div>
		
	</body>
</html>


<?php

// Start PHP session at the beginning 
session_start();


// Create database connection using config file
include_once("db-config.php");

// If form submitted, collect email and password from form
if (isset($_POST['login'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];
    

    // Check if a user exists with given username & password
    $result = mysqli_query($mysqli, "Select *  from users
        where email='$email'");


	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		
			
			//Verify if password entered by user matches the hash received from database
			if(password_verify($password, $row['PASSWORD'])){
				 
				$_SESSION["email"] = $row['EMAIL'];
				$_SESSION["id"] = $row['ID'];
				$_SESSION["status"] = $row['STATUS'];
				$_SESSION["firstname"] = $row['FIRSTNAME'];
				$_SESSION["lastname"] = $row['LASTNAME'];
				$_SESSION["regdate"] = $row['REGDATE'];
				$_SESSION["usertype"] = $row['USERTYPE'];


				$id = $row['ID'];



				//Fetch current time and date, to be stored in database as registration date
				date_default_timezone_set("Jamaica");
				$time = date("H:i:s");
				$date = date("Y-m-d");

				$loginDatetime =  $date." ".$time;
				$_SESSION["logindatetime"] = $loginDatetime;

				$result= mysqli_query($mysqli, "INSERT INTO activitylog(USERID,LOGIN) VALUES('$id','$loginDatetime')");


        		header("location: HTML/index.php");
        		exit();

			}

			else
			{
				
			
				echo '<script>alert("ERROR: PASSWORD OR EMAIL does not match")</script>'; 
			}
		
	}
	else  
	    {  
	     echo '<script>alert("Wrong User Details")</script>';  
	    }  

}  

    

?>