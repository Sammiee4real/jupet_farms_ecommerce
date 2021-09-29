<?php require_once('config/instantiated_files.php');
//include('include/header.php'); 
unset($_SESSION['cart']);             
header('location: home.php');
//echo json_encode($_SESSION['cart']);
?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Successful Order Creation</h2>
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
 <?php include('include/footer.php'); ?>