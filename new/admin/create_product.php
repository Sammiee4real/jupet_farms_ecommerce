<?php  require_once('../config/admin_instantiated_files.php');
       include('inc/header.php'); 

      
      if(isset($_POST['cmd_create_product'])){

            $product_name = $_POST['product_name'];
            $visibility = $_POST['visibility'];
            $unit_price = $_POST['unit_price'];
            $measure_type = $_POST['measure_type'];
            //$img_path = $_POST['img_path'];

            $file_name = $_FILES['file_name']['name'];
            $type = $_FILES['file_name']['type'];
            $size = $_FILES['file_name']['size'];
            $tmp_name = $_FILES['file_name']['tmp_name'];
          
            $create_product =  create_product($uid,$product_name,$visibility,$unit_price,$measure_type,$file_name,$type,$size,$tmp_name);
            $create_product_dec = json_decode($create_product,true);
            if($create_product_dec['status'] == 111){
                $msgp = "<div class='alert alert-success' >".$create_product_dec['msg']."</div><br>";
              // $msg = "success";
            }else{
                  $msgp = "<div class='alert alert-danger' >".$create_product_dec['msg']."</div><br>";
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
            <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Add Products</h6>
              <p class="mb-4">Create a product here</p>

           

              <form method="post" enctype="multipart/form-data" class="user" action="">
              
              <div class="form-group">
              <label>Product Name</label>                                
              <input type="text" required="" class="form-control form-control-sm" value="" id="product_name" name="product_name">      
              </div>

              <div class="form-group">
              <label>Unit Price</label>                                
              <input type="number" required="" class="form-control form-control-sm" value="" id="unit_price" name="unit_price"> </div>

              <div class="form-group">
              <label>Measure Type</label>                                
                 <select required="" class="form-control form-control-sm" value="" id="measure_type" name="measure_type">
                 <option value="kg">kg</option>
               </select>
              </div>

               <div class="form-group">
              <label>Visibility</label>                                
                 <select required="" class="form-control form-control-sm" value="" id="visibility" name="visibility">
                 <option value="0">hide</option>
                 <option value="1">show</option>
               </select>
              </div>


              <div class="form-group">
              <label>Upload Product Image(2Mb Max.)</label>                                
              <input type="file" required=""  class="form-control form-control-sm" id="file_name" name="file_name">      
              </div>

              <input type="submit" value="Create Product" name="cmd_create_product" class="btn btn-primary btn-sm btn-block"/>
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
