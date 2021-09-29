<?php
$table = "";
$app_name = 'Q8UC';
require_once("db_connect.php");
require_once("config.php");
global $dbc;


//coupon code
function delete_cc($cc_id){
   global $dbc;
   $sql = "DELETE FROM `coupon_codes` WHERE `coupon_id`='$cc_id'";
   $qry = mysqli_query($dbc,$sql);
    return json_encode(array( "status"=>111, "msg"=>"Deleted successfully") );
   
}

function edit_product($product_id,$product_name,$amount,$product_description){
   global $dbc;
   $sql = "UPDATE `custom_product_tbl` SET `product_description`='$product_description',`product_name`='$product_name',`amount`='$amount' WHERE `product_id`='$product_id'";
    mysqli_set_charset($dbc,'utf8');
    mysqli_query($dbc, "SET NAMES 'utf8'");
    mysqli_query($dbc, 'SET CHARACTER SET utf8');
    $qry = mysqli_query($dbc,$sql);

   if($qry){
      return json_encode(array( "status"=>111, "msg"=>"You have successfully edited this product"));    
   }else{
      return json_encode(array( "status"=>104, "msg"=>"server error"));          
   }

}

function add_coupon_codes($uid,$coupon_code,$discount_amount){
   global $dbc;
   $table = "coupon_codes";
   $check_exist = check_record_by_one_param($table,'coupon_code',$coupon_code);

        if($check_exist){
                return json_encode(array( "status"=>109, "msg"=>"This coupon code exists" ));
         }else if( $coupon_code == "" || $discount_amount == ""){
                return json_encode(array( "status"=>109, "msg"=>"Empty field(s) found" ));
         }else{
              $coupon_id = unique_id_generator($coupon_code);
              $sql_insert = "INSERT into `$table` SET
                `coupon_id`='$coupon_id',
                `coupon_code`='$coupon_code',
                `discount_amount`='$discount_amount',
                `added_by`='$uid',
                `date_added`=now()
                ";    
                $qry_insert = mysqli_query($dbc,$sql_insert);        
                return json_encode(array( "status"=>111, "msg"=>"You have successfully added a coupon code" ));
                
         }
}

function get_products_admin(){
         global $dbc;
        $sql = "SELECT * FROM `custom_product_tbl`  ORDER BY `date_added` DESC";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
             while($row = mysqli_fetch_array($query)){
                if( $row['amount'] > 0  ){
                $display[] = $row;
                    
                }
             }              
             return $display;
          }
          else{
             return null;
          }
}

function product_file_upload($file_name, $size, $tmpName,$type){
    // global $dbc;
    $upload_path33 = "products/".$file_name;
    $file_extensions = ['jpg','png'];//pdf,PDF
    $file_extension = substr($file_name,strpos($file_name, '.') + 1);
        //$file_extension = strtolower(end(explode('.', $file_name)));
    
    if(!in_array($file_extension, $file_extensions)){
      return json_encode(["status"=>110,"msg"=>"incorrect_format"]);
    }else{
        // $upload_path33 = 'ebooks/'.$file_name;
        //2Mb
        if($size > 2000000){
          return json_encode(["status"=>130,"msg"=>"too_big"]);
        }else{
          $upload = move_uploaded_file($tmpName, $upload_path33);
          if($upload == true){
              return json_encode(["status"=>111,"msg"=>$upload_path33]);
          }else{
              return json_encode(["status"=>104,"msg"=>"failurerr   ".$upload_path33]);  
          }
        }

    }


}

function create_product($uid,$product_name,$category_id,$amount,$file_name,$type,$size,$tmp_name){
        global $dbc;
        $table = 'custom_product_tbl';
        $uid = secure_database($uid);
        $category_id = secure_database($category_id);
        $amount = secure_database($amount);

        $unique_id = unique_id_generator($category_id.$product_name);
        $check_exist = check_record_by_one_param($table,'product_name',$product_name);

        if($check_exist){
                return json_encode(array( "status"=>109, "msg"=>"This product exists" ));
         }
         else{
                if( $uid == "" || $category_id == "" ||  $amount == "" || $tmp_name == "" 
                  || $size == "" || $file_name == "" || $type == ""){
                  return json_encode(array( "status"=>101, "msg"=>"Empty field(s) found" ));
                }
             
                else{

                   //confirm product_upload
                $product_file_upload = product_file_upload($file_name, $size, $tmp_name,$type);
                $product_file_upload_dec = json_decode($product_file_upload,true);
                $product_path = $product_file_upload_dec['msg']; 

                if($product_file_upload_dec['status'] != 111){
                  return json_encode(array( "status"=>100, "msg"=>$product_file_upload_dec['msg'] ));
                }

                $sql = "INSERT INTO `custom_product_tbl` SET
                `product_id` = '$unique_id',
                `product_name` = '$product_name',
                `amount` = '$amount',   
                `category_id` = '$category_id',
                `img_path` = '$product_path',
                `date_added` = now()
                ";
                mysqli_set_charset($dbc,'utf8');
                mysqli_query($dbc, "SET NAMES 'utf8'");
                mysqli_query($dbc, 'SET CHARACTER SET utf8');
                $query = mysqli_query($dbc, $sql);
            
              if($query){  
                  return json_encode(array( "status"=>111, "msg"=>"You have successfully added a new product"));
                }else{
                return json_encode(array( "status"=>100, "msg"=>"Something went wrong"));
                }


                }

         }
     

}

  function create_admin_user($uid,$fname,$lname,$email,$password,$cpassword){
        global $dbc;
        $table = 'users';
        $uid = secure_database($uid);
        $fname = secure_database($fname);
        $lname = secure_database($lname);
        $email = secure_database($email);
        $password = secure_database($password);
        $hashed_password = md5($password);
        //$img_url = "profiles/avatar.png";
       
        $unique_id = unique_id_generator($fname.$email);
        $check_exist = check_record_by_one_param($table,'email',$email);

         // if($password != $cpassword){
         //        return json_encode(array( "status"=>103, "msg"=>"Password mismatch" ));
         // }

         if($check_exist){
                return json_encode(array( "status"=>109, "msg"=>"This email address exists" ));
         }
         else{
                if( $uid == "" || $fname == "" ||  $lname == "" || $email == "" || $password == "" || $cpassword == ""){
                  return json_encode(array( "status"=>101, "msg"=>"Empty field(s) found" ));
                }
                else if($password != $cpassword){
                  return json_encode(array( "status"=>104, "msg"=>"Password mismatch found" ));
                 }
                else{
                $sql = "INSERT INTO `users` SET
                `unique_id` = '$unique_id',
                `fname` = '$fname',
                `lname` = '$lname',   
                `email` = '$email',
                `role` = 1,
                `img_url`='profiles/default.jpg',
                `password_bare`= '$password',
                `password`= '$hashed_password',
                `date_created` = now()
                ";
                $query = mysqli_query($dbc, $sql);
            
              if($query){
          
                //send email to user for his login credentials
               //  $subject = "Successful Account Creation";
               //  $content = 'Hello,
               //        This is to inform you that your account was successfully created on the SCR Platform.
               //        Your login details below:
               //        Email: '.$username.'
               //        Password: '.$password_bare.'

               //        Thank You.
               //  ';
               
               // email_function($email, $subject, $content);

                 return json_encode(array( "status"=>111, "msg"=>"You have successfully added a new user"));

                }else{

                return json_encode(array( "status"=>100, "msg"=>"Something went wrong"));

                }


                }

         }


        
}



function delete_sn_assignment($delid){
  global $dbc;
    $sql = "DELETE FROM `wp_mobile_serial_numbers` WHERE `id`='$delid'";
        $qry = mysqli_query($dbc,$sql);
        if($qry){
        return json_encode(array( "status"=>111, "msg"=>"Deletion of Record was successful" ));
        }else{
        return json_encode(array( "status"=>102, "msg"=>"failure" ));
        }
}

function assign_wp_mobile_serial_numbers($uid,$product_id,$entered_sn){
  global $dbc;
  $uid = secure_database($uid);
  $product_id = secure_database($product_id);
  $entered_sn = secure_database($entered_sn);
  $check_exist = check_record_by_one_param('wp_mobile_serial_numbers','serial_key',$entered_sn);
  $check_exist2 = check_record_by_one_param('custom_product_tbl','product_id',$product_id);

    if($check_exist){
        $outpval = json_encode(array( "status"=>103, "msg"=>"SN Entry Exists" ));
    }
   else if(!$check_exist2){
        $outpval = json_encode(array( "status"=>105, "msg"=>"Product ID does not exist" ));
    }
    else{
        ///insertion happens here
      $sql_insert = "INSERT INTO `wp_mobile_serial_numbers` SET
          `product_id`='$product_id',
          `serial_key`='$entered_sn',
          `created_date`=now()
       ";
      $qry_insert = mysqli_query($dbc,$sql_insert) or die(mysqli_error($dbc));
      if($qry_insert){
         $outpval =  json_encode(array( "status"=>111, "msg"=>"Assignment was successful" ));
      }else{
         $outpval = json_encode(array( "status"=>104, "msg"=>"Something went wrong" ));
      }

    }

    return $outpval;

}


function get_total_pages_unused($table,$no_per_page){
    global $dbc;
    $no_per_page = secure_database($no_per_page);
    $total_pages_sql = "SELECT COUNT(id) FROM  `$table` WHERE `status`='available' ";
    mysqli_set_charset($dbc,'utf8');
    mysqli_query($dbc, "SET NAMES 'utf8'");
    mysqli_query($dbc, 'SET CHARACTER SET utf8');
    $result = mysqli_query($dbc,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_per_page);
    return $total_pages;
}

function get_total_pages_used($table,$no_per_page){
    global $dbc;
    $no_per_page = secure_database($no_per_page);
    $total_pages_sql = "SELECT COUNT(id) FROM  `$table` WHERE `status`!='available' ";
      mysqli_set_charset($dbc,'utf8');
    mysqli_query($dbc, "SET NAMES 'utf8'");
    mysqli_query($dbc, 'SET CHARACTER SET utf8');
    $result = mysqli_query($dbc,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_per_page);
    return $total_pages;
}

function get_total_rows_unused($table){
    global $dbc;
    $total_pages_sql = "SELECT COUNT(id) FROM  `$table` WHERE `status`='available' ";
    mysqli_set_charset($dbc,'utf8');
    mysqli_query($dbc, "SET NAMES 'utf8'");
    mysqli_query($dbc, 'SET CHARACTER SET utf8');
    $result = mysqli_query($dbc,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    //$total_pages = ceil($total_rows / $no_per_page);
    return $total_rows;
}

function get_total_rows_used($table){
    global $dbc;
    
    $total_pages_sql = "SELECT COUNT(id) FROM  `$table` WHERE `status`!='available' ";
      mysqli_set_charset($dbc,'utf8');
    mysqli_query($dbc, "SET NAMES 'utf8'");
    mysqli_query($dbc, 'SET CHARACTER SET utf8');
    $result = mysqli_query($dbc,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    //$total_pages = ceil($total_rows / $no_per_page);
    return $total_rows;
}

function get_records_with_pagination($table,$offset,$no_per_page,$date_created){
         global $dbc;
        $table = secure_database($table);
        $offset = secure_database($offset);
        $no_per_page = secure_database($no_per_page);
        $sql = "SELECT * FROM `$table`  ORDER BY `$date_created` DESC LIMIT $offset,$no_per_page ";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}


function get_records_unused_sns_with_pagination($table,$offset,$no_per_page,$date_created){
         global $dbc;
        $table = secure_database($table);
        $offset = secure_database($offset);
        $no_per_page = secure_database($no_per_page);
        $sql = "SELECT * FROM `$table` WHERE `status`='available' ORDER BY `$date_created` DESC LIMIT $offset,$no_per_page ";
        mysqli_set_charset($dbc,'utf8');
        mysqli_query($dbc, "SET NAMES 'utf8'");
        mysqli_query($dbc, 'SET CHARACTER SET utf8');
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}

function get_records_used_sns_with_pagination($table,$offset,$no_per_page,$date_created){
         global $dbc;
        $table = secure_database($table);
        $offset = secure_database($offset);
        $no_per_page = secure_database($no_per_page);
        $sql = "SELECT * FROM `$table` WHERE `status`!='available' ORDER BY `$date_created` DESC LIMIT $offset,$no_per_page ";
          mysqli_set_charset($dbc,'utf8');
    mysqli_query($dbc, "SET NAMES 'utf8'");
    mysqli_query($dbc, 'SET CHARACTER SET utf8');
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}


function secure_database($value){
    global $dbc;
    $new_value = mysqli_real_escape_string($dbc,$value);
    return $new_value;
}


function get_products(){
  global $dbc;
  $sql = "SELECT * FROM `custom_product_tbl` WHERE `amount`!=0  ORDER BY id";
  mysqli_set_charset($dbc,'utf8');
  mysqli_query($dbc, "SET NAMES 'utf8'");
  mysqli_query($dbc, 'SET CHARACTER SET utf8');
  $qry = mysqli_query($dbc,$sql);
  $num = mysqli_num_rows($qry);

      while($row = mysqli_fetch_array($qry)){
      $all_row[] = $row;
      }
      return $all_row;  
}

function get_total_pages($table,$no_per_page){
    global $dbc;
    $no_per_page = secure_database($no_per_page);
    $total_pages_sql = "SELECT COUNT(id) FROM  `$table` ";
    $result = mysqli_query($dbc,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_per_page);
    return $total_pages;
}


function check_record_by_one_param($table,$param,$value){
    global $dbc;
    $sql = "SELECT id FROM `$table` WHERE `$param`='$value'";
    $query = mysqli_query($dbc, $sql);
    $count = mysqli_num_rows($query);
    if($count > 0){
      return true; ///exists
    }else{
      return false; //does not exist
    }
    
}  


function check_record_by_one_paramv2($table,$sql_param,$param,$value){
    global $dbc;
    $sql = "SELECT `$sql_param` FROM `$table` WHERE `$param`='$value'";
    $query = mysqli_query($dbc, $sql);
    $count = mysqli_num_rows($query);
    if($count > 0){
      return true; ///exists
    }else{
      return false; //does not exist
    }
    
}  



//////////////////////////////////////////////
//////////////////////////////////////////////
//////////////////////////////////////////////

function delete_upload($unique_id){
  global $dbc;
    $sql = "DELETE FROM `upload_cleaned_data` WHERE `unique_id`='$unique_id'";
        $qry = mysqli_query($dbc,$sql);
        if($qry){
        return json_encode(array( "status"=>111, "msg"=>"Deletion of upload was successful" ));

        }else{

        return json_encode(array( "status"=>102, "msg"=>"failure" ));

        }
}

function delete_file($image_path){
     $real_image = explode('/', $image_path)[2];
     return unlink($image_path);
}

function update_upload_link($unique_id,$upload_link){
     global $dbc;



     if ($unique_id == "" || $upload_link == "") {

          return json_encode(array( "status"=>103, "msg"=>"Empty field(s) found" ));
     
     }else{

       $new_upload_link = "admin/cleaned_data/".$upload_link;

        $sql = "UPDATE `upload_cleaned_data` SET `data_path`='$new_upload_link' WHERE `unique_id`='$unique_id'";
        $qry = mysqli_query($dbc,$sql);
        if($qry){
        return json_encode(array( "status"=>111, "msg"=>"Upload link update was successful" ));

        }else{

        return json_encode(array( "status"=>102, "msg"=>"failure" ));

        }

     }
}

function show_property_transaction_details($transaction_id){
  // global $dbc;
  //  $sql = "SELECT * FROM `property_transactions_tbl` WHERE `transaction_id`='$transaction_id'";
  //  $qry = mysqli_query($dbc,$sql);
  //interested purchaser status
  //show request status
  //make offer status
  //financing status
  //property details
  //inspection 
  //appraisal***
  //repairs
  //closing--lawyer-- bagent and sagent lawyers status 
  global $dbc;
  $sql_get_transaction_details = "SELECT * FROM `property_transactions_tbl` WHERE `transaction_id`='$transaction_id'";
  $qry_get_transaction_details = mysqli_query($dbc,$sql_get_transaction_details);
  $row = mysqli_fetch_array($qry_get_transaction_details);
  $property_id = $row['property_id'];
  $buyer_agent_id = $row['buyer_agent_id'];
  $show_interest_status = $row['show_interest_status'];
  $show_property_status = $row['show_property_status'];
  $make_offer_status = $row['make_offer_status'];
  $financing_status = $row['financing_status'];
  $inspection_status = $row['inspection_status'];
  $appraisal_status = $row['appraisal_status'];
  $repairs_status = $row['repairs_status'];
  $closing_status = $row['closing_status'];
  $last_updated = $row['last_updated'];
  $creation_date = $row['creation_date'];

  $array_for_json = array(
      "transaction_id"=>$transaction_id,
      "property_id"=>$property_id,
      "buyer_agent_id"=>$buyer_agent_id,
      "show_interest_status"=>$show_interest_status,
      "show_property_status"=>$show_property_status,
      "make_offer_status"=>$make_offer_status,
      "financing_status"=>$financing_status,
      "inspection_status"=>$inspection_status,
      "appraisal_status"=>$appraisal_status,
      "closing_status"=>$closing_status,
      "last_updated"=>$last_updated,
      "creation_date"=>$creation_date

  );

  return json_encode($array_for_json);



}

// function show_property_details($property_id){
//   global $dbc;
// }


 function make_offer_process_flow($transaction_id,$approval_status,$approval_date,$by_who_id,$by_who_name,$by_who_email,$to_who_id,$to_who_name,$to_who_email){
   global $dbc;
  //check if the there is an offer for this trans
  //if yes{}else{ rrun the script below}
  
    $buyer_agent_id = "dfe89458ae924a973395613babbf4681";
    $seller_agent_id = "88a7ad886413451d209e6b2867f56bb6";
    $property_id = "52c4e7b57e52c3a1a3c55eb7940c0041";

    $check_exist = check_record_by_one_param('make_offer_tbl','',$transaction_id);

         // if($password != $cpassword){
         //        return json_encode(array( "status"=>103, "msg"=>"Password mismatch" ));
         // }

         if($check_exist){
                return json_encode(array( "status"=>109, "msg"=>"This Email address exists" ));
         }



    $new_json =  array(
            "by_who"=>
            array(
                "id"=>"id of the person involved",
                "name"=>"Kunle Ajayi",
                "email"=>"kunleajayi@gmail.com"  ,
               )
            ,
            "to_who"=>
            array(
                "id"=>"id of the other person involved",
                "name"=>"Joshua Adebiyi",
                "email"=>"joshuaadebiyi@gmail.com"
            )
            ,
            "note_given"=>"not accepted v3",
            "doclink1"=>"link13.com",
            "doclink2"=>"link23.com",
            "status"=>0,
            "date"=>date('Y-m-d')
     );
    // $offer_json = "";
    $sql = "SELECT * FROM `make_offer_tbl` WHERE `property_id`='$property_id' AND `buyer_agent_id`='$buyer_agent_id' AND `seller_agent_id`='$seller_agent_id' ANd `transaction_id`='transaction_id'";
    $qry = mysqli_query($dbc,$sql);
    $row = mysqli_fetch_array($qry);
    $json_details = $row['offer_conversation_json'];
    $json_details_decode = json_decode($json_details,true);

    // for($i = 0; $i < count($json_details_decode); $i++ ){

    // }

    $offer_conversation_json = $json_details_decode['offer_conversation_json'];

   

     array_unshift($offer_conversation_json,$new_json);

     $new_offer_conversation_json = array(
          "property_id"=>$row['property_id'],
          "seller_agent_id"=>$row['seller_agent_id'],
          "buyer_agent_id"=>$row['buyer_agent_id'],
          "final_status"=>$completion_status,
          "expiration_date"=>date('Y-m-d'),
          "last_updated"=>date('Y-m-d'),
          "date_initiated"=>date('Y-m-d'),
          "offer_conversation_json"=>$offer_conversation_json

      ); 

      return json_encode($new_offer_conversation_json);

  }






 function make_offer_process_flow_old(){
  // $completion_status,$buyer_agent_id,$seller_agent_id,$property_id,$current_conversation_json


    global $dbc;


  // if($completion_status == 1){
  //    //////updates ....
  //     //deal progress json

  // }else{

  // }



    $completion_status = 0;
    $buyer_agent_id = "dfe89458ae924a973395613babbf4681";
    $seller_agent_id = "88a7ad886413451d209e6b2867f56bb6";
    $property_id = "52c4e7b57e52c3a1a3c55eb7940c0041";
    // $offer_json = "";
    $sql = "SELECT * FROM `make_offer_tbl` WHERE `property_id`='$property_id' AND `buyer_agent_id`='$buyer_agent_id' AND `seller_agent_id`='$seller_agent_id'";
    $qry = mysqli_query($dbc,$sql);
    $row = mysqli_fetch_array($qry);
    $json_details = $row['offer_conversation_json'];
    $json_details_decode = json_decode($json_details,true);

    // for($i = 0; $i < count($json_details_decode); $i++ ){

    // }

    $offer_conversation_json = $json_details_decode['offer_conversation_json'];

    // $offer_conversation_json = array(
    $new_json =  array(
            "by_who"=>
            array(
                "id"=>"id of the person involved",
                "name"=>"Kunle Ajayi",
                "email"=>"kunleajayi@gmail.com"  ,
                "count"=>count($json_details_decode)     
            )
            ,
            "to_who"=>
            array(
                "id"=>"id of the other person involved",
                "name"=>"Joshua Adebiyi",
                "email"=>"joshuaadebiyi@gmail.com"
            )
            ,
            "note_given"=>"not accepted v3",
            "doclink1"=>"link13.com",
            "doclink2"=>"link23.com",
            "status"=>0,
            "date"=>date('Y-m-d')
     );

     array_unshift($offer_conversation_json,$new_json);

     // for($i = 0; $i < count(); $){

     // }

         $array = array(
          "property_id"=>$row['property_id'],
          "seller_agent_id"=>$row['seller_agent_id'],
          "buyer_agent_id"=>$row['buyer_agent_id'],
          "final_status"=>$completion_status,
          "expiration_date"=>date('Y-m-d'),
          "last_updated"=>date('Y-m-d'),
          "date_initiated"=>date('Y-m-d'),
          "offer_conversation_json"=>$offer_conversation_json

      ); 



    //        array(
    //         "by_who"=>
    //         array(
    //             "id"=>"id of the person involved2",
    //             "name"=>"Simi Man",
    //             "email"=>"simi@gmail.com",
               
    //         )
    //         ,
    //         "to_who"=>
    //         array(
    //             "id"=>"id of the other person involved2",
              
    //               "name"=>"Sammy Jay",
    //             "email"=>"sammy@gmail.com",
    //         )
    //         ,
    //         "note_given"=>"not accepted2",
    //         "doclink1"=>"link12.com",
    //         "doclink2"=>"link22.com",
    //         "status"=>0,
    //         "date"=>date('Y-m-d')
    //       )

    // );
    // $array = array(
    //     "property_id"=>$row['property_id'],
    //     "seller_agent_id"=>$row['seller_agent_id'],
    //     "buyer_agent_id"=>$row['buyer_agent_id'],
    //     "final_status"=>$completion_status,
    //     "expiration_date"=>date('Y-m-d'),
    //     "last_updated"=>date('Y-m-d'),
    //     "date_initiated"=>date('Y-m-d'),
    //     "offer_conversation_json"=>$offer_conversation_json

    // );  new_json



       return json_encode($array);
       // return $json_details;



  }

/////////////////////////////////////////////////////


function update_configuration_email($email){
     global $dbc;

     if ($email == "") {

          return json_encode(array( "status"=>103, "msg"=>"Empty field found" ));
     
     }else{

        $sql = "UPDATE `admin_email` SET `email`='$email',`last_updated`=now() WHERE `id`=1";
        $qry = mysqli_query($dbc,$sql);
        if($qry){
        return json_encode(array( "status"=>111, "msg"=>"Configuration Email was successfully updated" ));

        }else{

        return json_encode(array( "status"=>102, "msg"=>"Update was not successful" ));

        }

     }
}




function get_total_pages_per_user($param,$value,$table,$no_per_page){
    global $dbc;
    $no_per_page = secure_database($no_per_page);
    $total_pages_sql = "SELECT COUNT(id) FROM  `$table` WHERE `$param`='$value' ";
    $result = mysqli_query($dbc,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_per_page);
    return $total_pages;
}


function get_records_with_pagination_per_user($uid,$table,$offset,$no_per_page,$date_created){
         global $dbc;
        $table = secure_database($table);
        $offset = secure_database($offset);
        $no_per_page = secure_database($no_per_page);
        $sql = "SELECT * FROM `$table` WHERE `user_id`='$uid'  ORDER BY `$date_created` DESC LIMIT $offset,$no_per_page ";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}



 


function view_recent_uploads($uid,$count){
  global $dbc;
  $sql = "SELECT * FROM `upload_cleaned_data` WHERE `user_id`='$uid' ORDER BY `upload_time` DESC LIMIT $count";
  $qry = mysqli_query($dbc,$sql);
  $couut = mysqli_num_rows($qry);
    
  if($couut > 0){
      while ($row = mysqli_fetch_array($qry)) {
      $display[] = $row;
      }
      return $display;

  }else{

      return null;
  }
}





function data_upload($file_name, $size, $tmpName,$type){
    global $dbc;
    $upload_path = "admin/cleaned_data/".$file_name;
    $file_extensions = ['xls','xlsx','pdf','docx','doc'];//pdf,PDF
    $file_extension = substr($file_name,strpos($file_name, '.') + 1);
    //$file_extension = strtolower(end(explode('.', $file_name)));
    if(!in_array($file_extension, $file_extensions)){
      return json_encode(["status"=>"0","msg"=>"incorrect_format"]);
    }else{
        //2Mb
        if($size > 300000000){
          return json_encode(["status"=>"0","msg"=>"too_big"]);
        }else{
          $upload = move_uploaded_file($tmpName, $upload_path);
          if($upload){
              return json_encode(["status"=>"111","msg"=>$upload_path]);
          }else{
              return json_encode(["status"=>"109","msg"=>"upload failed"]);  
          }
        }

    }
}

//for oyo state only
function get_lgas(){
  global $dbc;
  $sql = "SELECT * FROM `local_govt` WHERE `state_id`='31'";
  $qry = mysqli_query($dbc,$sql);
  $num = mysqli_num_rows($qry);

      while($row = mysqli_fetch_array($qry)){
      $all_row[] = $row;
      }
      return $all_row;  
}

function get_all_assigned_files(){
  global $dbc;
  $sql = "SELECT * FROM `upload_cleaned_data`";
  $qry = mysqli_query($dbc,$sql);
  $num = mysqli_num_rows($qry);

      while($row = mysqli_fetch_array($qry)){
          $file_name = explode('/',$row['data_path'])[2];
          $all_files[] = $file_name;
      }
      return json_encode($all_files);

}

function add_cleaned_data_vers2($user_id,$file_name,$title,$description,$coverage,$version){
  global $dbc;
        $coverage = json_encode($coverage);
        $data_path = "admin/cleaned_data/".$file_name;
        $unique_id = unique_id_generator($title,$description,$version);
        $sql_chk = "SELECT * FROM `upload_cleaned_data` WHERE `title` ='$title' ";
        $qry_chk = mysqli_query($dbc,$sql_chk);
        $num_chk = mysqli_num_rows($qry_chk);
        if($num_chk > 0){
        return json_encode(array( "status"=>105, "msg"=>"This record title exists" ));

        }else{

        //insert here
        $sql_insert = "INSERT INTO `upload_cleaned_data` SET
          `unique_id`='$unique_id',
          `title`='$title',
          `user_id`='$user_id',
          `description`='$description',
          `coverage`='$coverage',
          `version`='$version',
          `data_path`='$data_path',
          `upload_time`=now()
        ";
        $qry_insert = mysqli_query($dbc,$sql_insert) or die(mysqli_error($dbc));
        if($qry_insert){

                //user details
                $get_user_info =   get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_created');
                $user_username = $get_user_info['username'];
                $user_email = $get_user_info['email'];


                $get_configuration_email =   get_one_row_from_one_table_by_id('admin_email','id',1,'last_updated');
                $config_email = $get_configuration_email['email'];

              //send email to user and admin after succesful upload for his login credentials
                ///to user
                $subjectu = "SCR Successful Data Upload";
                $contentu = 'Hello,
                      This is to inform you that your data was successfully uploaded on the SCR Platform.
                      See details of uploaded data below:
                      Title: '.$title.',
                      Description: '.$description.',
                      Coverage/LGA: '.$coverage.',
                      Version: '.$version.',
                      Date Uploaded: '.date('Y-m-d H:i:sa').'

                      Thank You.
                ';
                email_function($user_email, $subjectu, $contentu);

                

                ///to admin
                $subjectadmin = "User Successful Data Upload";
                $contentadmin = 'Hello,
                      This is to inform you that a user just uploaded data on the SCR Platform.
                      See details of uploaded data below:
                      User Info:
                      Username: '.$user_username.',
                      Email: '.$user_email.',
                      
                      Data Info:
                      Title: '.$title.',
                      Description: '.$description.',
                      Coverage/LGA: '.$coverage.',
                      Version: '.$version.',
                      Date Uploaded: '.date('Y-m-d H:i:sa').'

                      Thank You.
                ';
                email_function($config_email, $subjectadmin, $contentadmin);


            return json_encode(array( "status"=>111, "msg"=>"Great, Upload was successful" ));

        }else{
           
           return json_encode(array( "status"=>101, "msg"=>"Server Error Occured" ));

        }



        }


 

}


function add_cleaned_data($user_id,$file_name,$size,$tmpName,$type,$title,$description,$coverage,$version){
  global $dbc;
  $coverage = json_encode($coverage);
  $data_upload = data_upload($file_name,$size,$tmpName,$type);
  $data_upload_dec = json_decode($data_upload,true);
  if($data_upload_dec['status'] == '111'){
        $data_path = $data_upload_dec['msg'];
        $unique_id = unique_id_generator($title,$description,$version);
        $sql_chk = "SELECT * FROM `upload_cleaned_data` WHERE `title` ='$title' ";
        $qry_chk = mysqli_query($dbc,$sql_chk);
        $num_chk = mysqli_num_rows($qry_chk);
        if($num_chk > 0){
        return json_encode(array( "status"=>105, "msg"=>"This record title exists" ));

        }else{

        //insert here
        $sql_insert = "INSERT INTO `upload_cleaned_data` SET
          `unique_id`='$unique_id',
          `title`='$title',
          `user_id`='$user_id',
          `description`='$description',
          `coverage`='$coverage',
          `version`='$version',
          `data_path`='$data_path',
          `upload_time`=now()
        ";
        $qry_insert = mysqli_query($dbc,$sql_insert) or die(mysqli_error($dbc));
        if($qry_insert){

                //user details
                $get_user_info =   get_one_row_from_one_table_by_id('users','unique_id',$user_id,'date_created');
                $user_username = $get_user_info['username'];
                $user_email = $get_user_info['email'];


                $get_configuration_email =   get_one_row_from_one_table_by_id('admin_email','id',1,'last_updated');
                $config_email = $get_configuration_email['email'];

              //send email to user and admin after succesful upload for his login credentials
                ///to user
                $subjectu = "SCR Successful Data Upload";
                $contentu = 'Hello,
                      This is to inform you that your data was successfully uploaded on the SCR Platform.
                      See details of uploaded data below:
                      Title: '.$title.',
                      Description: '.$description.',
                      Coverage/LGA: '.$coverage.',
                      Version: '.$version.',
                      Date Uploaded: '.date('Y-m-d H:i:sa').'

                      Thank You.
                ';
                email_function($user_email, $subjectu, $contentu);

                

                ///to admin
                $subjectadmin = "User Successful Data Upload";
                $contentadmin = 'Hello,
                      This is to inform you that a user just uploaded data on the SCR Platform.
                      See details of uploaded data below:
                      User Info:
                      Username: '.$user_username.',
                      Email: '.$user_email.',
                      
                      Data Info:
                      Title: '.$title.',
                      Description: '.$description.',
                      Coverage/LGA: '.$coverage.',
                      Version: '.$version.',
                      Date Uploaded: '.date('Y-m-d H:i:sa').'

                      Thank You.
                ';
                email_function($config_email, $subjectadmin, $contentadmin);


            return json_encode(array( "status"=>111, "msg"=>"Great, Upload was successful" ));

        }else{
           
           return json_encode(array( "status"=>101, "msg"=>"Server Error Occured" ));

        }



        }


  }else{

        return json_encode(array( "status"=>109, "msg"=>"Data upload was not successful" ));

  }

}



function get_row_count_no_param($table){
    global $dbc;
    $sql = "SELECT id FROM `$table`";
    $qry = mysqli_query($dbc,$sql);
    $count = mysqli_num_rows($qry);
    if($count > 0){
        return $count;
    }else{
        return 0;
    }
}

function get_row_count_one_param($table,$param,$value){
    global $dbc;
    $sql = "SELECT id FROM `$table` WHERE `$param`='$value'";
    $qry = mysqli_query($dbc,$sql);
    $count = mysqli_num_rows($qry);
    if($count > 0){
        return $count;
    }else{
        return 0;
    }
}

function email_function($email, $subject, $content){
  $headers = "From: SOCU UPLOAD\r\n";
  @$mail = mail($email, $subject, $content, $headers);
  return $mail;
}

//update_profile($uid,$username,$email,$phone,$consultor,$address)

function update_profile($uid,$fname,$lname){
     global $dbc;

     if ($fname == "" || $lname == "" || $uid == "") {

          return json_encode(array( "status"=>103, "msg"=>"Empty field(s) found" ));
     
     }else{

        $sql = "UPDATE `users` SET `fname`='$fname',`lname`='$lname' WHERE `unique_id`='$uid'";
        $qry = mysqli_query($dbc,$sql);
        if($qry){
        return json_encode(array( "status"=>111, "msg"=>"Profile update was successful" ));

        }else{

        return json_encode(array( "status"=>102, "msg"=>"failure" ));

        }

     }
}

function update_password($uid,$password,$cpassword){
     global $dbc;

     if ($password == "" || $cpassword == "" || $uid == "") {

          return json_encode(array( "status"=>103, "msg"=>"Empty field(s) found" ));
     
     }

     else if($password != $cpassword){
          return json_encode(array( "status"=>103, "msg"=>"Password mismatch found" ));
     }

     else{
        $enc_password = md5($password);
        $sql = "UPDATE `users` SET `password`='$enc_password',`password_bare`='$password' WHERE `unique_id`='$uid'";
        $qry = mysqli_query($dbc,$sql) or die(mysqli_error($dbc));
        if($qry){

          $get_user_info =   get_one_row_from_one_table_by_id('users','unique_id',$uid,'date_created');
          $user_username = $get_user_info['username'];
          $user_email = $get_user_info['email'];

          // $get_configuration_email =   get_one_row_from_one_table_by_id('admin_email','id',1,'last_updated');
          // $config_email = $get_configuration_email['email'];

          // ///send email to notify password reset
          //       $subject = "User Successful Data Upload";
          //       $content = 'Hello,
          //             This is to inform you that your password has been reset on the SCR Platform.
          //             See details of uploaded data below:
          //             If you are not aware of this action, kindly send a message to '.$config_email.'

          //             Thank You.
          //       ';
          //       email_function($user_email, $subject, $content);


        return json_encode(array( "status"=>111, "msg"=>"Password reset was successful" ));

        }else{

        return json_encode(array( "status"=>102, "msg"=>"Password reset failed" ));

        }

     }
}


//1- bank to wallet 2 - wallet to bank 3 - from wallet to buy bitcin 4 - back to wallet to sell bitcoin
function view_recent_transactions_all_users($count){
  global $dbc;
  $sql = "SELECT * FROM `transactions` ORDER BY `date_confirmed` DESC LIMIT $count";
  $qry = mysqli_query($dbc,$sql);
  $couut = mysqli_num_rows($qry);
    
  if($couut > 0){
      while ($row = mysqli_fetch_array($qry)) {
      $display[] = $row;
      }
      return $display;

  }else{

      return null;
  }

  
}


//1- bank to wallet 2 - wallet to bank 3 - from wallet to buy bitcin 4 - back to wallet to sell bitcoin
function view_recent_transactions($uid,$count){
  global $dbc;
  $sql = "SELECT * FROM `transactions` WHERE `user_id`='$uid' ORDER BY `date_confirmed` DESC LIMIT $count";
  $qry = mysqli_query($dbc,$sql);
  $couut = mysqli_num_rows($qry);
    
  if($couut > 0){
      while ($row = mysqli_fetch_array($qry)) {
      $display[] = $row;
      }
      return $display;

  }else{

      return null;
  }

  
}



function update_bank_details($uid,$bank_name,$account_name,$account_no){
    global $dbc;

    if($bank_name == "Access Bank Plc"){
                 $bankcode = "044";         
    }

    if($bank_name == "Fidelity Bank Plc"){
                 $bankcode = "070";         
    }

    if($bank_name == "First City Monument Bank Limited"){
                 $bankcode = "214";         
    }

    if($bank_name == "First Bank of Nigeria Limited"){
                 $bankcode = "011";         
    }

    if($bank_name == "Guaranty Trust Bank Plc"){
                 $bankcode = "058";         
    }

    if($bank_name == "Union Bank of Nigeria Plc"){
                 $bankcode = "032";         
    }

    if($bank_name == "United Bank for Africa Plc"){
                 $bankcode = "033";         
    }

    if($bank_name == "Citibank Nigeria Limited"){
                 $bankcode = "023";         
    }

    if($bank_name == "Ecobank Nigeria Plc"){
                 $bankcode = "050";         
    }

    if($bank_name == "Heritage Banking Company Limited"){
                 $bankcode = "030";         
    }

     if($bank_name == "Keystone Bank Limited"){
                 $bankcode = "082";         
    }

     if($bank_name == "Standard Chartered Bank"){
                 $bankcode = "068";         
    }

     if($bank_name == "Stanbic IBTC Bank Plc"){
                 $bankcode = "221";         
    }

     if($bank_name == "Sterling Bank Plc"){
                 $bankcode = "232";         
    }

     if($bank_name == "Titan Trust Bank Limited"){
                 $bankcode = "022";         
    }
      if($bank_name == "Unity Bank Plc"){
                 $bankcode = "215";         
    }
      if($bank_name == "Wema Bank Plc"){
                 $bankcode = "035";         
    }

     

    
    $sql = "UPDATE `users` SET `bank_code`='$bankcode', `bank_name`='$bank_name',`account_name`='$account_name',`account_no`='$account_no',`update_option`=1 WHERE `unique_id`='$uid'";
    $qry = mysqli_query($dbc,$sql);
    if($qry){
    return json_encode(array( "status"=>111, "msg"=>"success" ));

    }else{

    return json_encode(array( "status"=>102, "msg"=>"failure" ));

    }
    
}


function unique_id_generator($data){
    $data = secure_database($data);
    $newid = md5(uniqid().time().rand(11111,99999).rand(11111,99999).$data);
    return $newid;
}


function get_rows_from_one_table($table,$order_option){
         global $dbc;
       
        $sql = "SELECT * FROM `$table` ORDER BY `$order_option` DESC";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
           while($row = mysqli_fetch_array($query)){
             $row_display[] = $row;
           }
                          
            return $row_display;
          }
          else{
             return null;
          }
}

function get_rows_from_one_table_by_id($table,$param,$value,$order_option){
         global $dbc;
        $table = secure_database($table);
        $sql = "SELECT * FROM `$table` WHERE `$param`='$value' ORDER BY `$order_option` DESC";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
             while($row = mysqli_fetch_array($query)){
                $display[] = $row;
             }              
             return $display;
          }
          else{
             return null;
          }
}


function check_profile_update($uid,$bank_name,$account_name,$account_no,$update_option){
   global $dbc;
   $sql = "SELECT * FROM users WHERE `unique_id`='$uid'";
   $qry = mysqli_query($dbc,$sql);
   $count = mysqli_num_rows($qry);
   if($count >= 1){
         
         if( ($bank_name == NULL || $account_name == NULL || $account_no == NULL) && $update_option == 0 ){
                return json_encode(array( "status"=>101, "msg"=>"To continue, kindly update your profile..." ));
         }else{
                return json_encode(array( "status"=>111, "msg"=>"Good Standing" ));

         }
   }  
}






function user_login($email,$password){
   global $dbc;
   $email = secure_database($email);
   $password = secure_database($password);
   $hashpassword = md5($password);

   $sql = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$hashpassword' AND `role`=1";
   $query = mysqli_query($dbc,$sql);
   $count = mysqli_num_rows($query);
   if($count === 1){
      $row = mysqli_fetch_array($query);
      $fname = $row['fname'];
      $lname = $row['lname'];
      $phone = $row['phone'];
      $email = $row['email'];
      $unique_id = $row['unique_id'];
      $access_status = $row['access_status'];

      if($access_status != 1){
                return json_encode(array( "status"=>101, "msg"=>"Sorry, you currently do not have access. Contact Admin!" ));
      }else{
                return json_encode(array( 
                    "status"=>111, 
                    "user_id"=>$unique_id, 
                    "fname"=>$fname, 
                    "lname"=>$lname, 
                    "phone"=>$phone, 
                    "email"=>$email 
                  )
                 );

      }
    
   }else{
                return json_encode(array( "status"=>102, "msg"=>"Wrong username or password!" ));

   }
 

}




function admin_login($email,$password){
   global $dbc;
   $email = secure_database($email);
   $password = secure_database($password);
   $hashpassword = md5($password);

   $sql = "SELECT * FROM users WHERE `email`='$email' AND `password`='$hashpassword' AND `role`=1";
   $query = mysqli_query($dbc,$sql);
   $count = mysqli_num_rows($query);
   if($count === 1){
      $row = mysqli_fetch_array($query);
      $fname = $row['fname'];
      $lname = $row['lname'];
      $phone = $row['phone'];
      $email = $row['email'];
      $unique_id = $row['unique_id'];
      $access_status = $row['access_status'];

      if($access_status != 1){
                return json_encode(array( "status"=>101, "msg"=>"Sorry, you currently do not have access. Contact Admin!" ));
      }else{
                return json_encode(array( 
                    "status"=>111, 
                    "user_id"=>$unique_id, 
                    "fname"=>$fname, 
                    "lname"=>$lname, 
                    "phone"=>$phone, 
                    "email"=>$email 
                  )
                 );

      }
    
   }else{
                return json_encode(array( "status"=>102, "msg"=>"Wrong username and password!" ));

   }
 

}


function get_one_row_from_one_table_by_id($table,$param,$value,$order_option){
         global $dbc;
        $table = secure_database($table);
        $sql = "SELECT * FROM `$table` WHERE `$param`='$value' ORDER BY `$order_option` DESC";
        mysqli_set_charset($dbc,'utf8');
        mysqli_query($dbc, "SET NAMES 'utf8'");
        mysqli_query($dbc, 'SET CHARACTER SET utf8');
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
             $row = mysqli_fetch_array($query);              
             return $row;
          }
          else{
             return null;
        }
    }

function get_one_row_from_one_table_by_two_params($table,$param,$value,$param2,$value2,$order_option){
         global $dbc;
        $table = secure_database($table);
        $sql = "SELECT * FROM `$table` WHERE `$param`='$value' AND `$param2`='$value2' ORDER BY `$order_option` DESC";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
             $row = mysqli_fetch_array($query);              
             return $row;
          }
          else{
             return null;
        }
    }


    function get_one_row_from_one_table_by_three_params($table,$param,$value,$param2,$value2,$param3,$value3,$order_option){
         global $dbc;
        $table = secure_database($table);
        $sql = "SELECT * FROM `$table` WHERE `$param`='$value' AND `$param2`='$value2' AND `$param3`='$value3' ORDER BY `$order_option` DESC";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
             $row = mysqli_fetch_array($query);              
             return $row;
          }
          else{
             return null;
        }
    }




function  delete_record($table,$param,$value){
    global $dbc;
    $sql = "DELETE FROM `$table` WHERE `$param`='$value'";
    $query = mysqli_query($dbc,$sql);
    if($query){
      return true;
    }else{
      return false;
    }
}


function get_visible_rows_from_events_with_pagination($table,$offset,$no_per_page){
         global $dbc;
        $table = secure_database($table);
        $offset = secure_database($offset);
        $no_per_page = secure_database($no_per_page);
        $sql = "SELECT * FROM `events_tbl` WHERE visibility = 1 ORDER BY date_added DESC LIMIT $offset,$no_per_page ";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}

function get_visible_rows_from_events_with_limit($table,$limit){
         global $dbc;
        $table = secure_database($table);
       
        $sql = "SELECT * FROM `events_tbl` WHERE visibility = 1 ORDER BY date_added DESC LIMIT $limit";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}






function get_rows_from_one_table_with_pagination($table,$offset,$no_per_page){
         global $dbc;
        $table = secure_database($table);
        $offset = secure_database($offset);
        $no_per_page = secure_database($no_per_page);
        $sql = "SELECT * FROM `$table` ORDER BY date_added DESC LIMIT $offset,$no_per_page ";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            while($row = mysqli_fetch_array($query)){
                $row_display[] = $row;
                }
            return $row_display;
          }
          else{
             return null;
          }
}


function update_by_one_param($table,$param,$value,$condition,$condition_value){
  global $dbc;
  $sql = "UPDATE `$table` SET `$param`='$value' WHERE `$condition`='$condition_value'";
  $qry = mysqli_query($dbc,$sql);
  if($qry){
     return true;
  }else{
      return false;
  }
}


/////////most important functions ends
