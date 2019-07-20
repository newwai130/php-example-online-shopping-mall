<?php
	require "common_function.php";
	
	logic_require_login();
	
	if (!isset($_POST["inputName"]) 	|| empty($_POST["inputName"]) == true ||
		!isset($_POST["inputBirthday"]) || empty($_POST["inputBirthday"]) == true ||
		!isset($_POST["inputContact"]) 	|| empty($_POST["inputContact"]) == true ||
		!isset($_POST["inputEmail"]) 	|| empty($_POST["inputEmail"]) == true ||
		!isset($_POST["inputSecureQuestion"]) || empty($_POST["inputSecureQuestion"]) == true ||
		!isset($_POST["inputSecureAnswer"])   || empty($_POST["inputSecureAnswer"]) == true) {
			$_SESSION["notificationLevel"] = "danger";
			$_SESSION["notificationMessage"] = "Some registration information are missing";
			header('Location: ../modifypersonalinformation.php');
			mysqli_close($conn);
			exit();
    }
	
	$name 		= mysqli_real_escape_string($conn, $_POST["inputName"]);
	$birthday 	= mysqli_real_escape_string($conn, $_POST["inputBirthday"]);
	$contact 	= mysqli_real_escape_string($conn, $_POST["inputContact"]);
	$email 		= mysqli_real_escape_string($conn, $_POST["inputEmail"]);
	$secureQuestion = mysqli_real_escape_string($conn, $_POST["inputSecureQuestion"]);
	$secureAnswer 	= mysqli_real_escape_string($conn, $_POST["inputSecureAnswer"]);
	
	$username = $_SESSION['username'];
	
	$sql = "UPDATE onlineshop_user
			SET name = '$name', birthday = '$birthday', contact = '$contact', email = '$email', secure_question = '$secureQuestion', secure_answer = '$secureAnswer'
			WHERE username = '$username'";

	if (mysqli_query($conn, $sql)) {
		$_SESSION["notificationLevel"] = "success";
		$_SESSION["notificationMessage"] = "Success to update personal inforamtion";
		header('Location: ../myaccount.php');
		mysqli_close($conn);
		exit();
	} else {
		$_SESSION["notificationLevel"] = "danger";
		$_SESSION["notificationMessage"] = "Fail to update personal inforamtion";
		header('Location: ../myaccount.php');
		mysqli_close($conn);
		exit();
	}

	mysqli_close($conn);
?>