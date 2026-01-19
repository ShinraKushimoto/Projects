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

if(isset($_POST['Submit'])) {

    $userNum = $_POST['userNum'];
    $userName = $_POST['userName'];
    $userPass = $_POST['userPass']; // User's plain-text password
    $userFname = $_POST['userFname'];
    $userLname = $_POST['userLname'];
    $userAge = $_POST['userAge'];
    $userBdate = $_POST['userBdate'];
    $userAdd = $_POST['userAdd'];
    $userPos = $_POST['userPos'];

    // Define a secret pepper (this should be stored securely in your config or environment variables)
    $pepper = "YOUR_SECRET_PEPPER_KEY";

    // Step 1: Add pepper to the password
    $pepperedPassword = hash_hmac("sha256", $userPass, $pepper);

    // Step 2: Hash the peppered password (password_hash() automatically adds salt)
    $hashedPassword = password_hash($pepperedPassword, PASSWORD_DEFAULT);

    // Step 3: Insert the hashed password into the database
    $sql = "INSERT INTO `store_users`(`user_num`, `username`, `user_pass`, `user_fname`, `user_lname`, `user_age`, `user_bdate`, `user_address`, `user_position`) 
            VALUES ('$userNum', '$userName', '$hashedPassword', '$userFname', '$userLname', '$userAge', '$userBdate', '$userAdd', '$userPos')";
    $con->query($sql) or die ($con->error);

    // Redirect to users page after successful registration
    echo header("Location: users.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>G-TWO Convenience Store</title>
	
	<!-- bootstrap css -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
	<!-- end of bootstrap css -->
	
</head>
<body>

	<!-- navbar -->
	<?php include 'navbar.php' ?>
	<!-- end of navbar -->

	<!-- jumbotron -->
	<div class="w-25 container text-center mt-3 mb-3 p-2 border shadow bg-secondary text-white rounded h2">
		<div>REGISTRATION</div>
	</div>
	<!-- end of jumbotron -->

	<!-- form -->
	<div class="w-25 container my-2 border shadow-lg p-3 bg-body rounded">
		<form action="" method="post">
			<div class="row">
				<div class="col-lg-12 col-sm-12">
					<label class="h5">User Serial Number:</label>
					<input class="form-control border-0 border-bottom border-2" name="userNum" id="userNum" required><br><br>

					<label class="h5">Username:</label>
					<input class="form-control border-0 border-bottom border-2" type="text" name="userName" id="userName" required><br><br>

					<label class="h5">Password:</label>
					<input class="form-control border-0 border-bottom border-2" type="password" name="userPass" id="userPass" required><br><br>

					<label class="h5">First Name:</label>
					<input class="form-control border-0 border-bottom border-2" type="text" name="userFname" id="userFname" required><br><br>

					<label class="h5">Last Name:</label>
					<input class="form-control border-0 border-bottom border-2" type="text" name="userLname" id="userLname" required><br><br>

					<label class="h5">Age:</label>
					<input class="form-control border-0 border-bottom border-2" type="number" name="userAge" id="userAge" required><br><br>

					<label class="h5">Birthdate:</label>
					<input class="form-control border-0 border-bottom border-2" type="date" name="userBdate" id="userBdate" required><br><br>

					<label class="h5">Address:</label>
					<input class="form-control border-0 border-bottom border-2" type="text" name="userAdd" id="userAdd" required><br><br>

					<label class="h5">Position:</label>
					<input class="form-control border-0 border-bottom border-2" type="text" name="userPos" id="userPos" required><br><br>
					<div class="col-lg-12 text-center">
						<a class="btn btn-danger text-decoration-none text-white" href="products.php">Cancel</a>
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
