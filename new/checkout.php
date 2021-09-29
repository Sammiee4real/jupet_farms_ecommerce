<?php session_start();
if(  isset($_SESSION['uid'])  ){
        header('location: complete_order.php');
  }

include('config/database_functions.php'); 
include('include/header.php');



//unset($_SESSION['quantity']);
//unset($_SESSION['cart']);
$order_no = 'JUP'.unique_id_generator(rand(1111,9999));

?>


      <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Home</a>
                            <span>Checkout</span>
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
                <p>You can login <a href="login.php" style="text-decoration: none; color:black;">Here</a> if you have an account</p>
                <form action="#" method="post" id="signup_complete_order_form">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input required="" id="first_name" name="first_name" type="text">
                                        <input required="" id="order_no" name="order_no" value="<?php echo $order_no; ?>" type="hidden">
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input required="" id="last_name" name="last_name" type="text">

                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                         <input required="" id="phone" name="phone" type="number">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input required="" id="email" name="email" type="email">
                                    </div>
                                </div>
                            </div>


                            <div class="checkout__input">
                                <p>Delivery Address<span>*</span></p>
                                <input required="" id="address" name="address" type="text" placeholder="Enter your location)">

                            </div>

                              <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Password<span>*</span></p>
                                        <input required="" id="password" name="password" type="password">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Confirm Password<span>*</span></p>
                                        <input required="" id="cpassword" name="cpassword" type="password">

                                    </div>
                                </div>
                            </div>

                           <!--  <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Ship to a different address?
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div> -->
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text" id="order_notes" name="order_notes" placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>

                           <button type="submit" class="btn btn-success btn-lg signup_complete_order_btn">SIGN UP TO COMPLETE ORDER</button>


                        </div>
                        


                       <?php include('include/cart.php') ?>


                    </div>
                </form>


            </div>
        </div>
    </section>
    <!-- Checkout Section End -->


 <?php include('include/footer.php'); ?>