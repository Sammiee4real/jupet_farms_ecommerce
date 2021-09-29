<?php 
  session_start();
  require_once('../../config/database_functions.php');
  $orderid =  $_GET['orderid'];
  $mark_as_delivered = mark_as_delivered($orderid);
  $mark_as_delivered_dec = json_decode($mark_as_delivered,true);
  if($mark_as_delivered_dec['status'] != 111){
    echo $mark_as_delivered_dec['msg'];
  } else{
    echo 111;
  }

?>