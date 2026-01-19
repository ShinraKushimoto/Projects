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
$search1 = $_GET['search1'];
$sql = "SELECT * FROM store_prod_inventory WHERE prod_sku LIKE '%$search1%' || prod_desc LIKE '%$search1%' || prod_status LIKE '%$search1%' || prod_price LIKE '%$search1%' || prod_quant LIKE '%$search1%' ORDER BY prod_id DESC";
$table = $con->query($sql) or die ($con->error);
$row = $table->fetch_assoc();
$result = $table->num_rows;

if ($result > 0){
	echo "";
}	else {
		echo header("Location: inventory_noresult.php");
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
<div class="container my-2 border shadow-lg p-3 bg-body rounded table-responsive">
		<div class="row">
			<div class="col">
				<table class="table table-striped table-hover">
					<thead class="h5">
						<tr>
							<th>SKU</th>	
							<th>Product Description</th>
							<th>Status</th>	
							<th>Price</th>
							<th>Stock</th>
							<th>Total Price</th>
							<th>Added</th>
							<th>Updated</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>	
						<?php do{ ?>
						<tr>
							<td><?php echo $row['prod_sku']; ?></td>
							<td><?php echo $row['prod_desc']; ?></td>
							<td><?php echo $row['prod_status']; ?></td>
							<td><?php echo "₱" . $row['prod_price']; ?></td>
							<td><?php echo $row['prod_quant']; ?></td>
							<td><?php echo "₱" . $row['prod_total_amount']; ?></td>
							<td>
								<?php
									$orgDate = $row['prod_date_added'];
									$newDate = date("Y-m-d", strtotime($orgDate)); 
									echo $newDate;
								?>
							</td>
							<td>
								<?php
									$orgDate = $row['prod_date_updated'];
									$newDate = date("Y-m-d", strtotime($orgDate)); 
									echo $newDate;
								?>
							</td>
							<td>
								<div class="">
									<a class="btn btn-secondary p-1 pe-2 ps-2" href="edit.php?ID=<?php echo $row['prod_id']; ?>" name="edit"><i class='bi bi-pen'></i></a>
									<button type="button" class="btn btn-danger p-1 pe-2 ps-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bi bi-trash3'></i>
									</button>

									<!-- delete modal -->
									<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLabel">DELETE</h5>
									        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									      </div>
									      <div class="modal-body">
									       	Are you sure to delete user?
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
									        <a class="btn btn-danger" href="delete.php?delete=<?php echo $row['prod_id']; ?>"data-bs-toggle="modal" data-bs-target="delete.php?delete=<?php echo $row['prod_id']; ?>">Yes</a>
									      </div>
									    </div>
									  </div>
									</div>
									<!-- end of delete modal -->

								</div>
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