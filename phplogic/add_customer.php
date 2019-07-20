<?php
	require "common_function.php";
	
	if (!isset($_POST["inputUsername"]) || empty($_POST["inputUsername"]) == true ||
		!isset($_POST["inputPassword"]) || empty($_POST["inputPassword"]) == true ||
		!isset($_POST["inputName"]) 	|| empty($_POST["inputName"]) == true ||
		!isset($_POST["inputBirthday"]) || empty($_POST["inputBirthday"]) == true ||
		!isset($_POST["inputContact"]) 	|| empty($_POST["inputContact"]) == true ||
		!isset($_POST["inputEmail"]) 	|| empty($_POST["inputEmail"]) == true ||
		!isset($_POST["inputSecureQuestion"]) || empty($_POST["inputSecureQuestion"]) == true ||
		!isset($_POST["inputSecureAnswer"])   || empty($_POST["inputSecureAnswer"]) == true) {
			$_SESSION["notificationLevel"] = "danger";
			$_SESSION["notificationMessage"] = "Some registration information are missing";
			header('Location: ../register.php');
			mysqli_close($conn);
			exit();
    }
	
	$username 	= mysqli_real_escape_string($conn, $_POST["inputUsername"]);
	$password 	= mysqli_real_escape_string($conn, $_POST["inputPassword"]);
	$name 		= mysqli_real_escape_string($conn, $_POST["inputName"]);
	$birthday 	= mysqli_real_escape_string($conn, $_POST["inputBirthday"]);
	$contact 	= mysqli_real_escape_string($conn, $_POST["inputContact"]);
	$email 		= mysqli_real_escape_string($conn, $_POST["inputEmail"]);
	$secureQuestion = mysqli_real_escape_string($conn, $_POST["inputSecureQuestion"]);
	$secureAnswer 	= mysqli_real_escape_string($conn, $_POST["inputSecureAnswer"]);
	$role			= mysqli_real_escape_string($conn, "customer");
	
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	
	//check whether username is unique
	$sql = "SELECT username, password FROM onlineshop_user WHERE username = '$username'";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0){
		$_SESSION["notificationLevel"] = "danger";
		$_SESSION["notificationMessage"] = "Sorry, the usernmae has been registered by other";
		header('Location: ../register.php');
		mysqli_close($conn);
		exit();
	}
	
	$sql = "INSERT INTO onlineshop_user(username, password, name, birthday, contact, email, role, secure_question, secure_answer)
			VALUES('$username','$hashed_password','$name','$birthday','$contact','$email','$role', '$secureQuestion','$secureAnswer')";

	if (mysqli_query($conn, $sql)) {
		$_SESSION["notificationLevel"] = "success";
		$_SESSION["notificationMessage"] = "Success to create account";
		header('Location: ../login.php');
		mysqli_close($conn);
		exit();
	} else {
		$_SESSION["notificationLevel"] = "danger";
		$_SESSION["notificationMessage"] = "Fail to create account";
		header('Location: ../register.php');
		mysqli_close($conn);
		exit();
	}

	mysqli_close($conn);
?>