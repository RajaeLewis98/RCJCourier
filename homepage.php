<?php
session_start();

	// Create database connection using config file
	include_once("db-config.php");
	include_once("userfunctions.php");

//Verify user, using passwordtoken, will redirect to reset_pasword.php
if(isset($_GET['password-token'])){
	$passwordToken = $_GET['password-token'];
	resetPassword($passwordToken);
}

//Verify user, using token
if(isset($_GET['token'])){
	$token = $_GET['token'];
	activateUser($token);
}
// This page can be accessed only after login
// Redirect user to login page, if user email is not available in session\
if (isset($_SESSION["email"])) {
    echo "Currently logged in ". $_SESSION["email"];
}
if (!isset($_SESSION["email"])) {
    header("location: login.php");
    exit();
}

function activateUser($token){
	global $mysqli;

	$sql = "SELECT * FROM users WHERE token ='$token' LIMIT 1";
	$result = mysqli_query($mysqli,$sql);

	if(mysqli_num_rows($result)>0){
		$row = mysqli_fetch_assoc($result);
		$update_query = "UPDATE users SET STATUS ='Active' WHERE TOKEN ='$token'";

	

		if(mysqli_query($mysqli, $update_query )){
			//login user 
			$_SESSION["email"] = $row['EMAIL'];
			$_SESSION["id"] = $row['ID'];
			$_SESSION["status"] = $row['STATUS'];
			$_SESSION["firstname"] = $row['FIRSTNAME'];
			$_SESSION["lastname"] = $row['LASTNAME'];

			header("location: homepage.php");
			exit();
		}
	}else{
		echo '<script>alert("USER NOT FOUND")</script>';
	}
}

?>

<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>WELCOME</title>
</head>
<body>
<h3>User Successfully Logged IN</h3>
 <div style="text-align:right">
        <a href="logout.php">Logout</a>
 </div>

 
 <?php if($_SESSION["status"] === 'Inactive'):?>
 <div>
 	You need to verify your account.
 	Sign in the email you registered with and
 	click on the verification link sent
 	you at <?php echo $_SESSION["email"]; ?>
 </div>
<?php endif; ?>

<?php if($_SESSION["status"] === 'Active'):?>
<div>
	User Account Verified
</div>

<?php endif; ?>

</body>
</html>

