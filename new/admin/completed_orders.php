<?php require_once('../config/admin_instantiated_files.php');
       include('inc/header.php'); 
       $global_completed_orders = get_global_customer_completed_orders();
?>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
  <?php include('inc/sidebar.php'); ?>
    <!-- Sidebar -->
    
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
       
          <?php include('inc/top_nav.php'); ?>

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Completed Orders</h1>
            
          </div>
        <div class="row">

         
          
              <div class="col-md-11">
           
              <h6 class="m-0 font-weight-bold text-primary">View Completed Orders</h6>
              <p class="mb-4">You can view your all Completed orders here</p>



              <!-- <div class="card shadow mb-4"> -->
           
                    <div class="table-responsive">
                   <!--  <button 
                      class="btn btn-sm btn-primary btn-flat"
                      data-table = 'orders' 
                      data-cols='invoice_no, payment_status' 
                      id="toPDF"
                    >Download Table PDF</button> -->
						  <table id="dataTable" class="table table-bordered table-striped display nowrap">
              <!-- <table id="dataTable" class="display" style="width:100%"> -->
							<thead>
								<tr>
									<th>SN</th>
                  <th>ORDER NO</th>
									<th>PAYMENT STATUS</th>
									<th>DELIVERY STATUS</th>
                  <th></th>
									<th></th>
													
								</tr>
							</thead>
                            <tbody>
                                <?php
                                  global $dbc;


                                  $output = '';
                                  $sql = "SELECT * FROM `orders` WHERE  `payment_status`=1 AND `delivery_status`=0 GROUP BY `invoice_no`";
                                  $query = mysqli_query($dbc, $sql);
                                  $i = 1;
                                  while($data = mysqli_fetch_assoc($query)) { 
                                        $cust_details = get_one_row_from_one_table_by_id('users_tbl','unique_id',$data['customer_id'],'date_created');
                                        $first_name = $cust_details['first_name'];
                                        $last_name = $cust_details['last_name'];
                                        $fullname = $first_name.' '.$last_name;
                                     ?>
                                      <tr>
                                      <td><?php echo $i; ?></td>
                                      <td><?php echo $data['invoice_no']; ?></td>
                                      <td><?php echo $data['payment_status'] == 1 ? 'completed': 'pending'; ?></td>
                                      <td><?php echo $data['delivery_status'] == 1 ? 'completed': 'pending'; ?></td>
                                      <td><a href="#" class="btn btn-success btn-sm" data-target="#see_details<?php echo $data['invoice_no']; ?>" data-toggle="modal">see details</a></td>
                                     <td><a href="#" class="btn btn-primary btn-sm" data-target="#approve<?php echo $data['invoice_no']; ?>" data-toggle="modal">mark as delivered</a></td>

                                         <!-- Modal -->
                                    <div class="modal fade" id="see_details<?php echo $data['invoice_no']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content ">
                                    <div class="modal-header ">
                                    <h5 class="modal-title" id="exampleModalLongTitle"><strong>Details for Order No: <?php echo $data['invoice_no']; ?></strong></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                      <p><strong>Customer Name: <?php echo $fullname; ?></strong><br><strong>Products Ordered For</strong></p>
                                      <ul>
                                         <?php

                                          $products_ordered = get_rows_from_one_table_by_id('orders','invoice_no',$data['invoice_no'],'date_added');
                                          $cc = 1;
                                          $total_price = 0;
                                          foreach($products_ordered as $eachproduct){ 
                                                $product_id = $eachproduct['product_id'];
                                                $product_name = getData('product_name', 'product_tbl', 'unique_id', $product_id);
                                                $measure_type = getData('measure_type', 'product_tbl', 'unique_id', $product_id);
                                            ?>
                                            <li><?php echo $cc.': '.$product_name.' ('.$eachproduct['quantity'].' '.$measure_type.') Unit Price: &#8358;'.number_format($eachproduct['unit_price']).'  Total Price: '.'&#8358;'.number_format($eachproduct['total_amount']); ?></li>
                                         <?php 
                                                $total_price = $total_price + $eachproduct['total_amount'];
                                                $cc++;
                                         
                                          } ?>
                                           <br>
                                          
                                          <?php if($eachproduct['payment_proof_path'] != ""){?>
                                          <p>Payment Proof:<br><img width="600" height="400" src="../<?php echo $eachproduct['payment_proof_path']; ?>"></p>
                                          <?php }else{ echo "<hr>No Payment Proof Found"; } ?>
                                          <p><strong>Total Price: <?php echo '&#8358;'.number_format($total_price,2); ?></strong></p>
                                      </ul>
                                    </div>
                                    <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                    </div>
                                    </div>

                                     <div class="modal fade" id="approve<?php echo $data['invoice_no']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content ">
                                    <div class="modal-header ">
                                    <h5 class="modal-title" id="exampleModalLongTitle"><strong>Details for Order No: <?php echo $data['invoice_no']; ?></strong></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                      <p><strong>Are you sure you want to mark this order as delivered?</strong><br>
                                        <a href="#" class="mark_as_delivered" id="<?php echo $data['invoice_no']; ?>" style="color: green;">YES, Please mark as delivered</a> &nbsp;
                                        <a data-dismiss="modal" href="complete_order.php" style="color: red;">CANCEL</a>
                                      </p>
                                    
                                    </div>
                                    <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                    </div>
                                    </div>



                                      </tr>
                                      
                                   <?php  $i++; }
                                    echo $output;
                                   ?>
                            </tbody>
						</table>
					</div>


              <!-- </div> -->

              

              </div>
              


        </div>


      



          <!-- Content Row -->


          <!-- Content Row -->
         

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
    <?php include('inc/footer.php'); ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 <?php include('inc/scripts.php'); ?>
    