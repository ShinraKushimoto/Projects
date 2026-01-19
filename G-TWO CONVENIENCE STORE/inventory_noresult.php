<?php

if(!isset($_SESSION)) {
	session_start();
}

if(isset($_SESSION['User']) && $_SESSION['User'] == "Admin"  || $_SESSION['User'] == "Manager") {
	echo "";
	} else {
		echo header("Location: products.php");
}

include_once("connections/connection.php");

$con = connection();

$sql = "SELECT * FROM store_prod_inventory ORDER BY prod_id DESC";
$table = $con->query($sql) or die ($con->error);
$row = $table->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>G-TWO Conveniece Store</title>

	<!-- boostrap css-->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
	<!-- end of boostrap css-->

</head>
<body>
	<!-- navbar -->
	<?php include 'navbar.php' ?>	
	<!-- end of navbar -->

	<!-- jumbotron -->
	<div class="container text-center mt-3 mb-4 p-3 border shadow bg-secondary text-white rounded h1">INVENTORY LIST</div>
	<!-- end of jumbotron -->

	<!-- add button -->
	<div class="container mb-3 p-0">
		<form class="d-flex" action="inventory_result.php" method="GET">
			<div class="pe-2">
				<a class="btn btn-danger text-decoration-none text-white mb-1" href="products.php"><i class='bi bi-caret-left'></i>BACK</a>
				<a class="btn btn-secondary text-decoration-none text-white mb-1" href="add.php"><i class='bi bi-plus-square'></i> NEW PRODUCT</a>
			</div>
			<input class="w-25 ms-auto form-control me-2 mb-1" type="text" name="search1" id="search1">
			<button class="btn btn-outline-secondary me-2 mb-1" type="sumbit" name="query">Search</button>
			<a class="btn btn-outline-secondary pe-3 ps-3 mb-1" href="inventory.php">Clear</a>
		</form>
	</div>
	<!-- end of add button -->

	<!-- table -->
	<div class="container border shadow-lg p-2 bg-body rounded text-center table-responsive">
		<div class="row">
			<div class="col">
				<h5>No Results Found</h5>
			</div>
		</div>
	</div>
	<!-- end of table -->

</body>

<!-- bootstrap javascript OFFLINE-->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<!-- end of bootstrap javascript OFFLINE-->

</html>