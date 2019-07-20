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
		<form class="form-signin" action="resetpassword.php" method="GET">
			<img class="mb-4" src="image/logo.png" alt="" width="210" height="70">
			<h1 class="h3 mb-3 font-weight-normal">Forget Password</h1>
			
			<label for="inputUsername" class="sr-only">Username</label>
			<input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Username" style="margin-bottom: 10px" required autofocus>
		  
			<button class="btn btn-lg btn-primary btn-block" type="submit">Confirm</button>
		</form>
			
	</div>

    <?php include "footer.php"?>

    </body>

</html>
