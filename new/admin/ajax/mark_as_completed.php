<?php 
  session_start();
  require_once('../../config/database_functions.php');
  $orderid =  $_GET['orderid'];
  $mark_as_completed = mark_as_completed($orderid);
  $mark_as_completed_dec = json_decode($mark_as_completed,true);
  if($mark_as_completed_dec['status'] != 111){
    echo $mark_as_completed_dec['msg'];
  } else{
    echo 111;
  }

?>