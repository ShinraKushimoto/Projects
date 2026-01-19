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

$sql = "SELECT * FROM store_users ORDER BY user_id DESC";
$table = $con->query($sql) or die ($con->error);
$row = $table->fetch_assoc();

$result = $table->num_rows;

if ($result > 0){
    echo "";
}   else {
        echo header("Location: users_noresult.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>G-TWO Convenience Store</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

</head>
<body>

    <!-- navbar -->
    <?php include 'navbar.php' ?>
    <!-- end of navbar -->

    <!-- header -->
    <div class="container text-center mt-4 mb-4">
        <h1 class="display-4">Users List</h1>
    </div>
    <!-- end of header -->

    <!-- add button -->
    <div class="container d-flex justify-content-between mb-3">
        <div>
            <a class="btn btn-danger" href="products.php"><i class="bi bi-arrow-left"></i> Back</a>
            <a href="register.php" class="btn btn-primary">+ New User</a>
        </div>
        <form class="d-flex" action="users_result.php" method="GET">
            <input type="text" class="form-control me-2" name="search1" id="search1" placeholder="Search...">
            <button class="btn btn-outline-secondary" type="submit" name="query">Search</button>
            <a class="btn btn-outline-secondary ms-2" href="users.php">Clear</a>
        </form>
    </div>
    <!-- end of add button -->

    <!-- table -->
    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>User No.</th>    
                        <th>Serial No.</th>
                        <th>First Name</th>    
                        <th>Last Name</th>
                        <th>Age</th>
                        <th>Birthdate</th>
                        <th>Address</th>
                        <th>Position</th>
                        <th>Shift</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>    
                    <?php do{ ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['user_num']; ?></td>
                        <td><?php echo $row['user_fname']; ?></td>
                        <td><?php echo $row['user_lname']; ?></td>    
                        <td><?php echo $row['user_age']; ?></td>
                        <td><?php echo $row['user_bdate']; ?></td>
                        <td><?php echo $row['user_address']; ?></td>
                        <td><?php echo $row['user_position']; ?></td>
                        <td><?php echo $row['user_shift']; ?></td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-primary me-2" href="user_edit.php?ID=<?php echo $row['user_id']; ?>">Edit</a>    
                                <button class="btn btn-danger" onclick="showModal()">Delete</button>

                                <!-- delete modal -->
                                <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this user?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <a class="btn btn-danger" href="user_delete.php?user_delete=<?php echo $row['user_id']; ?>">Yes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end of delete modal -->
                            </div>
                        </td>
                    </tr>
                    <?php }while($row = $table->fetch_assoc()); ?>
                </tbody>    
            </table>
        </div>
    </div>
    <!-- end of table -->

    <!-- Bootstrap JS -->
    <script src="js/bootstrap.bundle.min.js"></script>

    <script>
        function showModal() {
            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {});
            myModal.show();
        }
    </script>

</body>
</html>
