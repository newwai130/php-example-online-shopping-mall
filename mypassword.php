<?php
	require "phplogic/common_function.php";
	
	view_require_login();
	
	$username = $_SESSION['username'];
	$sql = "SELECT username, password, role FROM onlineshop_user WHERE username = '$username' limit 1";
	
	$result = mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_assoc($result);
		$username = $row['username'];
		$hashed_password = $row['password'];
	}else{
		$_SESSION["notificationLevel"] = "danger";
		$_SESSION["notificationMessage"] = "Fail to access user profile";
		header('Location: home.php');
		mysqli_close($conn);
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

    <title>My Password</title>

    <!-- Bootstrap core CSS <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="css/common.css" rel="stylesheet">
	
	<!-- Table styles for this template -->
    <link href="css/myaccount.css" rel="stylesheet">
	
	<!-- Searchbar for this template -->
    <link href="css/searchbar.css" rel="stylesheet">

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
    <div class="container">
		
		<h2 class="my-4" style="font-size:1rem;">
			Change Password
		</h2>	
		<div class="row">

			<div class="col-lg-3" style="margin-top:20px">
				<div class="list-group">
				<a href="myaccount.php" class="list-group-item">Basic Personal Information</a>
				<a href="modifypersonalinformation.php" class="list-group-item">Change Personal Inforation</a>
				<a href="mypassword.php" class="list-group-item">Change Password</a>
				</div>
			</div>
			<!-- /.col-lg-3 -->

			<div class="col-lg-9">
				<div class="text-center">
					<form class="personalInfo" action="phplogic/update_password.php" method="post">
						<h1 class="h3 mb-3 font-weight-normal">Personal Information</h1>
						<table>
							<tr>
								<td>Old Password</td>
								<td>
									<input type="password" id="inputOldPassword" name="inputOldPassword" class="form-control" required autofocus>
								</td>
							</tr>
								<td>New Password</td>
								<td>
									<input type="password" id="inputNewPassword" name="inputNewPassword" class="form-control" required>
								</td>
							</tr>
							<tr>
								<td>Confirm New Password</td>
								<td>
									<input type="password" id="inputConfirmPassword" name="inputConfirmPassword" class="form-control" required>
								</td>
							</tr>
						 </table>
					  <button class="btn btn-lg btn-primary btn-block" type="submit" style="overflow: block; width: 40%;margin: 0 auto;">Confirm</button>
					</form>
				</div>

			</div>
			<!-- /.col-lg-9 -->

		</div>
		<!-- /.row -->

    </div>
    <!-- /.container -->

    <?php include "footer.php"?>

</body>
</html>
