 <div class="col-lg-6 col-md-6">
                        <?php if(   isset($_SESSION['cart'])  && (count($_SESSION['cart']) > 0 )   ){?>
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Price</span></div>
                                <ul>
                                    <?php 
                                        foreach($_SESSION['cart'] as $cart_each){
                                            $pro_details = get_one_row_from_one_table_by_id('product_tbl','unique_id',$cart_each['pid'],'date_added');
                                             $pname = $pro_details['product_name'];
                                    ?>
                                    <li><?php echo $pname.' ('.$cart_each['qty'].' '.$pro_details['measure_type'].')'; ?><span>&#8358;<?php echo number_format($cart_each['total_price'],2); ?></span></li>
                                    <?php } ?>
                                </ul>
                                <div class="checkout__order__subtotal">Total <span>&#8358;<?php echo number_format(get_total_amount_in_cart($_SESSION['cart']),2);  ?></span></div>
                                <!-- <div class="checkout__order__total">Total <span>$750.99</span></div> -->
                                <!-- <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> -->
                               
                                <!-- <button type="submit" class="btn btn-success btn-sm">COMPLETE ORDER</button> -->
                                <!-- <button type="submit" class="btn btn-danger btn-sm">EMPTY CART</button><hr> -->
                                <!-- <hr>  -->
                                <a href="empty_cart.php" class="btn btn-danger btn-sm">EMPTY CART</a>
                                <a href="index.php" class="btn btn-primary btn-sm">CONTINUE SHOPPING</a>
                            </div>
                        <?php }  else{?>
                            <div class="checkout__order">
                                <a href="index.php" class="btn btn-primary btn-sm">GO TO SHOP</a>
                            </div>
                        <?php } ?>


</div>