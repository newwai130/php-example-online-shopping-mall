<?php
	require "phplogic/connect_mysql.php";
	
	if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
	
	
	//if no id element, redirect to product page
	if(!isset($_GET['id']) || empty($_GET['id'])==true){
		header('Location: product.php');
		mysqli_close($conn);
		exit();
	}
	
	$id = $_GET['id'];
	$sql = "SELECT id, image_url1, image_url2, name, price, quantity, description FROM onlineshop_product WHERE id = '$id'";
	$result = mysqli_query($conn, $sql);
	
	//exit if no product is found
	if(mysqli_num_rows($result) == 0){
		$_SESSION["notificationLevel"] = "warning";
		$_SESSION["notificationMessage"] = "No product is found";
		header('Location: product.php');
		mysqli_close($conn);
		exit();
	}else{
		$row = mysqli_fetch_assoc($result);
		$id 		= $row['id'];
		$image_url 	= $row['image_url1'];
		$image_url2  = $row['image_url2'];
		$name 		= $row['name'];
		$price 		= $row['price'];
		$quantity 	= $row['quantity'];
		$description = $row['description'];
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Product</title>

    <!-- Bootstrap core CSS <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="css/common.css" rel="stylesheet">
	
	<!-- Searchbar for this template -->
    <link href="css/searchbar.css" rel="stylesheet">
	
	<!-- Product for this template -->
    <link href="css/detail.css" rel="stylesheet">
	
	<link href="css/font-awesome.min.css" rel="stylesheet">

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
			Fancy Board Game / Product / <?php echo $name;?>
		</h2>	
		
		<div class="row">
			<div class="col-lg-3" style="margin-top:20px">
				<?php include 'searchandcategarybar.php';?>
			</div>
			<!-- /.col-lg-3 -->

			<div class="col-lg-9">
				<div class="row">	
					<div class="col-12 col-lg-7">
						<div class="single_product_thumb">
							<div id="product_details_slider" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<div id="photo1" class="carousel-item active">
										<!-- <a class="gallery_img" href="<?php echo $image_url;?>"> -->
											<img class="d-block w-100" src="<?php echo $image_url;?>" alt="First slide">
										<!-- </a> -->
									</div>
									<div id="photo2" class="carousel-item">
										<!-- <a class="gallery_img" href="<?php echo $image_url2;?>"> -->
											<img class="d-block w-100" src="<?php echo $image_url2;?>" alt="First slide">
										<!-- </a> -->
									</div>
								</div>
									<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev" onclick="next_click()">
										<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									  </a>
									<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" onclick="next_click()">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								  </a>
							</div>
						</div>
					</div>	
			  
					<div class="col-12 col-lg-5">
						<div class="single_product_desc">
							<!-- Product Meta Data -->
							<div class="product-meta-data">
								<div class="line"></div>
								<p class="product-price"><b>$<?php echo $price?></b></p>
								<a href="product-details.php">
									<h6><b><?php echo $name?></b></h6>
								</a>
						
								<!-- Ratings & Review -->
								<div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
									<div class="ratings">
										<i class="fa fa-star" aria-hidden="true" style="color:#ffb601;"></i>
										<i class="fa fa-star" aria-hidden="true" style="color:#ffb601;"></i>
										<i class="fa fa-star" aria-hidden="true" style="color:#ffb601;"></i>
										<i class="fa fa-star" aria-hidden="true" style="color:#ffb601;"></i>
										<i class="fa fa-star" aria-hidden="true" style="color:#ffb601;"></i>
									</div>
									<div class="review">
										<a href="#">Write A Review</a>
									</div>
								</div>
								<!-- Avaiable -->
								<?php if($quantity>0): ?>
									<p class="avaibility"  style="color:#00e04b;"><i class="fa fa-circle"></i><b> In Stock</b></p>
								<?php else:?>
									<p class="avaibility"  style="color:#ff3333;"><i class="fa fa-circle"></i><b> Out of Stock</b></p>
								<?php endif;?>
							</div>

							<!-- Overview of the product -->
							<div class="short_overview my-5">
								<p><?php echo $description?></p>
							</div>

							<!-- Add to Cart Form -->
							<form class="cart clearfix" action="phplogic/add_cart.php" method="post">
								<div class="cart-btn d-flex mb-10">
									<p>Quantity</p>
									<div class="quantity">
										<?php if($quantity>0): ?>
											<input type="number" class="qty-text" id="inputQuantity" name="inputQuantity" step="1" min="1" max="<?php echo $quantity?>" name="quantity" value="1">
										<?php else:?>
											<input type="number" class="qty-text" id="inputQuantity" name="inputQuantity" step="1" name="quantity" value="1" readonly>
										<?php endif;?>
									</div>
								</div>
								<?php if($quantity>0): ?>
									<button type="submit" name="addtocart" value="5" class="btn amado-btn">Add to cart</button>
								<?php else:?>
									<button type="submit" name="addtocart" value="5" class="btn amado-btn" style="background-color: #b1bfcc" disabled>Add to cart</button>
								<?php endif;?>
								
								<input type="hidden" name="inputProductID" value="<?php echo "$id"?>">
							</form>
						</div>
					</div>
				</div>
				<!-- /.row -->
			</div>
			<!-- /.col-lg-9 -->
		</div>
		<!-- /.row -->
    </div>
    <!-- /.container -->
	
    <?php include "footer.php"?>
	<script>
		function next_click(){
			photo1 = document.getElementById("photo1");
			photo2 = document.getElementById("photo2");
			if(photo1.classList.contains('active')){
				photo1.classList.remove('active')
				photo2.classList.add('active')
			}else if(photo2.classList.contains('active')){
				photo2.classList.remove('active')
				photo1.classList.add('active')
			}
		}
	</script>

</body>
</html>
