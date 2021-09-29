<?php require_once('../config/admin_instantiated_files.php');
       include('inc/header.php'); 
       $global_pending_orders = get_global_customer_pending_orders();


     


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
            <h1 class="h3 mb-0 text-gray-800">Pending Orders</h1>
            
          </div>

      



    

        <div class="row">

         
          
              <div class="col-md-11">
           
              <h6 class="m-0 font-weight-bold text-primary">View Pending Orders</h6>
              <p class="mb-4">You can view your all pending orders here</p>



              <!-- <div class="card shadow mb-4"> -->
           
                    <div class="table-responsive">
                    <button 
                      class="btn btn-sm btn-primary btn-flat"
                      data-table = 'users' 
                      data-cols='fname, lname, onames, phone, email' 
                      id="toPDF"
                    >Download Table PDF</button>
						<table id="dataTable" class="table table-bordered table-striped display nowrap">
							<thead>
								<tr>
									<th>SN</th>
                  <th>ORDER NO</th>
									<th>PAYMENT STATUS</th>
									<th>DELIVERY STATUS</th>
									<th></th>
													
								</tr>
							</thead>
                            <tbody>
                                <?php
                                  global $dbc;


                                  $output = '';
                                  $sql = "SELECT * FROM `orders` WHERE  `payment_status`=0 AND `delivery_status`=0 GROUP BY `invoice_no`";
                                  $query = mysqli_query($dbc, $sql);
                                  $i = 1;
                                  while($data = mysqli_fetch_assoc($query)) {
                                    $img = !empty($data['img_url'])?$data['img_url']:'profiles/default.jpg';
                                    // $grp_name = 'No Group'; 
                                    // $coop_name = 'No Cooperative';
                                    // $role_name = 'No Role';

                                     $grp_name = '-'; 
                                    $coop_name = '-';
                                    $role_name = '-';


                                     if(!empty($data['role'])) $role_name = getRoleName($data['role']);

                                    $active = $data['activation_status'] == 0?'<button class="badge btn-danger btn-sm">Not Activated</button>':'<button class="badge btn-success btn-sm">Activated</button>';
                                    $access = $data['access_status'] == 0?'<button class="badge btn-danger btn-sm">Archived User</button>':'<button class="badge btn-success btn-sm">Active User</button>';
                                                                     

                                    if( $data['cooperative_group_id'] == null ){
                                           // $farm_name = "No Farm Record";
                                           // $farm_address = "No Farm Address";
                                           $farm_name = "-";
                                           $farm_address = "-";
                                        
                                    }else{

                                             $project_id_for_cooperative = getData('project_id', 'cooperative_projects_assignment', 'cooperative_id', $data['cooperative_group_id']);
                                          $project_name = getData('project_name', 'projects', 'unique_id', $project_id_for_cooperative);
                                         
                                          $farm_id_for_project = getDataOne('farm_id', 'project_farms_assignment', 'project_id', $project_id_for_cooperative);
                                          $farm_name = getData('farm_name', 'farms', 'unique_id', $farm_id_for_project);
                                          $farm_address = getData('farm_address', 'farms', 'unique_id', $farm_id_for_project);

                                    }

                                    $state_name = getData('name', 'states', 'id', $data['state']);
                                    $lga_name = getData('name', 'local_governments', 'id', $data['lga']);
                                   

                        
                                    
                                      $output .= '<tr>';
                                      $output.='<td>'.$i.'</td>';
                                      $output.='<td>'.$data['lname'].'</td>';
                                      $output.='<td>'.$data['fname'].'</td>';
                                      $output.='<td>'.$data['onames'].'</td>';
                                      $output.='<td>'.$data['gender'].'</td>';
                                    

                                      if($role == $admin_unique_id){
                                      $output.='<td>
                                         <a href="edit_member?memid='.$data["unique_id"].'" role="button" class="btn btn-warning btn-sm">
                                          <i class="fa fa-edit"></i> Edit
                                        </a>
                                      ';
                                      if($data['access_status'] == 1):
                                        $output.='
                                        <button 
                                          id="action_button" 
                                          data-action="change_access" 
                                          data-page = "users" 
                                          data-url="edit_actions"
                                          data-id="'.$data['unique_id'].'" 
                                          data-refresh="true" 
                                          data-ref="access_status" 
                                          data-val="0" 
                                          class="btn btn-danger btn-sm" 
                                        >
                                          <i class="fa fa-user-times"></i> Disable
                                        </button>
                                      ';
                                      else :
                                        $output .='
                                        <button 
                                          id="action_button" 
                                          data-action="change_access" 
                                          data-page = "users" 
                                          data-url="edit_actions"
                                          data-id="'.$data['unique_id'].'" 
                                          data-refresh="true" 
                                          data-ref="access_status" 
                                          data-val="1" 
                                          class="btn btn-success btn-sm" 
                                        >
                                          <i class="fa fa-user-plus"></i> Enable
                                        </button>';
                                      endif;
                                      $output.='
                                      </td>';
                                     }
                                
                                      $output .='</tr>';
                                      $i++;
                                  }
                                  
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
    