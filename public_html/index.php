<!DOCTYPE html>
<?php
session_start();
include("functions.php");
$message="";
if(count($_POST)>0) {
	if( $_POST["user_name"] == "admin" and $_POST["password"] == "admin") {
		$_SESSION["user_id"] = 1001;
		$_SESSION["user_name"] = $_POST["username"];
		$_SESSION['loggedin_time'] = time();  
	} else {
		$message = "Invalid Username or Password!";
	}
}

if(isset($_SESSION["user_id"])) {
	if(!isLoginSessionExpired()) {
		header("Location:user_dashboard.php");
	} else {
		header("Location:logout.php?session_expired=1");
	}
}

if(isset($_GET["session_expired"])) {
	$message = "Login Session is Expired. Please Login Again";
}
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login">
			<h1>Admin Login</h1>
			<form name="frmUser" method="post" action="">
			    <?php if($message!="") { ?>
                <div class="message"><?php echo $message; ?></div>
                <?php } ?>
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login">
			</form>
		</div>
	</body>
</html>