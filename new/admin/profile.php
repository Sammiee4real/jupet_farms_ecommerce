<?php  require_once('../config/admin_instantiated_files.php');
       include('inc/header.php'); 


       if(isset($_POST['cmd_update'])){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
        
            $update_profile =  update_profile($uid,$fname,$lname);
            $update_profile_dec = json_decode($update_profile,true);
            if($update_profile_dec['status'] == 111){
            $msgupdate = "<div class='alert alert-success' >".$update_profile_dec['msg']."</div><br>";
            // $msg = "success";
            }else{
             $msgupdate = "<div class='alert alert-danger' >".$update_profile_dec['msg']."</div><br>";
            // $msg = "failed";
            }


       }

      
      if(isset($_POST['cmd_resetp'])){

            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

          $update_password =  update_password($uid,$password,$cpassword);
          $update_password_dec = json_decode($update_password,true);
          if($update_password_dec['status'] == 111){
              $msgp = "<div class='alert alert-success' >".$update_password_dec['msg']."</div><br>";
            // $msg = "success";
          }else{
                $msgp = "<div class='alert alert-danger' >".$update_password_dec['msg']."</div><br>";
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
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
            <!-- <a href="#" data-toggle='modal' data-target = '#upload_cleaned_data' class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Upload Cleaned Data</a> -->
          </div>

      



    

        <div class="row">

          <div class="col-md-6">
            <h6 class="m-0 font-weight-bold text-primary">View Profile</h6>
              <p class="mb-4">View your profile details here</p>

              <div class="alert alert-primary">         
                  Email: <?php echo $email; ?><br>
                  Phone Number: <?php echo $phone; ?><br>
                  Date of Creation: <?php echo date('F-d-Y',strtotime($date_created)); ?>

              </div>
              <hr>
              
              <div class="row">
              <div class="col-md-12">
              <?php if(!empty($msgp)){

              echo $msgp;

              }?>
              </div>
              </div>

              <form method="post" enctype="multipart/form-data" class="user" action="">
              <h6 class="m-0 font-weight-bold text-primary">Reset Password</h6>
              <div class="form-group">
              <label>Password</label>                                
              <input type="password" required="" class="form-control form-control-sm" value="" id="password" name="password">      
              </div>

              <div class="form-group">
              <label>Confirm Password</label>                                
              <input type="password" required="" class="form-control form-control-sm" value="" id="cpassword" name="cpassword">      
              </div>

              <input type="submit" value="Reset Password" name="cmd_resetp" class="btn btn-danger btn-sm btn-block"/>
              </a>
              </form>


          </div>
          
              <div class="col-md-6">
                <div class="row">
                <div class="col-md-12">
                <?php if(!empty($msgupdate)){

                echo $msgupdate;

                }?>
                </div>
                </div>
              <h6 class="m-0 font-weight-bold text-primary">Update Profile</h6>
              <p class="mb-4">You can update your profile here</p>

            <div class="card shadow mb-4">


                   <div class="row">
          <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
          <div class="col-lg-12">
            <div class="p-3">
            
              <form method="post" enctype="multipart/form-data" class="user" action="">
                <div class="form-group">
                    <label>First Name</label>                                
                    <input type="text" required="" class="form-control form-control-sm" value="<?php echo $first_name; ?>" id="fname" name="fname" >      
                </div>
                 <div class="form-group">
                    <label>Last Name</label>                                
                    <input type="text" required="" class="form-control form-control-sm" value="<?php echo $last_name; ?>" id="lname" name="lname">      
                </div>
                       
               
                <input type="submit" value="Update Now" name="cmd_update" class="btn btn-primary btn-sm btn-block"/>
                </a>
                
              </form>
             
              
           
            </div>
            </div>
          </div>


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
