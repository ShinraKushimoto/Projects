<?php

	if(isset($_SESSION['User']) && $_SESSION['User'] == "Admin" || $_SESSION['User'] == "Manager" || $_SESSION['User'] == "Cashier"  || $_SESSION['User'] == "Employee") {
	echo "";
	} else {
		echo header("Location: products.php");
	}
	
	include_once("connections/connection.php");
	$con = connection();


	if(isset($_POST['customer'])) {

		$customer = $_POST['customer'];
		$custContact = $_POST['custContact'];	
		$custEmail = $_POST['custEmail'];
		$custAddress = $_POST['custAddress'];

		$sql = "INSERT INTO `customer_list`(`customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ('$customer', '$custContact', '$custEmail', '$custAddress')";
		$con->query($sql) or die ($con->error);

		echo header("Location: new_order.php");
	}	

	if(isset($_POST['prod_id'])){
 
		$customer=$_POST['customer'];
		$sql="insert into purchase (customer, date_purchase) values ('$customer', NOW())";
		$con->query($sql);
		$pid=$con->insert_id;
 
		$total=0;
 
		foreach($_POST['prod_id'] as $product):
		$proinfo=explode("||",$product);
		$productid=$proinfo[0];
		$iterate=$proinfo[1];
		$sql="select * from store_prod_inventory where prod_id='$productid'";
		$query=$con->query($sql);
		$row=$query->fetch_array();	
 
		if (isset($_POST['quantity_'.$iterate])){
			$subt=$row['prod_price']*$_POST['quantity_'.$iterate];
			$total+=$subt;

			$sql="insert into purchase_detail (purchase_id, prod_id, quantity) values ('$pid', '$productid', '".$_POST['quantity_'.$iterate].	"')";
			$con->query($sql);
		}
		endforeach;
 		
 		$sql="update purchase set total='$total' where purchase_id='$pid'";
 		$con->query($sql);
		header('location:new_sales.php');

	}
	else{
		?>
		<script>
			window.alert('Please select a product');
			window.location.href='new_order.php';
		</script>
		<?php
	}
?>