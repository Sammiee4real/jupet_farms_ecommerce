<?php  require_once('config/instantiated_files.php');
       include('include/header.php'); 
       // unset($_SESSION['uid']);
       //unset($_SESSION['cart']);
       $customer_id = $_SESSION['uid'];
       $pending_orders = get_all_customer_pending_orders($customer_id);
?>


      <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Pending Orders</h2>
                       <!--  <div class="breadcrumb__option">
                            <a href="dashboard.php">Home</a>
                            <span>Checkout</span>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

   
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
           
            <div class="checkout__form">
                <h4>Hello <?php echo $fullname; ?></h4>
                <!-- <p>You can login <a href="checkout.php" style="text-decoration: none; color:black;">Here</a> if you have an account</p> -->
                <form action="#">
                    <div class="row">
                       
                        <?php include('include/navigation.php'); ?>

                        <div class="col-lg-9 col-md-6">
                            <div class="checkout__order">
                                <h4>Pending Orders</h4>
                                <!-- <div class="checkout__order__products">Products <span>Total</span></div> -->
                                <?php if($pending_orders == null){
                                    echo "No record found<hr>";
                                }else{ ?>
                                <table class="table table-striped">  
                                     <!-- table-responsive -->
                                <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Order No</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Delivery Status</th>
                                <th scope="col">Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $c = 1; 

                                foreach($pending_orders as $each_order){?>
                                    <tr>
                                    <th scope="row"><?php echo $c; ?></th>
                                    <td><?php echo $each_order['invoice_no']; ?></td>
                                    <td><?php echo $each_order['payment_status'] == 1 ? 'completed': 'pending'; ?></td>
                                    <td><?php echo $each_order['delivery_status'] == 1 ? 'completed': 'pending'; ?></td>
                                    <td><a href="#" class="btn btn-success btn-sm" data-target="#see_details<?php echo $each_order['invoice_no']; ?>" data-toggle="modal">see details</a></td>
                                    </tr>
                                     <!-- Modal -->
                                    <div class="modal fade" id="see_details<?php echo $each_order['invoice_no']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content ">
                                    <div class="modal-header ">
                                    <h5 class="modal-title" id="exampleModalLongTitle"><strong>Details for Order No: <?php echo $each_order['invoice_no']; ?></strong></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                      <p><strong>Products Ordered For</strong></p>
                                      <ul>
                                         <?php

                                          $products_ordered = get_rows_from_one_table_by_id('orders','invoice_no',$each_order['invoice_no'],'date_added');
                                          $cc = 1;
                                          $total_price = 0;
                                          foreach($products_ordered as $eachproduct){ 
                                                $product_id = $eachproduct['product_id'];
                                                $product_name = getData('product_name', 'product_tbl', 'unique_id', $product_id);
                                                $measure_type = getData('measure_type', 'product_tbl', 'unique_id', $product_id);
                                            ?>
                                            <li><?php echo $cc.': '.$product_name.' ('.$eachproduct['quantity'].' '.$measure_type.')  Price: '.'&#8358;'.number_format($eachproduct['total_amount']); ?></li>
                                         <?php 
                                                $total_price = $total_price + $eachproduct['total_amount'];
                                                $cc++;
                                         
                                          } ?>
                                            <li>Total Amount: <?php echo '&#8358;'.number_format($total_price,2); ?></li>

                                      </ul>
                                    </div>
                                    <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                    </div>
                                    </div>

                                <?php $c++; } 
                                    }
                                ?>

                                   
                               
                                </tbody>
                                </table>
                                <a href="home.php"  class="btn btn-primary btn-sm">Go to Dashboard</a>
                            </div>


                        </div>



                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->


 <?php include('include/footer.php'); ?>