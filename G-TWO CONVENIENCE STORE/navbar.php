<!-- navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top border-bottom">
	 	<div class="container-fluid">

	 		<a href="products.php"><img class="ms-3 me-4" src="images/g2_icon.png" alt="..."></a>

	 		<button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		      	<ul class="navbar-nav me-auto mb-2 mb-lg-0 my-2 ms-2">
		        	<li class="nav-item me-2 mb-1">
		          		<a class="btn btn-outline-secondary" aria-current="page" href="products.php"><i class="bi bi-house-door"></i> Home</a>
		        	</li>
		        	<li class="nav-item me-2 mb-1">
		          		<a class="btn btn-outline-secondary" aria-current="page" href="new_order.php"><i class="bi bi-cash-coin"></i> Cashier</a>
		        	</li>
		        	<li class="nav-item">
		        	</li>
		        	<li class="nav-item me-2 mb-1">
		          		<a class="btn btn-outline-secondary" aria-current="page" href="new_sales.php"><i class="bi bi-receipt"></i> Sales</a>
		      	  	</li>
		        	<li class="nav-item me-2 mb-1">
		          		<a class="btn btn-outline-secondary" aria-current="page" href="inventory.php"><i class="bi bi-boxes"></i> Inventory</a>
		        	</li>
		        	<li class="nav-item me-2 mb-1">
		          		<a class="btn btn-outline-secondary" aria-current="page" href="supplier.php"><i class="bi bi-box-seam"></i> Order/Supplier</a>
		        	</li>
		        	<li class="nav-item me-2 mb-1">
		          		<a class="btn btn-outline-secondary" aria-current="page" href="users.php"><i class="bi bi-person"></i> Users</a>
		        	</li>	
		        	<li class="nav-item me-2 mb-1">
		          		<a class="btn btn-outline-secondary" aria-current="page" href="customer.php"><i class="bi bi-people"></i> Customer</a>
		        	</li>
		      	</ul>
		      	<form class="d-flex">
		      		<?php if(isset($_SESSION['UserLogin'])) { ?>	
						<h6  class="text-danger ms-auto me-2 mt-2"><?php echo "[" . $_SESSION['UserLogin'] . "]";?></h6>
					<?php } else { ?>
						<h6  class="text- ms-auto me-2 mt-2"><?php echo "[Guest]"; ?></h6>
					<?php } ?>
				 	<?php if(isset($_SESSION['UserLogin'])) {?>
				 		<div>
				 			<a class=" btn btn-danger ms-auto text-decoration-none text-white me-2" href="logout.php"><i class='bi bi-box-arrow-left'></i> LOGOUT</a>
				 		</div>
				 	<?php } else { ?>
				 		<a class="btn btn-secondary text-decoration-none text-white me-2" href="index.php"><i class='bi bi-box-arrow-in-right'></i> LOGIN</a>
				 	<?php } ?>
		      	</form>
		    </div>
	  	</div>
	</nav>
	<!-- end of navbar -->