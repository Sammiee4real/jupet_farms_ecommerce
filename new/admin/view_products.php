<?php require_once('../config/admin_instantiated_files.php');
       include('inc/header.php'); 
      
        if(isset($_GET['pid'])){
             $unique_id = $_GET['pid'];
             $product_det = get_one_row_from_one_table_by_id('product_tbl','unique_id',$unique_id,'date_added');
             $product_path = $product_det['product_path'];

            $delete_upload =  delete_record_with_image('product_tbl','product_path',$unique_id);
            $delete_upload_dec = json_decode($delete_upload,true);
            // if($delete_upload_dec['status'] == 111){
            $msg = "<div class='alert alert-success' >Deletion was successful... Redirecting shortly...</div><br>";
            // $msg = "success";
            header('Refresh: 3; url=view_products.php');
            // }else{
            // $msg = "<div class='alert alert-danger' >".$delete_upload_dec['msg']."</div><br>";
            // // $msg = "failed";
            // }
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
            <h1 class="h3 mb-0 text-gray-800">All Products Filter</h1>
            <!-- <?php //if($email == 'admin@gmail.com'){ ?> -->
              <a href="create_product.php"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Create a Product</a>
          <?php// } ?>
          </div>

        



        <div class="row">
        <div class="col-md-12">
        <?php if(!empty($msg)){

        echo $msg;

        }?>
        </div>
        </div>


        

          <h6 class="m-0 font-weight-bold text-primary">All Products</h6>
          <p class="mb-4">Below is a list of products in the system</p>

            <div class="card shadow mb-4">
            <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div> -->
            <div class="card-body">
              <div class="table-responsive">
                <!-- <table class="table table-bordered example" id="products_table" width="100%" cellspacing="0"> -->
                <table id="products_table" class="table table-bordered display " style="width:100%">

                  <thead>
                    <tr>

                      <!-- <th>SN</th> -->
                      <th>Product Name</th>
                      <th>Unit Price</th>
                      <th>Visibility</th>
                      <th>Quantity</th>
                      <th>Measure Type</th>
                      <th>Date Created</th>
                      <!-- <th></th> -->

                    </tr>
                  </thead>

                   <tfoot>
                    <tr>

                       <!-- <th>SN</th> -->
                      <th>Product Name</th>
                      <th>Unit Price</th>
                      <th>Visibility</th>
                      <th>Quantity</th>
                      <th>Measure Type</th>
                      <th>Date Created</th>
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
