<?php
	require "common_function.php";
	
	if (!isset($_POST["inputUsername"]) || empty($_POST["inputUsername"]) == true ||
		!isset($_POST["inputSecureAnswer"]) || empty($_POST["inputSecureAnswer"]) == true ||
		!isset($_POST["inputNewPassword"]) || empty($_POST["inputNewPassword"]) == true ||
		!isset($_POST["inputConfirmNewPassword"]) 	|| empty($_POST["inputConfirmNewPassword"]) == true ) {
			$_SESSION["notificationLevel"] = "danger";
			$_SESSION["notificationMessage"] = "Some information are missing";
			header('Location: ../resetpassword.php?username='.$_POST["inputUsername"]);
			mysqli_close($conn);
			exit();
    }
	
	if ($_POST["inputNewPassword"] != $_POST["inputConfirmNewPassword"]){
		$_SESSION["notificationLevel"] = "danger";
		$_SESSION["notificationMessage"] = "The new password should equal to new confirm password";
		header('Location: ../resetpassword.php?username='.$_POST["inputUsername"]);
		mysqli_close($conn);
		exit();
	}
	
	$username = mysqli_real_escape_string($conn, $_POST["inputUsername"]);
	$newpassword = mysqli_real_escape_string($conn, $_POST["inputNewPassword"]);
	
	$sql = "SELECT username, secure_answer FROM onlineshop_user WHERE username = '$username' LIMIT 1";
	
	$result = mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($result) == 0){
		$_SESSION["notificationLevel"] = "danger";
		$_SESSION["notificationMessage"] = "Wrong username";
		header('Location: ../forgetpassword.php');
		mysqli_close($conn);
		exit();
	}else{
		$row = mysqli_fetch_assoc($result);
		if($row['secure_answer'] != $_POST["inputSecureAnswer"]){
			$_SESSION["notificationLevel"] = "danger";
			$_SESSION["notificationMessage"] = "Wrong secure answer";
			header('Location: ../forgetpassword.php');
			mysqli_close($conn);
			exit();
		}else{
			$hashed_new_password = password_hash($newpassword, PASSWORD_DEFAULT);
			$sql = "UPDATE onlineshop_user SET password = '$hashed_new_password' WHERE username = '$username'";
			if(mysqli_query($conn, $sql)){
				$_SESSION["notificationLevel"] = "success";
				$_SESSION["notificationMessage"] = "Reset password successfully";
				header('Location: ../login.php');
				mysqli_close($conn);
				exit();				
			}else{
				$_SESSION["notificationLevel"] = "danger";
				$_SESSION["notificationMessage"] = "Fail to reset password";
				header('Location: ../reset.php');
				mysqli_close($conn);
				exit();				
			}
			
		}
	}

	mysqli_close($conn);
?>