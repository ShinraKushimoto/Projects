<?php

if (!isset($_SESSION)) {
    session_start();
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
    <title>Store Inventory System</title>

    <!-- bootstrap css-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- end of bootstrap css-->

</head>
<body>

    <!-- navbar -->
    <?php include 'navbar.php' ?>
    <!-- end of navbar -->

    <!-- form -->
    <div class="w-25 container text-center mt-5 mb-3 p-2 border shadow bg-secondary text-white rounded h3">
        <div>LOGIN ACCOUNT</div>
    </div>
    <div class="w-25 container border shadow-lg p-3 bg-body rounded">
        <form method="POST">
            <label class="h5">Username</label>
            <input class="form-control mb-2 border-2" type="text" name="username" id="username" required>
            <label class="h5">Password</label>
            <input class="form-control mb-2 border-2" type="password" name="password" id="password" required>
            <div class="col-lg-12 text-center">
                <button class="btn btn-secondary" type="submit" name="login">Login</button>
                <a href="products.php" class="btn btn-primary text-decoration-none text-white">Guest</a>
            </div>
        </form>
    </div>
    <!-- end of form -->

    <?php
    if (isset($_POST['login'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query to get the user data for the given username
        $sql = "SELECT * FROM store_users WHERE username = '$username'";
        $result = $con->query($sql) or die($con->error);
        $row = $result->fetch_assoc();

        if ($row) {
            // Define the pepper used for hashing new users' passwords
            $pepper = "YOUR_SECRET_PEPPER_KEY";
            
            // Get the stored password hash from the database
            $storedPassword = $row['user_pass'];
            
            // Attempt to verify the password using the new hashing and pepper method
            $pepperedPassword = hash_hmac("sha256", $password, $pepper);

            if (password_verify($pepperedPassword, $storedPassword)) {
                // New user, correct password, set session and redirect
                $_SESSION['UserLogin'] = $row['user_fname'];
                $_SESSION['User'] = $row['user_position'];
                echo header("Location: products.php");
            } else {
                // If the password doesn't match with the new method, check if it matches the old method
                if ($storedPassword == $password) {
                    // If it matches the old plain-text password, migrate the user to the new system
                    $newPepperedPassword = hash_hmac("sha256", $password, $pepper);
                    $newHashedPassword = password_hash($newPepperedPassword, PASSWORD_DEFAULT);

                    // Update the user's password in the database with the new hash
                    $updateSql = "UPDATE store_users SET user_pass = '$newHashedPassword' WHERE username = '$username'";
                    $con->query($updateSql) or die($con->error);

                    // Set session and redirect
                    $_SESSION['UserLogin'] = $row['user_fname'];
                    $_SESSION['User'] = $row['user_position'];
                    echo header("Location: products.php");
                } else {
                    // Password doesn't match new or old method, access denied
                    echo '<h5 class="w-25 mx-auto p-2 text-danger mt-5 text-center shadow-lg rounded">Access Denied!</h5>';
                }
            }
        } else {
            // If no user with the provided username exists
            echo '<h5 class="w-25 mx-auto p-2 text-danger mt-5 text-center shadow-lg rounded">Access Denied!</h5>';
        }
    }
    ?>

</body>

<!-- bootstrap javascript OFFLINE-->
<script src="js/bootstrap.bundle.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<!-- end of bootstrap javascript OFFLINE-->

</html>
