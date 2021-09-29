

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="index.php"><img src="img/logo.jpg" width="110" height="110" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: No 31, Ola Akande way, Vinestore Bus-stop, Opposite Nepa Office, <br> Ashi Bodija, Ibadan</li>
                            <li>Phones: +234 8151281541, 08101493108</li>
                            <li>Email: support@jupetfarmfresh.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="about.php">About Us</a></li>
                            <!-- <li><a href="#">Products</a></li> -->
                            <li><a href="contact.php">Contact Us</a></li>
                        </ul>
                        <!-- <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail"><br><br>
                            <!-- <button type="submit" class="site-btn">Subscribe</button> -->
                            <a href="#" style="margin-top:-30px;" class="btn btn-success btn-md">Subscribe</a>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                           <!--  <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <a href="https://jupetfarmfresh.com" target="_blank" style="color:black;">Jupet Farm Fresh</a>
  
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->




    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    <script type="text/javascript">
            // Create Member

          $(document).ready(function(){

                //submit_formv2('add_to_cart_form', 'cmd_add_to_cart', 'Buy', false, 'add_to_cart', 'Please wait...', "Product was successfully added to cart", 'index.php');


                $('.test').click(function(e){
                    e.preventDefault();
                    Swal.fire({
                    icon: 'success',
                    title: 'Great...',
                    text: 'You have done exceedingly well',
                  
                    });
                 });

                   $('.cmd_add_to_cart').click(function(e){
                        e.preventDefault();
                        var getid = $(this).attr('id');
                        // alert(getid);
                        $.ajax({
                            url:"ajax/add_to_cart.php",
                            method: "POST",
                            data:$('#add_to_cart_form'+getid).serialize(),
                            beforeSend: function(){
                                $(this).attr('disabled', true);
                                $(this).text('please wait...');
                            },
                            success:function(data){
                                if(data == 111){
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'Perfect!',
                                    text: 'Product was successfully added to cart',
                                    });
                                    setTimeout( function(){ 
                                        window.location.href = 'index.php'; 
                                    }, 3000);
                                }
                                else{
                                    // toastr.error(data, "Caution!");
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Caution...',
                                    text: ''+data+'',
                                    });
                                }
                                $(this).attr('disabled', false);
                                $(this).text('Buy');
                            }
                        });    
                 });
              

                    $('.remove_product_from_cart').click(function(e){
                        e.preventDefault();
                        var getid = $(this).attr('id');
                        alert(getid);
                        $.ajax({
                            url:"ajax/remove_product_from_cart_list.php",
                            method: "GET",
                            data:{getid:getid},
                            beforeSend: function(){
                                // $(this).attr('disabled', true);
                                $(this).text('please wait...');
                            },
                            success:function(data){
                                if(data == 111){
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'Perfect!',
                                    text: 'Product has been successfully removed from cart',
                                    });
                                    setTimeout( function(){ 
                                        window.location.href = 'shopping_cart.php'; 
                                    }, 3000);
                                }
                                else{
                                    // toastr.error(data, "Caution!");
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Caution...',
                                    text: ''+data+'',
                                    });
                                }
                            
                            }
                        });    
                 });

               $('.update_cart').click(function(e){
                        e.preventDefault();
                        var getid = $(this).attr('id');
                        var product_qty = $("#product_qty"+getid).val();
                         // alert(getid);
                         // alert(product_qty);
                        $.ajax({
                            url:"ajax/update_cart.php",
                            method: "GET",
                            data:{getid:getid,product_qty:product_qty},
                            beforeSend: function(){
                                // $(this).attr('disabled', true);
                                $(this).text('please wait...');
                            },
                            success:function(data){
                                if(data == 111){
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'Perfect!',
                                    text: 'Product cart was successfully updated',
                                    });
                                    setTimeout( function(){ 
                                        window.location.href = 'shopping_cart.php'; 
                                    }, 3000);
                                }
                                else{
                                    // toastr.error(data, "Caution!");
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Caution...',
                                    text: ''+data+'',
                                    });
                                }
                            
                            }
                        });    
                 });
              





                $('.signup_complete_order_btn').click(function(e){
                        e.preventDefault();
                        var order_no = $('#order_no').val();
                        // alert(order_no);
                        $.ajax({
                            url:"ajax/signup_complete_order.php",
                            method: "POST",
                            data:$('#signup_complete_order_form').serialize(),
                            beforeSend: function(){
                                $(this).attr('disabled', true);
                                $(this).text('PLEASE WAIT...');
                            },
                            success:function(data){
                                if(data == 111){
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'Successful Account Creation!',
                                    text: 'Account was successfully created...Please wait...',
                                    });
                                    setTimeout( function(){ 
                                        window.location.href = 'complete_order.php'; 
                                    }, 3000);
                                }
                                else{
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Caution...',
                                    text: ''+data+'',
                                    });
                                }

                                $(this).attr('disabled', false);
                                $(this).text('SIGN UP AND COMPLETE ORDER');
                            }
                        });    
                 });


                $('.login_btn').click(function(e){
                        e.preventDefault();
                        $.ajax({
                            url:"ajax/login.php",
                            method: "POST",
                            data:$('#login_form').serialize(),
                            beforeSend: function(){
                                $(this).attr('disabled', true);
                                $(this).text('PLEASE WAIT...');
                            },
                            success:function(data){
                                if(data == 111){
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'Successful Login',
                                    text: 'You logged in successfully. Please wait...',
                                    });
                                    setTimeout( function(){ 
                                        window.location.href = 'home.php'; 
                                    }, 3000);
                                }
                                else{
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Caution...',
                                    text: ''+data+'',
                                    });
                                }

                                $(this).attr('disabled', false);
                                $(this).text('LOGIN');
                            }
                        });    
                 });
              


          });  


        function submit_form(formName, btnName, btnOValue, btnInput=false, url, bMsg, sMsg, redirectTo)
        {
            $('#'+btnName).click(function (e) {
                e.preventDefault();
                $.ajax({
                    url:"ajax/"+url+".php",
                    method: "POST",
                    data:$('#'+formName).serialize(),
                    beforeSend: function(){
                        $('#'+btnName).attr('disabled', true);
                        if(btnInput == false) $('#'+btnName).html(bMsg);
                        if(btnInput == true) $('#'+btnName).val(bMsg);
                    },
                    success:function(data){
                        if(data == 200){
                            Swal.fire({
                            icon: 'success',
                            title: 'Caution...',
                            text: ''+sMsg+'',
                            });
                            setTimeout( function(){ 
                                window.location.href = redirectTo; 
                            }, 3000);
                        }
                        else{
                            // toastr.error(data, "Caution!");
                            Swal.fire({
                            icon: 'error',
                            title: 'Caution...',
                            text: ''+data+'',
                            });
                        }
                        $('#'+btnName).attr('disabled', false);
                        if(btnInput == false) $('#'+btnName).html(btnOValue);
                        if(btnInput == true) $('#'+btnName).val(btnOValue);
                    }
                });     
            });
        }

         function submit_formv2(formName, btnName, btnOValue, btnInput=false, url, bMsg, sMsg, redirectTo)
        {
            $('#'+btnName).click(function (e) {
                e.preventDefault();
                $.ajax({
                    url:"ajax/"+url+".php",
                    method: "POST",
                    data:$('.'+formName).serialize(),
                    beforeSend: function(){
                        $('#'+btnName).attr('disabled', true);
                        if(btnInput == false) $('#'+btnName).html(bMsg);
                        if(btnInput == true) $('#'+btnName).val(bMsg);
                    },
                    success:function(data){
                        if(data == 200){
                            Swal.fire({
                            icon: 'success',
                            title: 'Caution...',
                            text: ''+sMsg+'',
                            });
                            setTimeout( function(){ 
                                window.location.href = redirectTo; 
                            }, 3000);
                        }
                        else{
                            // toastr.error(data, "Caution!");
                            Swal.fire({
                            icon: 'error',
                            title: 'Caution...',
                            text: ''+data+'',
                            });
                        }
                        $('#'+btnName).attr('disabled', false);
                        if(btnInput == false) $('#'+btnName).html(btnOValue);
                        if(btnInput == true) $('#'+btnName).val(btnOValue);
                    }
                });     
            });
        }

            
    </script>


</body>

</html>