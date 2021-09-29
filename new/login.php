<?php session_start();
 if(isset($_SESSION['uid'])){
        header('location: home.php');
      }
include('config/database_functions.php'); 
include('include/header.php'); 
//unset($_SESSION['quantity']);
//unset($_SESSION['cart']);

//get all products
$products = get_rows_from_one_table('product_tbl','date_added');

if(empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
 }

if(isset($_POST['cmd_add_to_cart'])){
    
    $quantity = $_POST['quantity'];
    $product_id = $_POST['product_id'];

    $get_other_details = get_one_row_from_one_table_by_id('product_tbl','unique_id',$product_id,'date_added');
    $product_price = $get_other_details['unit_price'];

    if(count($_SESSION['cart']) == 0){
        
         $product_det = array(
            "pid"=>$product_id,
            "qty"=>$quantity,
            "unit_price"=>$product_price,
            "total_price"=>$product_price * $quantity
            );
          array_push($_SESSION['cart'],$product_det);
    }else{

        foreach($_SESSION['cart'] as $each_item){
        //it's there already
        if( empty( array_search($product_id, array_column($_SESSION['cart'], 'pid')) )  ){

            $product_det = array(
            "pid"=>$product_id,
            "qty"=>$quantity,
             "unit_price"=>$product_price,
            "total_price"=>$product_price * $quantity

            );
            array_push($_SESSION['cart'],$product_det);

        }else{}

        }
    }
}




// echo $_SESSION['cart'][2]['pid'];
//echo $_SESSION['cart'][2]['pid'];

?>


      <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Login</h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Home</a>
                            <span>Login</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

   
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
           
            <div class="checkout__form">
                <h4>Checkout Details</h4>
                <p>You can signup here <a href="checkout.php" style="text-decoration: none; color:black;">Here</a> if you do not have an account</p>
                <form action="#" method="post" id="login_form">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" id="email" name="email">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Password<span>*</span></p>
                                        <input type="password" id="password" name="password">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                         <button type="submit" class="btn btn-success btn-lg login_btn">LOGIN</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                  
                      <?php include('include/cart.php') ?>
                     

                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->


 <?php include('include/footer.php'); ?>