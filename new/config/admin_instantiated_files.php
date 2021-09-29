<?php session_start();
     include('database_functions.php');
     if(!isset($_SESSION['uuid'])){
        header('location: index.php');
      }
     $uid = $_SESSION['uuid'];
     $user_details = get_one_row_from_one_table_by_id('admin','unique_id',$uid,'date_created');
     $first_name = $user_details['fname'];
     $last_name = $user_details['lname'];
     $fullname = $first_name.' '.$last_name;
     $phone = $user_details['phone'];
     $address = $user_details['address'];
     $email = $user_details['email'];
     $date_created = $user_details['date_created'];
     
      // $role_details = get_one_row_from_one_table_by_id('role_privileges','role_id',$role,'date_added');
      // $role_name = $role_details['role_name'];
      // $privileged_pages = $role_details['pages_access'];
      // $privileged_pages_dec = json_decode($privileged_pages,true);
      // //$curr_page = basename($_SERVER['PHP_SELF']);

      // $current_page = explode('.',basename($_SERVER['PHP_SELF']))[0];

      // ///this works only for users, super admin are exempted
      // // echo $current_page[0];
      // if($role == $user_unique_id){
      // if(!in_array($current_page, $privileged_pages_dec)  ){
      // header('location: access_denied');
      // }
      // }


     //////////pagination script starts
		if (isset($_GET['pageno'])) {
		$pageno = $_GET['pageno'];
		} else {
		$pageno = 1;
		}
		$no_per_page = 10;
		$offset = ($pageno-1) * $no_per_page; 
		/////////pagination script ends
?>