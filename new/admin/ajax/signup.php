<?php 
  session_start();
  require_once('../admin/config/database_functions.php');
  $password =  $_POST['password'];
  $email =  $_POST['email'];
  $fname =  $_POST['fname'];
  $lname =  $_POST['lname'];
  $phone =  $_POST['phone'];
  $password =  $_POST['password'];
  $cpassword =  $_POST['cpassword'];
  $gender =  $_POST['gender'];
  $ref =  $_POST['ref'];
  
  if($ref == ""){
  	$ref2 = "admin";
  }else{
  	$ref2 = $ref;

  }
  

  $signup = user_signup($fname,$lname,$email,$phone,$password,$cpassword,$ref2,$gender);
  $signup_dec = json_decode($signup,true);
  if($signup_dec['status'] != 111){

    echo $signup_dec['msg'];
 
  } else{

    echo 200;
     

  }

?>