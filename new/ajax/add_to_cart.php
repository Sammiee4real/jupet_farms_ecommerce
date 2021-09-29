<?php  session_start();
       require_once('../config/database_functions.php');

      if(empty($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
      }
        
         $quantity = intval($_POST['quantity']);
         $product_id = strval($_POST['product_id']);

        $get_other_details = get_one_row_from_one_table_by_id('product_tbl','unique_id',$product_id,'date_added');
        $product_price = $get_other_details['unit_price'];

        if($quantity == 0 || $quantity == "" || empty($quantity)){
            echo "Please enter quantity";
        }else{
                    if(count($_SESSION['cart']) == 0){
          
           $product_det = array(
              "pid"=>$product_id,
              "qty"=>$quantity,
              "unit_price"=>$product_price,
              "total_price"=>$product_price * $quantity
              );
            array_push($_SESSION['cart'],$product_det);

            echo 111;

        }else{

          // foreach($_SESSION['cart'] as $each_item){
          //check if product is in cart already
          if( empty( array_search($product_id, array_column($_SESSION['cart'], 'pid')) )  ){

              $product_det = array(
              "pid"=>$product_id,
              "qty"=>$quantity,
              "unit_price"=>$product_price,
              "total_price"=>$product_price * $quantity

              );
              array_push($_SESSION['cart'],$product_det);
              echo 111;
          }else{
           echo "Product exists in Cart already";
           //echo json_encode($_SESSION['cart']);
          }

        // }

         

      }

        }





?>