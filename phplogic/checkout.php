
<?php
	require "common_function.php";
	
	logic_require_login();
	
	if (!isset($_POST["inputAddress"]) 	|| empty($_POST["inputAddress"]) == true ||
		!isset($_POST["inputCreditCardNumber"]) || empty($_POST["inputCreditCardNumber"]) == true ||
		!isset($_POST["inputCreditCardPinCode"]) 	|| empty($_POST["inputCreditCardPinCode"]) == true ) {
			$_SESSION["notificationLevel"] = "danger";
			$_SESSION["notificationMessage"] = "Delivery or Credit Card information is missing";
			header('Location: ../cart.php');
			mysqli_close($conn);
			exit();
    }
	
	if(!ctype_digit($_POST["inputCreditCardNumber"]) || strlen($_POST["inputCreditCardNumber"])!= 16){
		$_SESSION["notificationLevel"] = "danger";
		$_SESSION["notificationMessage"] = "Invalid credit card number";
		header('Location: ../cart.php');
		mysqli_close($conn);
		exit();
	}
	
	if(!ctype_digit($_POST["inputCreditCardPinCode"]) || strlen($_POST["inputCreditCardPinCode"])!= 3){
		$_SESSION["notificationLevel"] = "danger";
		$_SESSION["notificationMessage"] = "Invalid pin code";
		header('Location: ../cart.php');
		mysqli_close($conn);
		exit();
	}
	
	$userid = $_SESSION['userid'];
	$address = $_POST["inputAddress"];
	$creditCardNumber = $_POST["inputCreditCardNumber"];
	$creditCardPinCode = $_POST["inputCreditCardPinCode"];
	$time = date('Y-m-d H:i:s');
	
	$sql = "SELECT user_id, product_id, quantity FROM onlineshop_cart WHERE user_id='$userid'";
	$result = mysqli_query($conn, $sql);
	if( mysqli_num_rows($result) == 0){
		header('Location: ../cart.php');
		mysqli_close($conn);
		
	}
	
	$sql = "INSERT INTO onlineshop_purchase (time, user_id, credit_card_number, credit_card_pin, address) VALUES ('$time', '$userid', '$creditCardNumber', '$creditCardPinCode', '$address')";
	$result = mysqli_query($conn, $sql);
	
	$sql = "SELECT id FROM onlineshop_purchase WHERE user_id = '$userid' ORDER BY time DESC limit 1";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	
	$purchaseid = $row['id'];
	
	$sql = "SELECT user_id, product_id, onlineshop_cart.quantity, price FROM onlineshop_cart, onlineshop_product WHERE user_id = '$userid' AND product_id = id";
	$results = mysqli_query($conn, $sql);
	foreach($results as $result){
		$temp_user_id = $result['user_id'];
		$temp_product_id = $result['product_id'];
		$temp_quantity = $result['quantity'];
		$temp_price = $result['price'];
		$sql = "DELETE FROM onlineshop_cart WHERE user_id = '$temp_user_id' AND product_id = '$temp_product_id' AND quantity = '$temp_quantity'";
		$result = mysqli_query($conn, $sql);
		$sql = "INSERT INTO onlineshop_product_in_purchase(purchase_id, product_id, quantity, price) VALUES('$purchaseid', '$temp_product_id', '$temp_quantity', '$temp_price')";
		$result = mysqli_query($conn, $sql);
		$sql = "UPDATE onlineshop_product SET quantity = quantity - '$temp_quantity' WHERE id = '$temp_product_id'";
		$result = mysqli_query($conn, $sql);
		echo $sql;
	}
	
	$_SESSION["notificationLevel"] = "success";
	$_SESSION["notificationMessage"] = "You successfully make the order";
	header('Location: ../history.php');
	mysqli_close($conn);
	exit();
?>