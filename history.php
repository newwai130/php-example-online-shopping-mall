<?php
	require "phplogic/common_function.php";
	
	view_require_login();
	
	$userid = $_SESSION['userid'];
	$sql = "SELECT id, time FROM onlineshop_purchase WHERE user_id = '$userid' ORDER BY id DESC";
	$purchases = mysqli_query($conn, $sql);
	$number_of_purchase = mysqli_num_rows($purchases);
	if( $number_of_purchase == 0){
		$_SESSION["notificationLevel"] = "warning";
		$_SESSION["notificationMessage"] = "Your purchase history is empty";
	}
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Purchase History</title>

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
			Fancy Board Game / Purchase History
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
							</tr>
						</thead>
						<tbody>
						<?php
							foreach($purchases as $purchase){
								$purchaseID = $purchase['id'];
						?>
								<tr>
									<th scope="row"></th>
									<th colspan="3"><?php echo "Purchase ID: ".$purchase['id']."&ensp;&ensp;&ensp;&ensp;&ensp;Time: ".$purchase['time']?></th>
								</tr>
						<?php
								$total_price = 0;
								$sql = "SELECT a.product_id as product_id, b.name as name, a.quantity as quantity, a.price as price FROM onlineshop_product_in_purchase a, onlineshop_product b WHERE a.purchase_id = '$purchaseID' AND a.product_id = b.id";
								$results = mysqli_query($conn, $sql);
								foreach($results as $result){
						?>
						<tr>
							<th scope="row"></th>
							<td><a href="productdetail?id=<?php echo $result['product_id'];?>"><?php echo $result['name'];?></a></td>
							<td>$<?php echo $result['price'];?></td>
							<td><?php echo $result['quantity'];?></td>
						</tr>
						<tr></tr>
						<?php 
									$total_price = $total_price + $result['price'] * $result['quantity'];
								}
							}
						?>
						</tbody>
					</table>
				</div>
				
			</div>
			<!-- /.col-lg-9 -->
			
         </div>
         <!-- /.row -->

    </div>
    <!-- /.container -->  

    <?php include "footer.php"?>

</body>
</html>
