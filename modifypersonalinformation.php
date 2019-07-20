<?php
	require "phplogic/common_function.php";
	
	view_require_login();
	
	$username = $_SESSION['username'];
	$sql = "SELECT username, password, name, birthday, contact, email, role, secure_question, secure_answer FROM onlineshop_user WHERE username = '$username' limit 1";
	
	$result = mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_assoc($result);
		$username = $row['username'];
		$name = $row['name'];
		$birthday = $row['birthday'];
		$contact = $row['contact'];
		$email = $row['email'];
		$role = $row['role'];
		$secure_question = $row['secure_question'];
		$secure_answer = $row['secure_answer'];
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

    <title>Modify Personal Information</title>

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
			Change Personal Information
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
					<form class="personalInfo" action="phplogic/update_personal_informarion.php" method="post">
						<h1 class="h3 mb-3 font-weight-normal">Personal Information</h1>
						<table>
							<tr>
								<td>Username</td>
								<td>
									<input type="text" id="inputUsername" name="inputUsername" class="form-control" value="<?php echo $username?>" autofocus readonly required>
								</td>
							</tr>
								<td>Name</td>
								<td>
									<input type="text" id="inputName" name="inputName" class="form-control" value="<?php echo $name?>" required>
								</td>
							</tr>
							<tr>
								<td>Birthday</td>
								<td>
									<input type="date" id="inputBirthday" name="inputBirthday" class="form-control" value="<?php echo $birthday;?>" required>
								</td>
							</tr>
							<tr>
								<td>Phone Number</td>
								<td>
									<input type="tel" id="inputContact" name="inputContact" class="form-control" pattern="[0-9]{8}" value="<?php echo $contact;?>" required>
								</td>
							</tr>
							<tr>
								<td>Email</td>
								<td>
									<input type="email" id="inputEmail" name="inputEmail" class="form-control" value="<?php echo $email;?>" required>
								</td>
							</tr>
							<tr>
								<td>Secure Question</td>
								<td>
									<input type="text" id="inputSecureQuestion" name="inputSecureQuestion" class="form-control" value="<?php echo $secure_question;?>" required>
								</td>
							</tr>
							<tr>
								<td>Secure Answer</td>
								<td>
									<input type="text" id="inputSecureAnswer" name="inputSecureAnswer" class="form-control" style="margin-bottom: 10px" value="<?php echo $secure_answer;?>" required>
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
