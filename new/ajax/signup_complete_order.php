<?php session_start();
  require_once('../config/database_functions.php');
   // $cart_session_array = $_SESSION['cart'];
   // print_r($cart_session_array);


  $cart_session_array = $_SESSION['cart'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $address = $_POST['address'];
  $order_notes = $_POST['order_notes'];
  $order_no = $_POST['order_no'];
  
  $customer_signup = customer_signup_with_order($first_name,$last_name,$email,$phone,$password,$cpassword,$address,$order_notes,$order_no,$cart_session_array);
  $customer_signup_dec = json_decode($customer_signup,true);
  if($customer_signup_dec['status'] != 111){
     echo $customer_signup_dec['msg'];
  } else{
    $_SESSION['uid'] = $customer_signup_dec['user_id']; 
    echo 111;
  }

?>