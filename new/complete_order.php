<?php  require_once('config/instantiated_files.php');
          $order_no = 'JUP'.unique_id_generator(rand(1111,9999));


       
       if(isset($_POST['cmd_made_payment'])){
            $file_name = $_FILES['payment_proof']['name'];
            $type = $_FILES['payment_proof']['type'];
            $size = $_FILES['payment_proof']['size'];
            $tmp_name = $_FILES['payment_proof']['tmp_name'];
            $order_no = $_POST['order_no'];

            $add_order_and_payment_proof = add_order_and_payment_proof($uid,$order_no,$file_name,$type,$size,$tmp_name,$_SESSION['cart']);
            $add_order_and_payment_proof_dec = json_decode($add_order_and_payment_proof,true);
            if($add_order_and_payment_proof_dec['status'] == 111){
                  $msgp = "<div class='alert alert-success'>Payment Order was successful...please wait...<meta http-equiv='refresh' content='5;url=product_success_order.php' /></div>";
                  //unset($_SESSION['cart']);             
            }else{
                  $msgp = "<div class='alert alert-danger' >".$add_order_and_payment_proof_dec['msg']."</div><br>";

            }
           
       }
        

       include('include/header.php'); 
       // unset($_SESSION['uid']);
       //unset($_SESSION['cart']);

?>


      <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Payment Page</h2>
                       <!--  <div class="breadcrumb__option">
                            <a href="dashboard.php">Home</a>
                            <span>Checkout</span>
                        </div> -->
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
                <h4>Well done, <?php echo $fullname; ?></h4>
                <!-- <p>You can login <a href="checkout.php" style="text-decoration: none; color:black;">Here</a> if you have an account</p> -->
               <?php   if(   isset($_SESSION['cart'])  && (count($_SESSION['cart']) > 0 )   ){?>
               
                    <div class="row">
                    
                        <div class="col-md-12">
                            <?php if(!empty($msgp)){
                            echo $msgp;
                            }?>
                        </div>
               
                        <div class="col-lg-12 col-md-6">
                            <div class="checkout__order">
                                <h4>Complete Your Order</h4>
                                <p> Please make payment to the bank details below and upload payment proof:<br>
                                    <strong>Bank Name: First Bank<br>
                                    Account Number: 3069978872<br>
                                    Account Name: Jupet Farm Fresh 
                                    </strong>
                                </p>

                                <div class="checkout__order__products">Products Details <span>Total</span></div>
                                <ul>
                                    <?php 
                                        foreach($_SESSION['cart'] as $cart_each){
                                            $pro_details = get_one_row_from_one_table_by_id('product_tbl','unique_id',$cart_each['pid'],'date_added');
                                             $pname = $pro_details['product_name'];
                                    ?>
                                    <li><?php echo $pname.' ('.$cart_each['qty'].' '.$pro_details['measure_type'].') Unit Price: &#8358;'.$pro_details['unit_price']; ?><span>&#8358;<?php echo number_format($cart_each['total_price'],2); ?></span></li>
                                    <?php } ?>
                                </ul>
                                <div class="checkout__order__subtotal">Total <span>&#8358;<?php echo number_format(get_total_amount_in_cart($_SESSION['cart']),2); ?></span></div>
                                <!-- <div class="checkout__order__total">Total <span>$750.99</span></div> -->
                                <!-- <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> -->
                                <form method="post" enctype="multipart/form-data">
                                <label>Upload Proof:(Optional)</label>
                                <input type="file"  name="payment_proof" id="payment_proof"><hr>
                                <input required="" id="order_no" name="order_no" value="<?php echo $order_no; ?>" type="hidden">


                                <input type="submit" id="cmd_made_payment" name="cmd_made_payment" class="btn btn-success btn-lg tesdfdt" value="I HAVE MADE PAYMENT"> <hr>
                               <!--  <p>Please Note: After making payment, you can also chat us on Whatsapp: <a target="_blank" style="color: green;" href="https://wa.me/+447999372481?text=My%20name%20is%20<?php //echo $fullname; ?>%20and%20I%20have%20just%20made%20payment%20on%20your%20site"><strong>Click Here</strong></a> 
                                </p> -->

                                </form>
                                <hr>
                                <a href="home.php"  class="btn btn-primary btn-sm">Go to Dashboard</a>
                                <a href="shopping_cart.php"  class="btn btn-warning btn-sm">View Cart</a>
                                <a href="empty_cart.php"  class="btn btn-danger btn-sm">Empty Cart</a>
                            </div>
                        </div>
                    </div>
              
                <?php } else{ ?>

                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                                Oops!, nothing was found in your cart, go to <a style="text-decoration: none; " href="home.php" class="btn btn-success btn-sm">Dashboard</a>
                        </div>
                    </div>

                <?php }?>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->


 <?php include('include/footer.php'); ?>