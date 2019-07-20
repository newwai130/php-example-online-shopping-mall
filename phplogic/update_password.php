<?php
	require "common_function.php";
	
	logic_require_login();
	
	if (!isset($_POST["inputOldPassword"]) 	|| empty($_POST["inputOldPassword"]) == true ||
		!isset($_POST["inputNewPassword"]) || empty($_POST["inputNewPassword"]) == true ||
		!isset($_POST["inputConfirmPassword"]) 	|| empty($_POST["inputConfirmPassword"]) == true ) {
			$_SESSION["notificationLevel"] = "danger";
			$_SESSION["notificationMessage"] = "Some information are missing";
			header('Location: ../mypassword.php');
			mysqli_close($conn);
			exit();
    }
	
	if ($_POST["inputNewPassword"] != $_POST["inputConfirmPassword"]){
		$_SESSION["notificationLevel"] = "danger";
		$_SESSION["notificationMessage"] = "The new password should equal to new confirm password";
		header('Location: ../mypassword.php');
		mysqli_close($conn);
		exit();
	}
	
	$password = mysqli_real_escape_string($conn, $_POST["inputOldPassword"]);
	$newpassword = mysqli_real_escape_string($conn, $_POST["inputNewPassword"]);
	
	$username = $_SESSION['username'];
	
	$sql = "SELECT username, password FROM onlineshop_user WHERE username = '$username'";
	
	$result = mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_assoc($result);
		if(password_verify($password,$row['password'])){
			$hashed_new_password = password_hash($newpassword, PASSWORD_DEFAULT);
			$sql = "UPDATE onlineshop_user SET password = '$hashed_new_password' WHERE username = '$username'";
			if(mysqli_query($conn, $sql)){
				$_SESSION["notificationLevel"] = "success";
				$_SESSION["notificationMessage"] = "Update password successfully";	
			}else{
				$_SESSION["notificationLevel"] = "danger";
				$_SESSION["notificationMessage"] = "Fail to update password";	
			}
			header('Location: ../mypassword.php');
			mysqli_close($conn);
			exit();
		}else{
			$_SESSION["notificationLevel"] = "danger";
			$_SESSION["notificationMessage"] = "Your original password is wrong";
			header('Location: ../mypassword.php');
			mysqli_close($conn);
			exit();
		}
	}else{
		$_SESSION["notificationLevel"] = "danger";
		$_SESSION["notificationMessage"] = "Fail to access user profile from database";
		header('Location: home.php');
		mysqli_close($conn);
		exit();
	}

	mysqli_close($conn);
?>