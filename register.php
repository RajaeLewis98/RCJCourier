<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>User Registration Form</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>

		<div class="wrapper" style="background-image: url('images/bg-registration-form-2.jpg');">
			<div class="inner">
				<form action="register.php" method = "POST" name="registerform">
					<h3>Regular User Registration Form</h3>
					<div class="form-group">
						<div class="form-wrapper">
							<label for="">First Name</label>
							<input type="text" class="form-control" name="fname" required>
						</div>
						<div class="form-wrapper">
							<label for="">Last Name</label>
							<input type="text" class="form-control" name="lname" required>
						</div>
					</div>
					<div class="form-wrapper">
						<label for="">Email</label>
						<input type="text" class="form-control" name="email" required>
					</div>
					<div class="form-wrapper">
						<label for="">Password</label>
						<input type="password" class="form-control" name="password" required>
					</div>
					<div class="form-wrapper">
						<label for="">Confirm Password</label>
						<input type="password" class="form-control" name="confirmpassword" required>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox"> I accept the Terms of Use & Privacy Policy.
							<span class="checkmark"></span>
						</label>
					</div>
					
					<button type="submit" name="register" value="Register">REGISTER</button>
					<a href="login.php">Login</a>
					


					 <?php
        			//including the database connection file
        			include_once("db-config.php");
        			include_once("emailController.php");
        			include_once("userfunctions.php");

        			 // Check If form submitted, insert user data into database.
			        if (isset($_POST['register'])) {
			            $fname = $_POST['fname'];
			            $lname = $_POST['lname'];
			            $email = $_POST['email'];
			            $password = $_POST['password'];
			            $confirmpassword = $_POST['confirmpassword'];

			            //Verify email address entered is valid
			            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			            	echo '<script>alert("Email Address Entered is Invalid")</script>';
			            	die("");
						}

			            // If email already exists, throw error
			            $email_result = mysqli_query($mysqli, "select 'email' from users where email='$email'");

			            // Count the number of row matched 
			            $user_matched = mysqli_num_rows($email_result);
			        	

			            // If number of user rows returned more than 0, it means email already exists
			            if ($user_matched > 0) {
			             echo '<script>alert("User already exists with the email '.$email.'")</script>';
			            	    
			            }else if(PasswordPolicy($password)){
			            	echo '<script>alert("Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.")</script>';
			            } 

			            //Confirm both passwords entered are the same
			            else if($password != $confirmpassword){
			                echo '<script> alert("Passwords Do Not Match")</script>';

			            }else{
			            	//create random ID# between 1000 and 9999
			            	$random_number =(rand(1000,9999));
 							$id = "RCJ-". $random_number;

 							//Hash password entered by user
 							 $hashpassword = password_hash($password, PASSWORD_DEFAULT);

 							//Fetch current time and date, to be stored in database as registration date
 							date_default_timezone_set("Jamaica");
							$time = date("H:i:s");
							$date = date("Y-m-d");

							$timestamp =  $date." ".$time;

							//Generate random token
							$token = bin2hex(random_bytes(50));

			            	
							//Insert user data into database

			                $result   = mysqli_query($mysqli, "INSERT INTO users(id,firstname,lastname,email,password,regdate,token) VALUES('$id','$fname','$lname','$email','$hashpassword','$timestamp','$token')");

			                // check if user data inserted successfully.
			                if ($result) {
			                    /*echo "<br/><br/>User Registered successfully.";
			                    echo "<br/><br/>User ID Number is " .$id;*/
			                  echo '<script>alert("USER ID is '.$id.'")</script>';

			                  //Send User Email After Successful Registration
			                  sendVerificationEmail($email, $token,$id);
			                } else {
			                   /* echo "Registration error  " . mysqli_error($mysqli);*/
			                    echo '<script>alert("Registration error '.mysqli_error($mysqli).'")</script>';

			                }
			            }
			        }

			        //Password Strength function

			        /*function PasswordPolicy($password){
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
					*/
			        



        			?>
				</form>
			</div>
		</div>
		
	</body>
</html>