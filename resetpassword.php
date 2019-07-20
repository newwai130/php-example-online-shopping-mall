<?php
	require "phplogic/common_function.php";
	
	if(!isset($_GET['inputUsername']) || empty($_GET['inputUsername']) == true){
		$_SESSION["notificationLevel"] = "danger";
		$_SESSION["notificationMessage"] = "Missing user name information";
		header('Location: forgetpassword.php');
		mysqli_close($conn);
		exit();
	}
	
	$username = $_GET['inputUsername'];
	$sql = "SELECT username, secure_question FROM onlineshop_user WHERE username='$username' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) == 0){
		$_SESSION["notificationLevel"] = "danger";
		$_SESSION["notificationMessage"] = "Wrong username";
		header('Location: forgetpassword.php');
		mysqli_close($conn);
		exit();
	}else{
		$row = mysqli_fetch_assoc($result);
		$username  = $row['username'];
		$securityQuestion = $row['secure_question'];
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reset Password</title>

    <!-- Bootstrap core CSS <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="css/common.css" rel="stylesheet">
	
	<!-- Table styles for this template -->
    <link href="css/myaccount.css" rel="stylesheet">
	
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
	</div>
    <!-- Page Content -->
	<div class="row">
		<div class="col-lg-12">
			<div class="text-center">
				<form class="personalInfo" action="phplogic/resetpassword.php" method="post">
					<img class="mb-4" src="image/logo.png" alt="" width="210" height="70">
					<h1 class="h3 mb-3 font-weight-normal">Reset Password</h1>
					<label for="inputUsername" class="sr-only">Username</label>
					<table>
						<tr>
							<td>Username</td>
							<td>
								<input type="text" id="inputUsername" name="inputUsername" class="form-control" value="<?php echo $username?>" autofocus readonly required>
							</td>
						</tr>
						<tr>
							<td>Secure Question</td>
							<td>
								<input type="text" id="inputSecureQuestion" name="inputSecureQuestion" class="form-control" value="<?php echo $securityQuestion;?>" readonly required>
							</td>
						</tr>
						<tr>
							<td>Secure Answer</td>
							<td>
								<input type="text" id="inputSecureAnswer" name="inputSecureAnswer" class="form-control" required>
							</td>
						</tr>
						<tr>
							<td>New Password</td>
							<td>
								<input type="text" id="inputNewPassword" name="inputNewPassword" class="form-control" required>
							</td>
						</tr>
						<tr>
							<td>Confirm New Password</td>
							<td>
								<input type="text" id="inputConfirmNewPassword" name="inputConfirmNewPassword" class="form-control" style="margin-bottom: 10px" required>
							</td>
						</tr>
					</table>
		  
					<button class="btn btn-lg btn-primary btn-block" style="overflow: block; width: 40%;margin: 0 auto;" type="submit">Confirm</button>
				</form>
			</div>	
		</div>
	</div>

    <?php include "footer.php"?>

</body>
</html>
