<div class="search-container">
	<form action="product.php" method="GET">
		<input type="text" placeholder="Search" name="productName">
		<button type="submit" style="padding: 0px"><img alt="search" src="image/search.png" style="width: 25px; height: 25px;"/></>
	</form>
</div>

<div class="list-group">
	<a href="product.php" class="list-group-item">All</a>
    <text class="list-group-item"><b>Nature</b></text>
	<a href="product.php?categoryName=nature&categoryValue=strategy" class="list-group-item">Strategy</a>
	<a href="product.php?categoryName=nature&categoryValue=party" class="list-group-item">Party</a>
	<a href="product.php?categoryName=nature&categoryValue=family" class="list-group-item">Family</a>
	<text class="list-group-item"><b>Difficulty</b></text>
	<a href="product.php?categoryName=difficulty&categoryValue=easy" class="list-group-item">Easy</a>
	<a href="product.php?categoryName=difficulty&categoryValue=moderate" class="list-group-item">Moderate</a>
	<a href="product.php?categoryName=difficulty&categoryValue=difficult" class="list-group-item">Difficult</a>
</div>