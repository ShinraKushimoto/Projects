<?php 

include("connections/connection.php");
$con = connection();

if(isset($_GET['delete'])) {

	$id = $_GET['delete'];

	$sql = "DELETE FROM store_prod_inventory WHERE prod_id = '$id' ";
	$con->query($sql) or die ($con->error());

	echo header("Location: inventory.php");
}

?>