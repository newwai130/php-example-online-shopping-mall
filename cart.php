<?php
	require "phplogic/common_function.php";
	
	view_require_login();
	
	$userid = $_SESSION['userid'];
	$sql = "SELECT a.user_id as user_id, a.product_id as product_id, a.quantity as cart_quantity, b.name as name, b.price as price, b.quantity as proudct_quantity FROM onlineshop_cart a, onlineshop_product b WHERE a.user_id = '$userid' AND a.product_id = b.id";
	$results = mysqli_query($conn, $sql);
	$number_of_product = mysqli_num_rows($results);
	if( $number_of_product == 0){
		$_SESSION["notificationLevel"] = "warning";
		$_SESSION["notificationMessage"] = "Your cart is empty";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shopping Cart</title>

    <!-- Bootstrap core CSS <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="css/common.css" rel="stylesheet">
	
	<!-- Searchbar for this template -->
    <link href="css/searchbar.css" rel="stylesheet">
	
	<!-- Signin for this template -->
    <link href="css/cart.css" rel="stylesheet">
</head>
<body>

    <?php include 'navigationbar.php';?>

	<?php if(isset($_SESSION['notificationLevel']) && isset($_SESSION['notificationMessage']) && $_SESSION['notificationLevel'] != "" && $_SESSION['notificationMessage'] != ""): ?>
		<div class="cointainer">
			<div class="alert alert-<?php echo $_SESSION['notificationLevel'];?>">
			<strong><?php echo $_SESSION['notificationLevel'];?>!</strong> <?php echo $_SESSION['notificationMessage'];?>
			</div>
		</div>
		
	<?php 
		$_SESSION['notificationLevel'] = "";
		$_SESSION['notificationMessage'] = "";
		endif; 
	?>
	
    <!-- Page Content -->
    <div class="container">
		
		<h2 class="my-4" style="font-size:1rem;">
		Fancy Board Game / Shopping Cart
		</h2>	
		
		<div class="row">
			<div class="col-lg-3" style="margin-top:20px">
				<?php include 'searchandcategarybar.php';?>
			</div>
			<!-- /.col-lg-3 -->

			<div class="col-lg-9">
				<div class="cart-table">
					<table class="table">
						<thead>
							<tr>
								<th scope="col"></th>
								<th scope="col">Name</th>
								<th scope="col">Price</th>
								<th scope="col">Quantity</th>
								<th scope="col">Delete</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$total_price = 0;
							foreach($results as $result):
						?>
							<tr>
								<th scope="row"></th>
								<td><a href="productdetail?id=<?php echo $result['product_id'];?>"><?php echo $result['name'];?></a></td>
								<td>$<?php echo $result['price'];?></td>
								<td><?php echo $result['cart_quantity'];?></td>
								<td><a href="phplogic/delete_cart.php?productID=<?php echo $result['product_id'];?>"><button type="button" class="btn btn-danger" style="padding:2px;">Delete</button></a></td>
							</tr>
						<?php 
							$total_price = $total_price + $result['price'] * $result['cart_quantity'];
							endforeach;
						?>
						</tbody>
					</table>
				</div>
				
				<?php if( $number_of_product > 0): ?>
					<form action="phplogic/checkout.php" method="POST">
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Total Price</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="inputTotalPrice" name="inputTotalPrice" value="$<?php echo $total_price?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Deliver Address</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Enter Address" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Credit Card Number</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="inputCreditCardNumber" name="inputCreditCardNumber" placeholder="Enter Credit Card Number" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Credit Card Pin Code</label>
							<div class="col-sm-4">
								<input type="password" class="form-control" id="inputCreditCardPinCode"  name="inputCreditCardPinCode" placeholder="Enter Credit Card Pin Code" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label"></label>
							<div class="col-sm-4">
								<button type="submit" class="btn btn-primary">Check out</button>
							</div>
						</div>
					</form>
				<?php endif;?>
			</div>
        </div>
        <!-- /.row -->

     </div>
     <!-- /.container -->

    <?php include "footer.php"?>
</body>
</html>
