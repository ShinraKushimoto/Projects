<?php 

if(!isset($_SESSION)) {
	session_start();
}

if(isset($_SESSION['User']) && $_SESSION['User'] == "Admin") {
	echo "";
	} else {
		echo header("Location: products.php");
}

include_once("connections/connection.php");
$con = connection();

$id = $_GET['ID'];

$sql = "SELECT * FROM store_users WHERE user_id = '$id'";
$table = $con->query($sql) or die ($con->error);
$row = $table->fetch_assoc();

if(isset($_POST['Submit'])) {

	$userNum = $_POST['userNum'];
	$userName = $_POST['userName'];	
	$userPass = $_POST['userPass'];
	$userFname = $_POST['userFname'];
	$userLname = $_POST['userLname'];
	$userAge = $_POST['userAge'];
	$userBdate = $_POST['userBdate'];
	$userAdd = $_POST['userAdd'];
	$userPos = $_POST['userPos'];
	$userShf = $_POST['userShf'];

	$sql = "UPDATE store_users SET user_num = '$userNum', username = '$userName', user_pass = '$userPass', user_fname = '$userFname', user_lname = '$userLname', user_age = '$userAge', user_bdate = '$userBdate',  user_address = '$userAdd', user_position = '$userPos', user_shift = '$userShf' WHERE user_id = '$id'";
	
	$con->query($sql) or die ($con->error);

	echo header("Location: users.php");
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
		<div>EDIT USERS</div>
	</div>
	<!-- end of jumbotron -->

	<!-- form -->
	<div class="w-25 container my-2 border shadow-lg p-3 bg-body rounded">
		<form action="" method="post">
			<div class="row">
				<div class="col-lg-12 col-sm-12">
					<label class="h5">User Serial Number:</label>
					<input class="form-control border-0 border-bottom border-2" name="userNum" id="userNum" value="<?php echo $row['user_num']; ?>" required><br><br>

					<label class="h5">Username:</label>
					<input class="form-control border-0 border-bottom border-2" type="text" name="userName" id="userName" value="<?php echo $row['username']; ?>" required><br><br>

					<label class="h5">Password:</label>
					<input class="form-control border-0 border-bottom border-2" type="password" name="userPass" id="userPass" value="<?php echo $row['user_pass']; ?>" required><br><br>

					<label class="h5">First Name:</label>
					<input class="form-control border-0 border-bottom border-2" type="text" name="userFname" id="userFname" value="<?php echo $row['user_fname']; ?>" required><br><br>

					<label class="h5">Last Name:</label>
					<input class="form-control border-0 border-bottom border-2" type="text" name="userLname" id="userLname" value="<?php echo $row['user_lname']; ?>" required><br><br>

					<label class="h5">Age:</label>
					<input class="form-control border-0 border-bottom border-2" type="number" name="userAge" id="userAge" value="<?php echo $row['user_age']; ?>" required><br><br> 

					<label class="h5">Birthdate:</label>
					<input class="form-control border-0 border-bottom border-2" type="date" name="userBdate" id="userBdate" value="<?php echo $row['user_bdate']; ?>" required><br><br>	

					<label class="h5">Address:</label>
					<input class="form-control border-0 border-bottom border-2" type="text" name="userAdd" id="userAdd" value="<?php echo $row['user_address']; ?>" required><br><br>

					<label class="h5">Position:</label>
					<input class="form-control border-0 border-bottom border-2" type="text" name="userPos" id="userPos" value="<?php echo $row['user_position']; ?>" required><br><br>

					<label class="h5">Shift:</label>
					<input class="form-control border-0 border-bottom border-2" type="text" name="userShf" id="userShf" value="<?php echo $row['user_shift']; ?>" required><br><br>
					<div class="col-lg-12 text-center">
						<a class="btn btn-danger text-decoration-none text-white" href="users.php">Cancel</a>
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