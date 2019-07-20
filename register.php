<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Bootstrap core CSS <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="css/common.css" rel="stylesheet">
	
	<!-- Signin for this template -->
    <link href="css/signin.css" rel="stylesheet">
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
		<form class="form-signin" action="phplogic/add_customer.php" method="post">
			<img class="mb-4" src="image/logo.png" alt="" width="210" height="70">
			<h1 class="h3 mb-3 font-weight-normal">Sign up</h1>
			<label for="inputUsername" class="sr-only">Username</label>
			<input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Username" required autofocus>
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
			<label for="name" class="sr-only">Name</label>
			<input type="text" id="inputName" name="inputName" class="form-control" placeholder="Name" required>
			<label for="birthday" class="sr-only">Birthday</label>
			<input type="date" id="inputBirthday" name="inputBirthday" class="form-control" placeholder="Birthday" required>
			<label for="contract" class="sr-only">Phone Contact Number</label>
			<input type="tel" id="inputContact" name="inputContact" class="form-control" placeholder="Phone Contact Number" pattern="[0-9]{8}" required>
			<label for="email" class="sr-only">Email</label>
			<input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email" required>
			<label for="answer" class="sr-only">Secure Question</label>
			<input type="text" id="inputSecureAnswer" name="inputSecureAnswer" class="form-control" placeholder="What is your best friend's name?" style="margin-bottom: 10px" required>
			<input type="hidden" id="inputSecureQuestion" name="inputSecureQuestion" class="form-control" value="What is your best friend's name?">
			
			<button class="btn btn-lg btn-primary btn-block" type="submit" style="overflow: block">Sign in</button>
		</form>
	</div>

    <?php include "footer.php"?>

</body>
</html>
