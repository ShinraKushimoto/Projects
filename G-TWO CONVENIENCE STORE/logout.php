<?php 	

session_start();
unset($_SESSION['UserLogin']);
unset($_SESSION['User']);

echo header("Location: index.php");

?>