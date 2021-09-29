<?php require_once('../config/admin_instantiated_files.php');
       include('inc/header.php'); 
      
  

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
            <h1 class="h3 mb-0 text-gray-800">All Orders Filter</h1>
           
          </div>

        



        <div class="row">
        <div class="col-md-12">
        <?php if(!empty($msg)){

        echo $msg;

        }?>
        </div>
        </div>


        

          <h6 class="m-0 font-weight-bold text-primary">All Orders</h6>
          <p class="mb-4">Below is a list of orders in the system</p>

            <div class="card shadow mb-4">
            <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div> -->
            <div class="card-body">
              <div class="table-responsive">
                <!-- <table class="table table-bordered example" id="products_table" width="100%" cellspacing="0"> -->
                <table id="orders_table" class="table table-bordered display " style="width:100%">

                  <thead>
                    <tr>

                      <!-- <th>SN</th> -->
                      <th>Product Name</th>
                      <th>Order No</th>
                      <th>Unit Price</th>
                      <th>Quantity</th>
                      <th>Total Amount</th>
                      <th>Customer</th>
                      <th>Payment Status</th>
                       <th>Delivery Status</th> 
                      <th>Date Added</th>
                      <!-- <th></th> -->

                    </tr>
                  </thead>

                   <tfoot>
                    <tr>

                      <!-- <th>SN</th> -->
                      <th>Product Name</th>
                      <th>Order No</th>
                      <th>Unit Price</th>
                      <th>Quantity</th>
                      <th>Total Amount</th>
                      <th>Customer</th>
                      <th>Payment Status</th>
                       <th>Delivery Status</th> 
                      <th>Date Added</th>
                      <!-- <th></th> -->

                    </tr>
                  </tfoot>
                
             
                </table>
              </div>
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
