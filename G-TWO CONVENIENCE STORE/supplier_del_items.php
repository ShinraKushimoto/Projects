<?php

if(!isset($_SESSION)) {
	session_start();
}

if(isset($_SESSION['User']) && $_SESSION['User'] == "Admin" || $_SESSION['User'] == "Manager") {
	echo "";
	} else {
		echo header("Location: products.php");
}

include_once("connections/connection.php");

$con = connection();

$sql = "SELECT * FROM delivery_item_list ORDER BY delivery_prod_id DESC";
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
	<div class="container text-center mt-3 mb-4 p-3 border shadow bg-secondary text-white rounded h1">DELIVERY ORDER LIST</div>
	<!-- end of jumbotron -->

	<!-- search button -->
	<div class="container mb-3 p-0 pe-2">
		<a class="btn btn-danger text-decoration-none text-white mb-1" href="supplier.php"><i class='bi bi-caret-left'></i>BACK</a>
	</div>
	<!-- end of search button -->

	<!-- table -->
	<div class="container my-2 border shadow-lg p-3 bg-body rounded table-responsive">
		<div class="row">
			<div class="col">
				<table class="table table-striped table-hover">
					<thead class="h5">
						<tr>
							<th>Delivery SKU</th>	
							<th>Description</th>	
							<th>Cost</th>
							<th>Qunantity</th>	
							<th>Total Cost</th>	
							<th>Delivery Number</th>
						</tr>
					</thead>
					<tbody>	
						<?php do{ ?>
						<tr>
							<td><?php echo $row['delivery_prod_sku']; ?></td>
							<td><?php echo $row['delivery_prod_desc']; ?></td>
							<td><?php echo $row['delivery_prod_cost']; ?></td>
							<td><?php echo $row['delivery_prod_unit']; ?></td>
							<td><?php echo $row['delivery_tot_cost']; ?></td>
							<td><?php echo $row['supplier_order_num']; ?></td>
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
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<!-- end of bootstrap javascript OFFLINE-->

</html>