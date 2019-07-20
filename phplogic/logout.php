<?php
	require "common_function.php";
	
	if(isset($_SESSION['userid']) || empty($_SESSION['userid']) == false){
		unset($_SESSION['userid']);
	}
	
	if(isset($_SESSION['username']) || empty($_SESSION['username']) == false){
		unset($_SESSION['username']);
	}
	
	if(isset($_SESSION['role']) || empty($_SESSION['role']) == false){
		unset($_SESSION['role']);
	}
	
	$_SESSION["notificationLevel"] = "success";
	$_SESSION["notificationMessage"] = "You have logout the account";
	header('Location: ../home.php');
	exit();
?>