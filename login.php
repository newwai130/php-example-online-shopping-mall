<?php
	require "phplogic/common_function.php";
	
	if( is_login() == true){
		header('Location: home.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap core CSS <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="css/common.css" rel="stylesheet">
	
	<!-- Signin for this template -->
    <link href="css/signin.css" rel="stylesheet">
	
	<!-- Google recaptcha API-->
	<script src='https://www.google.com/recaptcha/api.js'></script>
  </head>

  <body>

    <?php include 'navigationbar.php';?>
	
	<?php if(isset($_SESSION['notificationLevel']) && isset($_SESSION['notificationMessage']) && $_SESSION['notificationLevel'] != "" && $_SESSION['notificationMessage'] != ""): ?>
		<div class="cointainer">
			<div class="alert alert-<?php echo $_SESSION['notificationLevel'];?>">
			<strong><?php echo $_SESSION['notificationLevel'];?>!</strong> <?php echo $_SESSION['notificationMessage'];?>
			</div>
		</div>
		
	<?php 
		$_SESSION['notificationLevel'] = "";
		$_SESSION['notificationMessage'] = "";
		endif; 
	?>
	
    <!-- Page Content -->
    <div class="text-center">
		<form class="form-signin" action="phplogic/login.php" method="post">
			<img class="mb-4" src="image/logo.png" alt="" width="210" height="70">
			<h1 class="h3 mb-3 font-weight-normal">Please Login</h1>
			<label for="inputUsername" class="sr-only">Username</label>
			<input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Username" required autofocus>
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" style="margin-bottom: 10px" required>
			<!--
				<label for="inputCaptcha" class="sr-only">Captcha</label>
				<input type="text" id="inputCaptcha" name="inputCaptcha" class="form-control" placeholder="Captcha" style="margin-bottom: 10px" required>
			-->
			<div class="g-recaptcha" style="margin-bottom: 10px" data-callback="recaptchaCallback" data-sitekey="6Lff9XkUAAAAAMTqbLx2GCY3GyuaJ3YGjYS6-B7J"></div>
			<p class="text-left" style="font-size: 0.7rem;"><a href="forgetpassword.php"  style="color: black;"><u><b>Forget Password</b></u></a></p>
			<p class="text-left" style="font-size: 0.7rem;"><a href="register.php"  style="color: black;"><u><b>Register</b></u></a></p>
			
			<button id="submit-button" class="btn btn-lg btn-primary btn-block" type="submit" disabled>Sign in</button>
		</form>
			
	</div>
	
	<script>
		function recaptchaCallback() {
			document.getElementById("submit-button").disabled = false;
		};
	</script>
    
	<?php include "footer.php"?>

</body>
</html>
