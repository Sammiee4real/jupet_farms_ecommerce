<?php 
  session_start();
  require_once('../../config/database_functions.php');
  $password =  $_POST['password'];
  $email =  $_POST['email'];
  $login = user_login($email,$password);
  $login_dec = json_decode($login,true);
  if($login_dec['status'] != 111){
    echo $login_dec['msg'];
  } else{
  	$_SESSION['uuid'] = $login_dec['user_id']; 
    echo 200;
  }

?>