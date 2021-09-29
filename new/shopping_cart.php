<?php session_start();
include('config/database_functions.php'); 
include('include/header.php'); 
//unset($_SESSION['quantity']);
//unset($_SESSION['cart']);
$order_no = 'JUP'.unique_id_generator(rand(1111,9999));

//echo json_encode($_SESSION['cart']);

?>


      <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Home</a>
                            <span>Cart List</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

<?php   if(   isset($_SESSION['cart'])  && (count($_SESSION['cart']) > 0 )   ){?>
     <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <!-- <form id="shopping_cart_form" method="post"> -->
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity(kg)</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php  
                                        $pp = 0;
                                        foreach($_SESSION['cart'] as $cart_each){
                                            $pro_details = get_one_row_from_one_table_by_id('product_tbl','unique_id',$cart_each['pid'],'date_added');
                                             $pname = $pro_details['product_name'];
                                             $product_path = $pro_details['product_path'];

                                      

                                    ?>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="admin/<?php echo $product_path; ?>" alt="" width="140" height="120">
                                        <h5><?php echo $pname; ?></h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        &#8358;<?php echo number_format($cart_each['unit_price'],2); ?>
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <!-- class="form-control form-control-sm col-4"  -->
                                                <input type="text" name="product_qty<?php echo $pp.'_'.$cart_each['pid']; ?>" id="product_qty<?php echo $pp.'_'.$cart_each['pid']; ?>" value="<?php echo $cart_each['qty']; ?>">
                                            </div>
                                            <a href="#" class="btn btn-sm btn-success col-4 update_cart" id="<?php echo $pp.'_'.$cart_each['pid']; ?>"><span class="icon_loading" style="color:green;font-weight: 900;"></span>update</a>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        &#8358;<?php echo number_format($cart_each['total_price'],2); ?>
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="#" class="remove_product_from_cart" id="<?php echo $pp.'_'.$cart_each['pid']; ?>"><span class="icon_close "></span></a>
                                    </td>
                                </tr>
                                 <?php $pp++; } ?>
                               
                            </tbody>
                        </table>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="index.php" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                       <!--  <a href="#" class="primary-btn cart-btn cart-btn-right btn-success"><span class="icon_loading"></span>
                            Update Cart</a> -->
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Total <span>&#8358;<?php echo number_format(get_total_amount_in_cart($_SESSION['cart']),2);  ?></span></li>
                        </ul>
                        <a href="checkout.php" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } else{ ?>

        <section class="shoping-cart spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                                <a href="index.php" class="btn btn-primary btn-sm">No product found in cart</a>
                    </div>
                </div>
            </div>
        </section>
<?php }?>
    <!-- Shoping Cart Section End -->

  


 <?php include('include/footer.php'); ?>