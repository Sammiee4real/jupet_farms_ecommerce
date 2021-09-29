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
                <h2>Contact Us</h2>
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


    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Phone</h4>
                        <p>+234 8151281541</p>
                        <p>+234 8101493108</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Address</h4>
                        <p> No 31, Ola Akande way, Vinestore Bus-stop, Opposite Nepa Office, <br> Ashi Bodija, Ibadan</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Open time</h4>
                        <p>8:00 am to 7:00 pm</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p>support@jupetfarmfresh.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.3426764564542!2d3.930038313765493!3d7.427277694641493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1039ed3c6aff5221%3A0xd556396ca8fcacea!2sVine%20Store!5e0!3m2!1sen!2sng!4v1631422572900!5m2!1sen!2sng"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.3426764564542!2d3.930038313765493!3d7.427277694641493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1039ed3c6aff5221%3A0xd556396ca8fcacea!2sVine%20Store!5e0!3m2!1sen!2sng!4v1631422572900!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->

            <div class="map-inside">
                <i class="icon_pin"></i>
                <div class="inside-widget">
                    <h4>Ibadan, Nigeria</h4>
                    <ul>
                        <li>Phone: +234 8101493108</li>
                        <li>Add: Ola Akande way, Vinestore Bus-stop, Ashi Ibadan</li>
                    </ul>
                </div>
            </div>
    </div>
    <!-- Map End -->

    <!-- Contact Form Begin -->
    <!-- <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Leave Message</h2>
                    </div>
                </div>
            </div>
            <form action="#">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Your name">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Your Email">
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea placeholder="Your message"></textarea>
                        <button type="submit" class="site-btn">SEND MESSAGE</button>
                    </div>
                </div>
            </form>
        </div>
    </div> -->
    <!-- Contact Form End -->


 <?php include('include/footer.php'); ?>