<?
    require "common_function.php";
	
	logic_require_login();
	
	if (!isset($_GET["productID"]) || empty($_GET["productID"]) == true) {
			$_SESSION["notificationLevel"] = "danger";
			$_SESSION["notificationMessage"] = "Some product information are missing";
			header('Location: ../product.php');
			mysqli_close($conn);
			exit();
    }
	
	$user_id 	= $_SESSION['userid'];
    $product_id = $_GET['productID'];
	
	$sql = "DELETE FROM onlineshop_cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
    if ( mysqli_query($conn, $sql)) {
		$_SESSION["notificationLevel"] = "success";
		$_SESSION["notificationMessage"] = "Delete product from cart successfully";
        header('Location: ../cart.php');
		mysqli_close($conn);
		exit();
    }else{
		$_SESSION["notificationLevel"] = "danger";
		$_SESSION["notificationMessage"] = "Fail to delete product from cart";
        header('Location: ../cart.php');
		mysqli_close($conn);
		exit();
	}
?>