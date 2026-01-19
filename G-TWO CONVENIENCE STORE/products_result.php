<?php

if(!isset($_SESSION)) {
	session_start();
}

include_once("connections/connection.php");

$con = connection();
$search = $_GET['search'];
$sql = "SELECT * FROM store_prod_inventory WHERE prod_sku LIKE '%$search%' || prod_desc LIKE '%$search%' || prod_status LIKE '%$search%' || prod_price LIKE '%$search%' || prod_quant LIKE '%$search%' ORDER BY prod_id DESC";
$table = $con->query($sql) or die ($con->error);
$row = $table->fetch_assoc();
$result = $table->num_rows;

if ($result > 0){
	echo "";
}	else {
		echo header("Location: products_noresult.php");
	}


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
	<div class="container text-center mt-3 mb-4 p-3 border shadow bg-secondary text-white rounded h1">PRODUCT LIST</div>
	<!-- end of jumbotron -->

	<!-- add button -->
	<div class="container mb-3 p-0">
		<form class="d-flex" action="products_result.php" method="GET">
			<a class="btn btn-secondary text-decoration-none text-white mb-1 me-2" href="inventory.php"><i class='bi bi-clipboard-data'></i> INVENTORY FULL DETAILS</a>
			<input class="w-25 ms-auto form-control me-2 mb-1" type="text" name="search" id="search">
			<button class="btn btn-outline-secondary me-2 mb-1" type="sumbit" name="query">Search</button>
			<a class="btn btn-outline-secondary pe-3 ps-3 mb-1" href="products.php">Clear</a>
		</form>
	</div>
	<!-- end of add button -->

	<!-- table -->
	<div class="container my-2 border shadow-lg p-3 bg-body rounded table-responsive">
		<div class="row">
			<div class="col">
				<table class="table table-striped table-hover">
					<thead class="h5">
						<tr>
							<th>SKU</th>
							<th></th>	
							<th></th>	
							<th></th>
							<th></th>	
							<th></th>	
							<th></th>
							<th>Description</th>
							<th>Price</th>
							<th></th>
							<th></th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php do{ ?>
						<tr>
							<td><?php echo $row['prod_sku']; ?></td>
							<th></th>	
							<th></th>
							<th></th>
							<th></th>	
							<th></th>	
							<th></th>
							<td><?php echo $row['prod_desc']; ?></td>
							<td><?php echo "₱" . $row['prod_price']; ?></td>
							<th></th>
							<td></td>
							<td><?php echo $row['prod_status']; ?></td>
						</tr>
						<?php }while($row = $table->fetch_assoc()); ?>
					</tbody>	
				</table>
			</div>
		</div>
	</div>
	<!-- end of table -->

</body>

<!-- bootstrap javascript OFFLINE-->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- end of bootstrap javascript OFFLINE-->

</html>