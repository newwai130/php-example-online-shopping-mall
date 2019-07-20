<?php
	require_once "connect_mysql.php";
	
	if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
	
	function view_require_login() {
        if(!isset($_SESSION['username']) || empty($_SESSION['username']) == true || !isset($_SESSION['userid']) || empty($_SESSION['userid']) == true || !isset($_SESSION['role']) || empty($_SESSION['role']) == true){
			$_SESSION["notificationLevel"] = "warning";
			$_SESSION["notificationMessage"] = "Please login first";
			header('Location: login.php');
			mysqli_close($conn);
			exit();
		}
    }
	
	function logic_require_login(){
		if(!isset($_SESSION['username']) || empty($_SESSION['username']) == true || !isset($_SESSION['userid']) || empty($_SESSION['userid']) == true || !isset($_SESSION['role']) || empty($_SESSION['role']) == true){
			$_SESSION["notificationLevel"] = "warning";
			$_SESSION["notificationMessage"] = "Please login first";
			header('Location: ../login.php');
			mysqli_close($conn);
			exit();
		}
	}
	
	function is_login(){
		if(isset($_SESSION['username']) && empty($_SESSION['username']) == false && isset($_SESSION['userid']) && empty($_SESSION['userid']) == true && isset($_SESSION['role']) && empty($_SESSION['role']) == false){
			return true;
		}else{
			return false;
		}
	}
?>