<?
    require "common_function.php";
	
	logic_require_login();
	
	if (!isset($_POST["inputProductID"]) || empty($_POST["inputProductID"]) == true ||
		!isset($_POST["inputQuantity"]) || empty($_POST["inputQuantity"]) == true) {
			$_SESSION["notificationLevel"] = "danger";
			$_SESSION["notificationMessage"] = "Some product information are missing";
			header('Location: ../product.php');
			mysqli_close($conn);
			exit();
    }
	
	$user_id 	= $_SESSION['userid'];
    $product_id = $_POST['inputProductID'];
    $quantity 	= $_POST['inputQuantity'];
	
	
    $sql = "SELECT user_id, product_id, quantity FROM onlineshop_cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
	$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
		$sql = "UPDATE onlineshop_cart SET quantity = quantity + '$quantity' WHERE user_id = '$user_id' AND product_id = '$product_id'";
		$result = mysqli_query($conn, $sql);
		$_SESSION["notificationLevel"] = "success";
		$_SESSION["notificationMessage"] = "Add to cart successfully";
        header('Location: ../productdetail.php?id='.$product_id);
		mysqli_close($conn);
		exit();
    }else{
		$sql = "INSERT INTO onlineshop_cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";
		$result = mysqli_query($conn, $sql);
		$_SESSION["notificationLevel"] = "success";
		$_SESSION["notificationMessage"] = "Add to cart successfully";
		header('Location: ../productdetail.php?id='.$product_id);
		mysqli_close($conn);
		exit();
	};
?>