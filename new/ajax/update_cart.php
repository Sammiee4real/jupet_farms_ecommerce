<?php session_start();
  require_once('../config/database_functions.php');
    $product_string = $_GET['getid'];
    $product_qty = $_GET['product_qty'];

   $key = explode('_',$product_string)[0];
   $product_id = explode('_',$product_string)[1];
   $keyint = intval($key);

   if($product_qty == 0 || $product_qty == ""){
      echo "Please select a quantity";
   }else{

       foreach($_SESSION['cart'] as $cart_each){
            ///what we want to adjust
            if( $cart_each['pid'] == $product_id){
              unset($_SESSION['cart'][$keyint]);

              $get_other_pro_details = get_one_row_from_one_table_by_id('product_tbl','unique_id',$product_id,'date_added');
              $product_price = $get_other_pro_details['unit_price'];
              //add the new row now
              $product_det = array(
              "pid"=>$product_id,
              "qty"=>$product_qty,
              "unit_price"=>$product_price,
              "total_price"=>$product_price * $product_qty
              );
              array_unshift($_SESSION['cart'],$product_det);
              array_splice($_SESSION['cart'], 0, 0);


             
            }
        }
       echo 111;


   }

   


?>