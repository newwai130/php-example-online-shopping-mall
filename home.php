<?php
	require "phplogic/common_function.php";
	
	//default product detail url
	$product_detail_url = "https://www2.comp.polyu.edu.hk/~15081243d/COMP2121/project/productdetail.php";
	
	$sql = "SELECT id, image_url1, name, price, quantity, description 
			FROM onlineshop_product 
			WHERE id in ( SELECT product_id FROM
				(SELECT product_id, SUM(quantity) as total_quantity
				FROM onlineshop_product_in_purchase
				GROUP BY product_id
				ORDER BY total_quantity DESC
				LIMIT 5) 
			as id)";
	
	$results = mysqli_query($conn, $sql);
	$numberOfRecord = mysqli_num_rows($results);
	
	
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home</title>

    <!-- Bootstrap core CSS <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="css/common.css" rel="stylesheet">
	
	<!-- Searchbar for this template -->
    <link href="css/searchbar.css" rel="stylesheet">
	
	<!-- Signin for this template -->
    <link href="css/signin.css" rel="stylesheet">
	
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
		Fancy Board Game / Home
      </h2>	
      <div class="row">

        <div class="col-lg-3" style="margin-top:20px">
			<?php include 'searchandcategarybar.php';?>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="image/homepage.jpg" alt="First slide">
              </div>
            </div>
          </div>
		
		<h3 style="margin-bottom: 20px;" > Popular product</h3>
		
          <div class="row">
			
			  <?php foreach($results as $result):?>
			  <div class="col-lg-4 col-md-6 mb-4">
				<div class="card h-100">
					<a href="<?php echo $product_detail_url.'?id='.$result['id']?>"><img class="card-img-top" src="<?php echo $result['image_url1']?>" alt=""></a>
					<div class="card-body">
						<h4 class="card-title">
							<a href="<?php echo $product_detail_url.'?id='.$result['id']?>";><?php echo $result['name']?></a>
						</h4>
						<h5>$<?php echo $result['price']?></h5>
					  <p class="card-text"><?php echo $result['description']?></p>
					</div>
					<div class="card-footer">
					  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
					</div>
				</div>
				</div>
			  <?php endforeach; ?>

          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <?php include "footer.php"?>

</body>
</html>
