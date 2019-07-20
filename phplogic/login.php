<?php
	require "common_function.php";

	if (!isset($_POST["inputUsername"]) || empty($_POST["inputUsername"]) == true ||
		!isset($_POST["inputPassword"]) || empty($_POST["inputPassword"]) == true) {
			$_SESSION["notificationLevel"] = "danger";
			$_SESSION["notificationMessage"] = "Fail to login, incorrect username or password";
			header('Location: ../login.php');
			mysqli_close($conn);
			exit();
    }
	
	$username 	= mysqli_real_escape_string($conn, $_POST["inputUsername"]);
	$password 	= mysqli_real_escape_string($conn, $_POST["inputPassword"]);
	
	$sql = "SELECT id, username, password, role FROM onlineshop_user where username='$username' limit 1";
	$result = mysqli_query($conn, $sql);
	

	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_assoc($result);
		if(password_verify($password,$row['password'])){
			$_SESSION["notificationLevel"] = "success";
			$_SESSION["notificationMessage"] = "Login successfully";
			$_SESSION['userid'] = $row['id'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['role'] = $row['role'];
			header('Location: ../home.php');
			mysqli_close($conn);
			exit();
		}else{
			$_SESSION["notificationLevel"] = "danger";
			$_SESSION["notificationMessage"] = "Fail to login, wrong password";
			header('Location: ../login.php');
			mysqli_close($conn);
			exit();
		}
	} else {
		$_SESSION["notificationLevel"] = "danger";
		$_SESSION["notificationMessage"] = "Fail to login, wrong password";
		header('Location: ../login.php');
		mysqli_close($conn);
		exit();
	}

	mysqli_close($conn);
?>