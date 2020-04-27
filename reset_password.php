<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Reset User Password</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>

		<div class="wrapper" style="background-image: url('images/bg-registration-form-2.jpg');">
			<div class="inner">
				<form action="reset_password.php" method="POST" name="resetpassword">
					<h3>Reset Password</h3>

					<p>
						Please Enter Your New Password Below. A valid password consists of atleast one Uppercase, One LowerCase Letter, One Numeral, One Special Character.
					</p>

					<div class="form-wrapper">
						<label for="">New Password</label>
						<input type="password" class="form-control" name="password" required>
					</div>
					<div class="form-wrapper">
						<label for="">Confirm New Password</label>
						<input type="password" class="form-control" name="confirmpassword" required>
					</div>

					<div>
						<button type="submit" name="resetpasswordbtn" >RESET PASSWORD</button>
						
						 
					</div>
					
					
					
					
				</form>
			</div>
		</div>
		
	</body>
</html>


<?php

	include_once("db-config.php");
	include_once("userfunctions.php");
	
	

	

	// When Reset Password Button is selected
	if(isset($_POST['resetpasswordbtn'])){
		$password = $_POST['password'];
		$confirmpassword = $_POST['confirmpassword'];

		//Check Password Matches Outline Criteria
		if(PasswordPolicy($password)){
	    	echo '<script>alert("Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.")</script>';
		} 
			//Confirm both passwords entered are the same
	        else if($password != $confirmpassword){
	        echo '<script> alert("Passwords Do Not Match")</script>';
	    	}

		    else{
		   
		    //Hash password entered by user
		 	$hashpassword = password_hash($password, PASSWORD_DEFAULT);

		 	//Fetch email value from current Session variable
		 	$email = $_SESSION['email'];
		 	

		 	$sql =  "UPDATE users SET PASSWORD ='$hashpassword' WHERE EMAIL ='$email'"; 
		 	$result = mysqli_query($mysqli, $sql);
			
				if($result){
					//echo '<script>alert("Password Reset Successful NEW PASSWORD '.$password.'")</script>';
					header("location: login.php");
					exit(0);
				}

		    }
	    
	}

 	

	/*function resetPassword($passwordToken)
	{
		global $mysqli;

		$sql =  "Select EMAIL,TOKEN from users where TOKEN= ? LIMIT 1";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("s",$passwordToken);

		if($stmt->execute()){

					$stmt->store_result();
					if($stmt->num_rows > 0){

						echo '<script>alert("Record  Found ")</script>';
						// bind result variables 
	   		 			mysqli_stmt_bind_result($stmt, $email, $token);

		   		 	 	// fetch values
				    	while (mysqli_stmt_fetch($stmt)){
				    	
			    		$_SESSION['email'] = $email;
			    		echo '<script>alert("Email in resetPassword func '.$email.'")</script>';
			    		return $email;

			    		header("location: reset_password.php");	
			    		}
			    	}

					// close statement 
			    	mysqli_stmt_close($stmt);
					exit(0);

		}
	}*/




?>