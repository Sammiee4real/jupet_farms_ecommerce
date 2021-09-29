<?php session_start();
  require_once('../config/database_functions.php');

  $email = $_POST['email'];
  $password = $_POST['password'];
  
  $customer_login = customer_login($email,$password);
  $customer_login_dec = json_decode($customer_login,true);
  if($customer_login_dec['status'] != 111){
     echo $customer_login_dec['msg'];
  } else{
    $_SESSION['uid'] = $customer_login_dec['user_id']; 
    echo 111;
  }

?>