<?php session_start();
include('config/database_functions.php'); 
include('include/header.php'); 
//unset($_SESSION['uid']);
//unset($_SESSION['cart']);

//get all products
$products = get_rows_from_one_table_by_id('product_tbl','visibility_status',1,'date_added');

if(empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
 }

if(isset($_POST['cmd_add_to_cartod'])){
    
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
// remove_product_from_cart_list($_SESSION['cart']);
// echo json_encode($_SESSION['cart']);
//echo $_SESSION['uid'];
//unset($_SESSION['cart'][1]);
// array_values($_SESSION['cart']);
 //array_splice($_SESSION['cart'], 0, 0);
//print_r(array_keys($_SESSION['cart']));

?>

    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
              
                <div class="col-lg-12">
                   <!--  <div class="hero__search">
                       
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+44 7999 372481</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div> -->
                    <div class="hero__item set-bg" data-setbg="images/banner.jpeg">
                        <div class="hero__text">
                            <span>JUPET FARM FRESH</span>
                            <h2>Chicken, Turkey, <br>Goat Meat <br /> 100% Farm Fresh</h2>
                            <p>
                                Pickup and Delivery Available
                            </p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->


   <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Our Products</h2>
                    </div>
                   <!--  <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".oranges">Oranges</li>
                            <li data-filter=".fresh-meat">Fresh Meat</li>
                            <li data-filter=".vegetables">Vegetables</li>
                            <li data-filter=".fastfood">Fastfood</li>
                        </ul>
                    </div> -->
                </div>
            </div>
            <div class="row featured__filter">

                <?php foreach($products as $product){ ?>
                <div class="col-lg-4 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="<?php echo 'admin/'.$product['product_path']; ?>">
                            <!-- <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul> -->
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#"><?php echo $product['product_name']; ?></a></h6>
                            <h5>&#8358;<?php echo number_format($product['unit_price'],2);?></h5>
                             <form action="" method="post" id="add_to_cart_form<?php echo $product['unique_id'];?>">
                                <div style="margin-left: 100px ;">
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="product_id" id="product_id" value="<?php echo $product['unique_id'];?>">
                                        <input required="required" type="number" name="quantity" id="quantity" class="form-control col-6" placeholder="quantity in <?php echo $product['measure_type']?>" aria-label="enter quantity in <?php echo $product['measure_type']?>" aria-describedby="enter quantity">
                                        <div class="input-group-append">
                                        
                                        <?php if(check_if_product_is_in_cart($_SESSION['cart'],$product['unique_id'])){?>
                                        <a href="#" class="btn btn-danger disabled cmd_add_to_cartdd" type="button" >Added to Cart</a>&nbsp;<a href="shopping_cart.php" class="btn btn-success" type="button" >Check Cart</a>
                                        <?php }else{ ?>
                                        <input type="submit" id="<?php echo $product['unique_id'];?>" name="cmd_add_to_cart" class="btn btn-success cmd_add_to_cart" type="button" value="Buy">
                                        <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </section>
    <!-- Featured Section End -->


 <?php include('include/footer.php'); ?>