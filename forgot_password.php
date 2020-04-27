<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Recover Password</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>

		<div class="wrapper" style="background-image: url('images/bg-registration-form-2.jpg');">
			<div class="inner">
				<form action="forgot_password.php" method="POST" name="recoverpassword">
					<h3>Recover Password</h3>

					<p>
						Please Enter Below the Email address you have registered below, and a Password Recovery link will be sent to your email.
					</p>

					<div class="form-group">

					</div>

					<div class="form-wrapper">
						
						<input type="text" name="email" class="form-control">
					</div>

					<div>
						<button type="submit" name="forgotpasswordbtn" >SUBMIT</button>
						
						 
					</div>
					
					
					
					
				</form>
			</div>
		</div>
		
	</body>
</html>

<?php

include_once("db-config.php");
include_once("emailController.php");

//check if email entered was successfully submitted 
if(isset($_POST['forgotpasswordbtn'])){
	$email = $_POST['email'];

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    	echo '<script>alert("Email Address Entered is Invalid")</script>';
    	die("");
	}
	/*
	 // Check database table if a user exists with given email
    $result = mysqli_query($mysqli, "Select *  from users
        where email='$email' LIMIT 1");

    if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);	
		/*echo '<script>alert("Email Found in Users table '.$row['EMAIL'].'")</script>';
	}*/
		//use Prepared Statements to run query
		$sql =  "Select EMAIL,TOKEN from users where EMAIL=? LIMIT 1";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("s",$email);

		if($stmt->execute()){

			//echo '<script>alert("Prepared Statement Executed ")</script>';
				$stmt->store_result();
				if($stmt->num_rows > 0){

					echo '<script>alert("Record  Found ")</script>';
					/* bind result variables */
   		 			mysqli_stmt_bind_result($stmt, $email, $token);

	   		 	 	/* fetch values */
			    	while (mysqli_stmt_fetch($stmt)) {
		    		//echo '<script>alert("Token is '.$token.' ")</script>';		

		    		}
		    		//call method to email the user
		    		sendPasswordResetLink($email, $token);
		    		/*header('location:login.php');*/

		    		/* close statement */
		    		mysqli_stmt_close($stmt);

		    		exit(0);



				}

				else {
						echo '<script>alert("User Not Found ")</script>';

						/* close statement */
    					mysqli_stmt_close($stmt);
	
					}		

	}
		
	
}




?>
