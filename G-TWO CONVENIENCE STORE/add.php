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

if(isset($_POST['Submit'])) {

	$prodSku = $_POST['prodSku'];
	$prodDesc = $_POST['prodDesc'];	
	$prodStatus = $_POST['prodStatus'];
	$prodPrice = $_POST['prodPrice'];
	$prodQuant = $_POST['prodQuant'];
	$prodTotal = $_POST['prodPrice'] * $_POST['prodQuant'];

	$sql = "INSERT INTO `store_prod_inventory`(`prod_sku`, `prod_desc`, `prod_status`, `prod_price`, `prod_quant`, `prod_total_amount`) VALUES ('$prodSku', '$prodDesc', '$prodStatus', '$prodPrice', '$prodQuant', '$prodTotal')";
	$con->query($sql) or die ($con->error);

	echo header("Location: inventory.php");
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
	<div class="w-25 container text-center mt-3 mb-3 p-2 border shadow bg-secondary text-white rounded h2">
		<div>ADD PRODUCT</div>
	</div>
	<!-- end of jumbotron -->

	<!-- form -->
	<div class="w-25 container my-2 border shadow-lg p-3 bg-body rounded">
		<form action="" method="post">
			<div class="row">
				<div class="col-lg-12 col-sm-12">
					<label class="h5">Product SKU:</label>
					<input class="form-control border-0 border-bottom border-2" name="prodSku" id="prodSku" required><br><br>

					<label class="h5">Description:</label>
					<input class="form-control border-0 border-bottom border-2" name="prodDesc" id="prodDesc" required><br><br>

					<label class="h5">Status:</label>
					<input class="form-control border-0 border-bottom border-2" name="prodStatus" id="prodStatus" required><br><br>
					<label class="h5">Price:</label>
					<div class="input-group mb-5 ">
						<div class="input-group-prepend">
							<span class="input-group-text border-0 border-bottom border-2">₱</span>
						</div>
						<input type="number" class="form-control border-0 border-bottom border-2" placeholder="0.00" name="prodPrice" id="prodPrice" step=".01" required>
						</div>

					<label class="h5">Quantity:</label>
					<input class="form-control border-0 border-bottom border-2" type="number" name="prodQuant" id="prodQuant" required><br><br>
					<div class="col-lg-12 text-center">
						<a class="btn btn-danger text-decoration-none text-white" href="inventory.php">Cancel</a>
						<button class="btn btn-primary" type="submit" name="Submit" value="Submit">Submit</button>
					</div>
				</div>
			</div>
		 </form>
	</div>
	<!-- end of form -->

</body>

<!-- bootstrap javascript OFFLINE-->
<script src="js/bootstrap.bundle.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<!-- end of bootstrap javascript OFFLINE-->

</html>