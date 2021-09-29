<?php session_start();
include('config/database_functions.php'); 
include('include/header.php'); 
?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
                <h2>About Us</h2>
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


    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="images/banner.jpeg" alt="">
                        </div>
                        <!-- <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="img/product/details/product-details-2.jpg"
                                src="img/product/details/thumb-1.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-3.jpg"
                                src="img/product/details/thumb-2.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-5.jpg"
                                src="img/product/details/thumb-3.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-4.jpg"
                                src="img/product/details/thumb-4.jpg" alt="">
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                    <h3>Welcome</h3>
                    <p style="line-height: 1.7;">We are pleased to introduce to you Jupet Farm Fresh Limited, a farm focused on meat production. It is based in Ibadan Oyo state.<br>
                    The founder has noticed the health implication of consuming red meat and we are creating a business to meet the increased demand for white meat.<br>
                    We are a focused and dynamic production of fresh chickens and turkeys, with emphasis on customer satisfaction, through effective and efficient service delivery.<br>
                    We offer the best products and services delivered by highly motivated, professionally qualified workforce.
                    RC No. 1824369.</p>
                    </div>
                    <!-- <hr> -->
                    
                    <div class="row" >
                    
                    <div class="col-lg-12" style="margin-top: -70px;padding-top: 40px;">
                          
                   
            <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-objective-tab" data-bs-toggle="tab" data-bs-target="#nav-objective" type="button" role="tab" aria-controls="nav-objective" aria-selected="true">Objective</button>
            <button class="nav-link" id="nav-vision-tab" data-bs-toggle="tab" data-bs-target="#nav-vision" type="button" role="tab" aria-controls="nav-vision" aria-selected="false">Vision</button>
            <button class="nav-link" id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission" type="button" role="tab" aria-controls="nav-mission" aria-selected="false">Mission Statement</button>
            <button class="nav-link" id="nav-products-tab" data-bs-toggle="tab" data-bs-target="#nav-products" type="button" role="tab" aria-controls="nav-products" aria-selected="false">About our Products</button>
            </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
            
            <div class="tab-pane fade show active" id="nav-objective" role="tabpanel" aria-labelledby="nav-objective-tab">
            <br>     
            <div class="product__details__tab__desc">
            <!-- <h6>Products Infomation</h6> -->
            <p>Becoming the best & most hygienic fresh farm produces producer in the area and beyond, as well as complying with the national standards by NAFDAC.</p>
            </div>
            </div>

             <div class="tab-pane fade" id="nav-vision" role="tabpanel" aria-labelledby="nav-vision-tab">
            <br>     
            <div class="product__details__tab__desc">
            <!-- <h6>Products Infomation</h6> -->
            <p>We hope to be the best supplier of farm fresh chicken and turkey.</p>
            </div>
            </div>

            <div class="tab-pane fade" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
            <br>     
            <div class="product__details__tab__desc">
            <!-- <h6>Products Infomation</h6> -->
            <p>To provide consumers with the best quality, fresh and healthy products.</p>
            </div>
            </div>


            <div class="tab-pane fade" id="nav-products" role="tabpanel" aria-labelledby="nav-products-tab">
            <br>     
            <div class="product__details__tab__desc">
            <!-- <h6>Products Infomation</h6> -->
            <p>We are a standard farm that is committed to raising and processing farm fresh chicken and turkey for human consumption.<br>
                      They include: Farm fresh Chicken, Farm fresh Turkey etc
            </p>
            </div>
            </div>


            
            </div>

            </div>


                    


            </div>
             



                </div>





            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

 
 <?php include('include/footer.php'); ?>