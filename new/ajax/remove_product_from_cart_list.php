<?php session_start();
  require_once('../config/database_functions.php');
   $product_id = $_GET['getid'];
   $key = explode('_',$product_id)[0];
   $keyint = intval($key);
   unset($_SESSION['cart'][$keyint]);
   array_splice($_SESSION['cart'], 0, 0);
   echo 111;
?>