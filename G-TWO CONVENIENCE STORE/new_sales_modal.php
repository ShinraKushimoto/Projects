<?php 

if(isset($_SESSION['User']) && $_SESSION['User'] == "Admin" || $_SESSION['User'] == "Manager" || $_SESSION['User'] == "Cashier"  || $_SESSION['User'] == "Employee") {
    echo "";
    } else {
        echo header("Location: products.php");
}

?>

<!-- Modal -->
<div class="modal fade" id="details<?php echo $row['purchase_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl"  >
    <div class="modal-content">
      <div class="modal-header bg-secondary text-white">
        <h4 class="modal-title" id="exampleModalLabel">Purhase Receipt</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
          <div class="container-fluid pt-3">
                    <div class="d-flex">
                        <h5 class="fw-bolder">Receipt Number: 
                            <span class="text-danger"><?php echo "R00" . $row['purchase_id']; ?></span>
                        </h5>
                        <h6 class="ms-auto">
                            <?php echo date('M d, Y h:i A', strtotime($row['date_purchase'])) ?></h6>
                    </div>
                    <div>
                        <h5 class="fw-bolder">Customer: 
                            <span class="text-primary"><?php echo $row['customer']; ?></span>
                        </h5>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>SKU</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Purchase Quantity</th>
                            <th>Subtotal</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql="select * from purchase_detail left join store_prod_inventory on store_prod_inventory.prod_id=purchase_detail.prod_id where purchase_id='".$row['purchase_id']."'";
                                $dquery=$con->query($sql);
                                while($drow=$dquery->fetch_array()){
                                    ?>
                                    <tr>
                                        <td><?php echo $drow['prod_sku']; ?></td>
                                        <td><?php echo $drow['prod_desc']; ?></td>
                                        <td class="text-right">&#8369; <?php echo number_format($drow['prod_price'], 2); ?></td>
                                        <td><?php echo $drow['quantity']; ?></td>
                                        <td class="text-right">&#8369;
                                            <?php
                                                $subt = $drow['prod_price']*$drow['quantity'];
                                                echo number_format($subt, 2);
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    
                                }
                            ?>
                            <tr>
                                <td colspan="4" class="text-right"><b>TOTAL</b></td>
                                <td class="text-right">&#8369; <?php echo number_format($row['total'], 2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>  
            </div>
        </div>
    </div>
  </div>
</div>