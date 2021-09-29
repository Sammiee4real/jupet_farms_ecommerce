<?php session_start();
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
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#">
                <img src="img/logo.jpg" width="190" height="190" alt="">
            </a>
        </div>
        <div class="humberger__menu__cart">
                        <ul>
                        <li><a href="checkout.php"><i class="fa fa-shopping-bag"></i> <span><?php echo count($_SESSION['cart']); ?></span></a></li>
                        </ul>
                        <div class="header__cart__price">Total: <span>&#8358;<?php echo get_total_amount_in_cart($_SESSION['cart']); ?></span></div>
        </div>
        <div class="humberger__menu__widget">
            <!-- <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div> -->
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
              <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="#">Products</a></li>
                            <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> support@jupetfarmfresh.com</li>
                <li><i class="fa fa-envelope"></i>  Call:  +234 8151281541, 08101493108 Whatsapp:  +234 8151281541, 08101493108, support 24/7 time support</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> support@jupetfarmfresh.com</li>
                                 <li><i class="fa fa-phone"></i>  Call/Whatsapp:  +234 8151281541, 08101493108</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <!-- <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div> -->
                            <div class="header__top__right__auth">
                                <a href="#"><i class="fa fa-user"></i> Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="#">
                         <img width="100" height="80" src="img/logo.jpg" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="index.php">Home</a></li>
                            <!-- <li><a href="#">Products</a></li> -->
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                       
                            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span><?php echo count($_SESSION['cart']); ?></span></a></li>
                        </ul>
                        <div class="header__cart__price">Total: <span>&#8358;<?php echo get_total_amount_in_cart($_SESSION['cart']); ?></span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

      <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="dashboard.php">Home</a>
                            <!-- <span>Checkout</span> -->
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
                <h4>Hello Samuel</h4>
                <!-- <p>You can login <a href="checkout.php" style="text-decoration: none; color:black;">Here</a> if you have an account</p> -->
                <form action="#">
                    <div class="row">
                       
                        <div class="col-lg-12 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    <?php 
                                        foreach($_SESSION['cart'] as $cart_each){
                                            $pro_details = get_one_row_from_one_table_by_id('product_tbl','unique_id',$cart_each['pid'],'date_added');
                                             $pname = $pro_details['product_name'];
                                    ?>
                                    <li><?php echo $pname.' ('.$cart_each['qty'].' '.$pro_details['measure_type'].')'; ?><span>&#8358;<?php echo number_format($cart_each['total_price'],2); ?></span></li>
                                    <?php } ?>
                                </ul>
                                <div class="checkout__order__subtotal">Total <span>&#8358;<?php echo get_total_amount_in_cart($_SESSION['cart']); ?></span></div>
                                <!-- <div class="checkout__order__total">Total <span>$750.99</span></div> -->
                                <!-- <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> -->
                               
                                <button type="submit" class="btn btn-success btn-sm">MAKE PAYMENT</button>
                                <button type="submit" class="btn btn-danger btn-sm">EMPTY CART</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->


 <?php include('include/footer.php'); ?>