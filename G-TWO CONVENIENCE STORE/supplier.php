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

$sql = "SELECT * FROM supplier_list ORDER BY supplier_id DESC";
$table = $con->query($sql) or die ($con->error);
$row = $table->fetch_assoc();

$result = $table->num_rows;

if ($result > 0){
	echo "";
}	else {
		echo header("Location: supplier_noresult.php");
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
	<?php require_once("navbar.php"); ?>
	<!-- end of navbar -->

	<!-- jumbotron -->
	<div class="container text-center mt-3 mb-4 p-3 border shadow bg-secondary text-white rounded h1">SUPPLIER LIST</div>
	<!-- end of jumbotron -->

	<!-- search button -->
	<div class="container mb-3 p-0">
		<form class="d-flex" action="supplier_result.php" method="GET">
			<div class="pe-2">
				<a class="btn btn-danger text-decoration-none text-white mb-1" href="products.php"><i class='bi bi-caret-left'></i>BACK</a>
			</div>
			<input class="w-25 ms-auto form-control me-2 mb-1" type="text" name="search1" id="search1">
			<button class="btn btn-outline-secondary me-2 mb-1" type="sumbit" name="query">Search</button>
			<a class="btn btn-outline-secondary pe-3 ps-3 mb-1" href="supplier.php">Clear</a>
		</form>
	</div>
	<!-- end of search button -->

	<!-- table -->
	<div class="container my-2 border shadow-lg p-3 bg-body rounded table-responsive">
		<div class="row">
			<div class="col">
				<table class="table table-striped table-hover">
					<thead class="h5">
						<tr>
							<th>Supplier No.</th>
							<th>Name</th>	
							<th>Contact</th>	
							<th>E-mail</th>
							<th>Address</th>
							<th>Delivery Date</th>
							<th>Updated</th>
							<th>Status</th>
							<th>Delivery No.</th>
						</tr>
					</thead>
					<tbody>	
						<?php do{ ?>
						<tr>
							<td><?php echo $row['supplier_id'];?></td>
							<td><?php echo $row['supplier_name']; ?></td>
							<td><?php echo $row['supplier_contact']; ?></td>
							<td><?php echo $row['supplier_email']; ?></td>
							<td><?php echo $row['supplier_address']; ?></td>
							<td>
								<?php
									$orgDate = $row['supplier_del_date'];
									$newDate = date("Y-m-d", strtotime($orgDate)); 
									echo $newDate;
								?>
							</td>
							<td>
								<?php
									$orgDate = $row['supplier_del_date'];
									$newDate = date("Y-m-d", strtotime($orgDate)); 
									echo $newDate;
								?>
							</td>
							<td><?php echo $row['supplier_del_status']; ?></td>
							<td><a class="btn btn-danger fw-bolder p-0 pe-4 ps-4" href="supplier_del_items.php"><i class="bi bi-box"></i> <?php echo $row['supplier_order_num']; ?></a>
							</td>
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