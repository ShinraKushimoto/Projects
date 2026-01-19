<?php 

if(isset($_SESSION['User']) && $_SESSION['User'] == "Admin") {
	echo "";
	} else {
		echo header("Location: products.php");
}

include("connections/connection.php");
$con = connection();

if(isset($_GET['user_delete'])) {

	$id = $_GET['user_delete'];

	$sql = "DELETE FROM  store_users WHERE user_id = '$id' ";
	$con->query($sql) or die ($con->error());

	echo header("Location: users.php");
}

?>