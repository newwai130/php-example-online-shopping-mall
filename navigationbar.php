<?php
	if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	<div class="container">
		
		<a class="navbar-brand" href="home.php">
			<img alt="Brand" src="image/logo.png" style="height: 30px; width: 90px;"> BoardGame
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item <!--active-->">
					<a class="nav-link" href="home.php">Home
						<!-- <span class="sr-only">(current)</span> -->
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="product.php">Product</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="cart.php">Shopping Cart</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="history.php">Purchasing History</a>
				</li>
				<?php if(isset($_SESSION['username']) && empty($_SESSION['username']) == false): ?>
					<li class="nav-item">
						<a class="nav-link" href="myaccount.php">My Account(<?php echo $_SESSION['username'];?>)</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="phplogic/logout.php">Logout</a>
					</li>
				<?php else: ?>
				<li class="nav-item">
					<a class="nav-link" href="login.php">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="register.php">Register</a>
				</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</nav>