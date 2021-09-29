<?php  require_once('../config/admin_instantiated_files.php');
       include('inc/header.php'); 

        if(isset($_GET['pid'])){
          $pid = $_GET['pid'];
          $product_details = get_one_row_from_one_table_by_id('product_tbl','unique_id',$pid,'date_added');

       }
      
      if(isset($_POST['cmd_edit_product'])){

            $product_name = $_POST['product_name'];
            $product_id = $_POST['pid'];
            $unit_price = $_POST['unit_price'];
            $visibility = $_POST['visibility'];
         
            $edit_product =  edit_product($product_id,$product_name,$unit_price,$visibility);
            $edit_product_dec = json_decode($edit_product,true);
            if($edit_product_dec['status'] == 111){
                $msgp = "<div class='alert alert-success' >".$edit_product_dec['msg']."</div><br>";
              // $msg = "success";
            }else{
                  $msgp = "<div class='alert alert-danger' >".$edit_product_dec['msg']."</div><br>";
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
            <h1 class="h3 mb-0 text-gray-800">Edit Product: <?php echo $product_details['product_name']; ?></h1>
             <a href="view_products.php"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>All Products</a>
          </div>

      



    

        <div class="row">

          <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                <?php if(!empty($msgp)){

                echo $msgp;

                }?>
                </div>
                </div>
            <h6 class="m-0 font-weight-bold text-primary">Edit Product</h6>
              <p class="mb-4">Edit a product here</p>

           

              <form method="post" enctype="multipart/form-data" class="user" action="">
              <!-- <h6 class="m-0 font-weight-bold text-primary">Edit Product</h6> -->
              
              <div class="form-group">
              <label>Product Name</label>                                
              <input type="text" required="" class="form-control form-control-sm" value="<?php echo $product_details['product_name']; ?>" id="product_name" name="product_name">   
              <input type="hidden" required="" class="form-control form-control-sm" value="<?php echo $pid; ?>" id="pid" name="pid">   
              </div>

              <div class="form-group">
                <label>Unit Price</label>                                
                <input type="number" required="" value="<?php echo $product_details['unit_price']; ?>" class="form-control form-control-sm" value="" id="unit_price" name="unit_price"> 
              </div>

              <div class="form-group">
              <label>Measure Type</label>                                
                 <select required="" class="form-control form-control-sm" value="" id="measure_type" name="measure_type">
                 <option value="kg">kg</option>
               </select>
              </div>

               <div class="form-group">
              <label>Visibility</label>                                
                 <select required="" class="form-control form-control-sm" value="" id="visibility" name="visibility">
                 <option value="<?php echo $product_details['visibility_status']; ?>"><?php echo $product_details['visibility_status'] == 1 ? 'visible':'hidden'; ?></option>
                 <option value="0">hide</option>
                 <option value="1">show</option>
               </select>
              </div>

              <!-- NOTE:   they used description -->    
              <input type="submit" value="Edit Product" name="cmd_edit_product" class="btn btn-danger btn-sm btn-block"/>
              </a>
              </form>


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
