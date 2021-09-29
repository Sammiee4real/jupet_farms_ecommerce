<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Jupet Farm Fresh is your best choice for farm fresh products">
    <meta name="keywords" content="Jupet farm fresh Ibadan, Jupet farm fresh Nigeria, Jupet farm fresh, Jupet farm, Jupet, Farm, Fresh, Chicken, Turkey, Processing, Farm fresh chicken, Farm fresh turkey, Wholesale chicken, Poultry processing, Poultry farm Ibadan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jupet Farm Fresh - For Farm Fresh Products</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    

    <!-- <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-light@4/dark.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script> -->
     <script type='application/ld+json'>
        {
          "@context": "https://schema.org", 
          "@type": "FarmFresh",
          "headline": "Jupet Farm Fresh is your best choice for farm fresh products",
          "description": " Jupet Farm Fresh Limited, a farm focused on meat production. It is based in Ibadan Oyo state.The founder has noticed the health implication of consuming red meat and we are creating a business to meet the increased demand for white meat.",
          "image": "https://jupetfarmfresh.com/images/banner.jpeg",
          "url": "https://jupetfarmfresh.com",
          "datePublished": "2021-09-12",
          "dateCreated": "2021-09-12",
          "dateModified": "2021-09-12",
          "publisher": "Jupet Farm Fresh",
          "author": {
            "@type": "Person",
            "name": "Jupet Farm Fresh"
          }
        }
        </script>


    <style type="text/css">
        body{
            background-color: #fcfcff;
        }
    </style>


</head>



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
                <img src="img/logo.jpg" width="110" height="110" alt="">
            </a>
        </div>
        <div class="humberger__menu__cart">
                       <ul>
                             <?php //if(isset($_SESSION['uid'])){?>
                             <?php if(   isset($_SESSION['uid']) && isset($_SESSION['cart'])  && (count($_SESSION['cart']) > 0 )  ){?>
                            <li><a href="complete_order.php"><i class="fa fa-shopping-bag"></i> <span><?php echo count($_SESSION['cart']); ?></span></a></li>
                             <?php  } else if( !isset($_SESSION['uid']) && isset($_SESSION['cart'])  && (count($_SESSION['cart']) > 0 ) ){?>
                            <li><a href="shopping_cart.php"><i class="fa fa-shopping-bag"></i> <span><?php echo count($_SESSION['cart']); ?></span></a></li>
                             <?php } else{ ?>
                                 <li><a href="shopping_cart.php"><i class="fa fa-shopping-bag"></i> <span><?php echo'0'; ?></span></a></li>
                             <?php } ?>
                        </ul>

                        <?php if(  isset($_SESSION['cart'])  && (count($_SESSION['cart']) > 0 )  ){?>
                        <div class="header__cart__price">Total: <span>&#8358;<?php echo number_format(get_total_amount_in_cart($_SESSION['cart']),2);  ?></span>
                        </div>
                        <?php } else{ ?>
                        <div class="header__cart__price">Total: <span>&#8358;<?php echo 0.00;  ?></span>
                        </div>
                        <?php } ?>

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
                <?php if(isset($_SESSION['uid'])){?>
                    <a href="home.php"><i class="fa fa-user"></i>Dashboard</a>&nbsp; &nbsp;
                    <a href="logout.php"><i class="fa fa-user"></i>Logout</a>
                <?php } else{?>
                    <a href="login.php"><i class="fa fa-user"></i> Login</a>
                <?php }?>

            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
              <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="contact.php">Contact</a></li>
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
                            <!-- <div class="header__top__right__auth">
                                <a href="#"><i class="fa fa-user"></i> Login</a>
                            </div> -->

                            <?php if(isset($_SESSION['uid'])){?>
                                 <a href="home.php"><i class="fa fa-user"></i>Dashboard</a> &nbsp; &nbsp;
                                 <a href="logout.php"><i class="fa fa-user"></i>Logout</a>
                            <?php } else{?>
                                 <a href="login.php"><i class="fa fa-user"></i> Login</a>
                            <?php }?>


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
                         <img width="110" height="110" src="img/logo.jpg" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                       <ul>
                             <?php //if(isset($_SESSION['uid'])){?>
                             <?php if(   isset($_SESSION['uid']) && isset($_SESSION['cart'])  && (count($_SESSION['cart']) > 0 )  ){?>
                            <li><a href="complete_order.php"><i class="fa fa-shopping-bag"></i> <span><?php echo count($_SESSION['cart']); ?></span></a></li>
                             <?php  } else if( !isset($_SESSION['uid']) && isset($_SESSION['cart'])  && (count($_SESSION['cart']) > 0 ) ){?>
                            <li><a href="shopping_cart.php"><i class="fa fa-shopping-bag"></i> <span><?php echo count($_SESSION['cart']); ?></span></a></li>
                             <?php } else{ ?>
                                 <li><a href="shopping_cart.php"><i class="fa fa-shopping-bag"></i> <span><?php echo'0'; ?></span></a></li>
                             <?php } ?>
                        </ul>

                        <?php if(  isset($_SESSION['cart'])  && (count($_SESSION['cart']) > 0 )  ){?>
                        <div class="header__cart__price">Total: <span>&#8358;<?php echo number_format(get_total_amount_in_cart($_SESSION['cart']),2);  ?></span>
                        </div>
                        <?php } else{ ?>
                        <div class="header__cart__price">Total: <span>&#8358;<?php echo 0.00;  ?></span>
                        </div>
                        <?php } ?>


                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>