<?php require_once('../config/admin_instantiated_files.php');
       include('inc/header.php'); 

       $products = get_row_count_no_param('product_tbl');
       $orders = get_row_count_no_param('orders');
       $customers = get_row_count_no_param('users_tbl');
       $pending_orders = get_row_count_two_params_groupby('orders','payment_status',0,'delivery_status',0,'invoice_no');
       $completed_orders = get_row_count_two_params_groupby('orders','payment_status',1,'delivery_status',0,'invoice_no');
       $delivered_orders = get_row_count_two_params_groupby('orders','payment_status',1,'delivery_status',1,'invoice_no');

    
        if(isset($_POST['cmd_delete'])){
             $unique_id = $_POST['unique_id'];
           
            $delete_upload =  delete_upload($unique_id);
            $delete_upload_dec = json_decode($delete_upload,true);
            if($delete_upload_dec['status'] == 111){
            $msg = "<div class='alert alert-success' >".$delete_upload_dec['msg'].". Redirecting shortly...</div><br>";
            // $msg = "success";
            header('Refresh: 3; url=home.php');
            }else{
            $msg = "<div class='alert alert-danger' >".$delete_upload_dec['msg']."</div><br>";
            // $msg = "failed";
            }
       }

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
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="create_product.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Add a Product</a>
          </div>
       



        <div class="row">
        <div class="col-md-12">
        <?php if(!empty($msg)){

        echo $msg;

        }?>
        </div>
        </div>


          <!-- Content Row -->
          <div class="row">


            <!-- Pending Requests Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
              <a href="pending_orders.php" style="text-decoration: none;">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pending Orders</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($pending_orders); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>

          <!-- Completed Requests Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
              <a href="completed_orders.php" style="text-decoration: none;">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Completed Orders</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($completed_orders); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>


          <!-- Delivered Requests Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
              <a href="delivered_orders.php" style="text-decoration: none;">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Delivered Orders</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($delivered_orders); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </a>
            </div>


            <div class="col-xl-6 col-md-6 mb-4">
              <a href="#" style="text-decoration: none;">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Products</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($products); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
               </a>
            </div>


            <div class="col-xl-6 col-md-6 mb-4">
              <a href="#" style="text-decoration: none;">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Customers</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($customers); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
               </a>
            </div>


     
          </div>


          <hr>




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
