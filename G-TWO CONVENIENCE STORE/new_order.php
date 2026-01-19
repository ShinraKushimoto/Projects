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
	<div class="container text-center mt-3 mb-4 p-3 border shadow bg-secondary text-white rounded h1">PURCHASING</div>
	<!-- end of jumbotron -->

	<div class="container my-2 border shadow-lg p-3 bg-body rounded">
		<form method="POST" action="">
			<div class="container d-block">
				<div class="">
					<label class="h5">Customer Name:</label>
					<input class="form-control border" type="text" name="customer" id="customer" required>
				</div>
				<div class="">
					<label class="h5 pt-5">Contact Number:</label>
					<input class="form-control border" type="text" name="custContact" id="custContact" required><br><br>
				</div>
				<div class="">
					<label class="h5">E-mail:</label>
					<input class="form-control border" type="email" name="custEmail" id="custEmail" required><br><br>	
				</div>	
				<div class="">
					<label class="h5">Address:</label>
					<input class="form-control border" type="text" name="custAddress" id="custAddress" required><br><br>	
				</div>
				<div class="pe-2">
					<a class="btn btn-danger text-decoration-none text-white mb-3" href="products.php"><i class='bi bi-caret-left'></i>BACK</a>
					<button type="Submit" formaction="new_purchase.php" name="Submit" class="btn btn-primary mb-3"><i class="bi bi-bag"></i> PURCHASE</button>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead class="h5">
					<tr>
						<th class="text-center"><input type="checkbox" id="checkAll"></th>
						<th>SKU</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>Quantity</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$sql="select * from store_prod_inventory";
						$query=$con->query($sql);
						$iterate=0;
						while($row=$query->fetch_array()){
							?>
							<tr>
								<td class="text-center"><input type="checkbox" value="<?php echo $row['prod_id']; ?>||<?php echo $iterate; ?>" name="prod_id[]" style=""></td>
								<td><?php echo $row['prod_sku']; ?></td>
								<td><?php echo $row['prod_desc']; ?></td>
								<td class="text-right">&#8369; <?php echo number_format($row['prod_price'], 2); ?></td>
								<td><input type="text" class="form-control" name="quantity_<?php echo $iterate; ?>"></td>
							</tr>
							<?php
							$iterate++;
						}
					?>
				</tbody>
			</table>
		</form>
	</div>
</body>

<!-- bootstrap javascript OFFLINE-->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- end of bootstrap javascript OFFLINE-->

<script type="text/javascript">
	$(document).ready(function(){
		$("#checkAll").click(function(){
	    	$('input:checkbox').not(this).prop('checked', this.checked);
		});
	});
</script>
</html>