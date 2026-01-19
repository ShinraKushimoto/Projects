<?php

if(!isset($_SESSION)) {
	session_start();
}

if(isset($_SESSION['User']) && $_SESSION['User'] == "Admin" || $_SESSION['User'] == "Manager" || $_SESSION['User'] == "Cashier"  || $_SESSION['User'] == "Employee") {
	echo "";
	} else {
		echo header("Location: products.php");
}

include_once("connections/connection.php");
$con = connection(); 


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
	<div class="container text-center mt-3 mb-4 p-3 border shadow bg-secondary text-white rounded h1">SALES</div>
	<!-- end of jumbotron -->

	<!-- table -->
	<div class="container my-2 border shadow p-3 bg-body rounded table-responsive">
		<div class="row">
			<div class="col">
				<table class="table table-striped table-hover">
					<thead class="h5">
						<th>Date</th>
						<th>Customer</th>
						<th>Total Sales</th>
						<th>Details</th>
					</thead>
					<tbody>
						<?php 
							$sql="select * from purchase order by purchase_id desc";
							$query=$con->query($sql);
							while($row=$query->fetch_array()){
								?>
								<tr>
									<td><?php echo date('M d, Y h:i A', strtotime($row['date_purchase'])) ?></td>
									<td><?php echo $row['customer']; ?></td>
									<td class="text-right">&#8369; <?php echo number_format($row['total'], 2); ?></td>
									<td><a href="#details<?php echo $row['purchase_id']; ?>" data-bs-toggle="modal" data-bs-target="#details<?php echo $row['purchase_id']; ?>" class="btn btn-secondary btn-sm"><i class="bi bi-search"></i> View</a>
									<?php include 'new_sales_modal.php'; ?>
									</td>
								</tr>
							<?php
							}
						?>
					</tbody>	
				</table>
				<div class="pe-2">
					<a class="btn btn-danger text-decoration-none text-white mb-1" href="products.php"><i class='bi bi-caret-left'></i>BACK</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end of table -->
</div>
</body>

<!-- bootstrap javascript OFFLINE-->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- end of bootstrap javascript OFFLINE-->

</html>