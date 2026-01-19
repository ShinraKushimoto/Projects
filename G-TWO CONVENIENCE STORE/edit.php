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

$id = $_GET['ID'];

$sql = "SELECT * FROM store_prod_inventory WHERE prod_id = '$id'";
$table = $con->query($sql) or die ($con->error);
$row = $table->fetch_assoc();

if(isset($_POST['Submit'])) {

	$prodSku = $_POST['prodSku'];
	$prodDesc = $_POST['prodDesc'];	
	$prodStatus = $_POST['prodStatus'];
	$prodPrice = $_POST['prodPrice'];
	$prodQuant = $_POST['prodQuant'];
	$prodTotal = $_POST['prodPrice'] * $_POST['prodQuant'];
	$prodDate = $_POST['prodDate'];

	$sql = "UPDATE store_prod_inventory SET prod_sku = '$prodSku', prod_desc = '$prodDesc', prod_status = '$prodStatus', prod_price = '$prodPrice', prod_quant = '$prodQuant', prod_total_amount = '$prodTotal', prod_date_updated = '$prodDate' WHERE prod_id = '$id'";

	$con->query($sql) or die ($con->error);


	echo header("Location: inventory.php?ID=" . $id);
}

else if (isset($_POST['Cancel'])) {
		echo header("Location: inventory.php?ID=" . $id);
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
		<div>EDIT PRODUCT</div>
	</div>
	<!-- end of jumbotron -->

	<!-- form -->
	<div class="w-25 container my-2 border shadow-lg p-3 bg-body rounded">
		<form action="" method="post" class="">
			<div class="row">
				<div class="col-lg-12 col-sm-12">


					<label class="h5">Product SKU:</label>
					<input class="form-control border-0 border-bottom border-2" name="prodSku" id="prodSku" value="<?php echo $row['prod_sku']; ?>" required><br><br>

					<label class="h5">Description:</label>
					<input class="form-control border-0 border-bottom border-2" type="text" name="prodDesc" id="prodDesc" value="<?php echo $row['prod_desc']; ?>" required><br><br>

					<label class="h5">Status:</label>
					<input class="form-control border-0 border-bottom border-2" name="prodStatus" id="prodStatus" value="<?php echo $row['prod_status']; ?>" required><br><br>

					<label class="h5">Price:</label>
					<div class="input-group mb-5">
						<div class="input-group-prepend">
							<span class="input-group-text border-0 border-bottom border-2">₱</span>
						</div>
						<input type="number" class="form-control border-0 border-bottom border-2" placeholder="0.00" name="prodPrice" id="prodPrice" value="<?php echo $row['prod_price']; ?>" step=".01" required>
					</div>

					<label class="h5">Quantity:</label>
					<input class="form-control border-0 border-bottom border-2" type="number" name="prodQuant" id="prodQuant" value="<?php echo $row['prod_quant']; ?>" required><br><br>

					<input class="form-control border-0 border-bottom border-2" type="" name="prodDate" id="prodDate" value="<?php date_default_timezone_set('Asia/Manila'); echo date("Y-m-d H:i:s"); ?>" hidden>
					<div class="col-lg-12 text-center">
						<button class="btn btn-danger"  type="submit" name="Cancel" id="Cancel">Cancel</button>
						<button class="btn btn-primary" type="submit" name="Submit" value="Submit">Update</button>
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