<?php
session_start();

include '../connect.php';
$errors = array();

if (empty($_SESSION['phone'])) {
    unset($_SESSION['phone']);
    session_abort();
    header('location: login.php');
} else {
    $cell = $_SESSION['phone'];
    $name = ' ';

    $id = '';
    $email = '';

    $query = "SELECT * FROM `customer` WHERE `phone` = '$cell'";
    $result = mysqli_query($db, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $name = $row['name'];
                $img = $row['img'];
                $id = $row['customerID'];
                $email = $row['email'];
            }
        }
    }
}

include '../errors.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bulk Store</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Electronic Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	SmartPhone Compatible web template, free web designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //for-mobile-apps -->
    <!-- Custom Theme files -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/fasthover.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
    <!-- //Custom Theme files -->
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/jquery.countdown.css" /> <!-- countdown -->
    <!-- //js -->
    <!-- web fonts -->
    <link href='//fonts.googleapis.com/css?family=Glegoo:400,700' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <!-- //web fonts -->
    <!-- start-smooth-scrolling -->
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <!-- //end-smooth-scrolling -->
</head>

<body>
    <!-- for bootstrap working -->
    <script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
    <!-- //for bootstrap working -->
    <!-- header modal -->
    <?php include '_header.php' ?>
    <!-- //banner -->


    <!-- banner-bottom1 -->
    <div class="banner-bottom1">
        <div class="agileinfo_banner_bottom1_grids">
            <div class="col-md-7 agileinfo_banner_bottom1_grid_left">
                <h3>Grand Opening Event With flat<span>20% <i>Discount in Tech</i></span></h3>
                <a href="products.php?categoryCode=5">Shop Now</a>
            </div>
            <div class="col-md-5 agileinfo_banner_bottom1_grid_right">
                <h4>hot deal</h4>
                <div class="timer_wrap">
                    <div id="counter"> </div>
                </div>
                <script src="js/jquery.countdown.js"></script>
                <script src="js/script.js"></script>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <!-- //banner-bottom1 -->
    <!-- special-deals -->
    <div class="special-deals">
        <div class="container">
            <h2>Special Deals</h2>
            <div class="w3agile_special_deals_grids">
                <div class="col-md-7 w3agile_special_deals_grid_left">
                    <div class="w3agile_special_deals_grid_left_grid">
                        <img src="images/21.jpg" alt=" " class="img-responsive" />
                        <div class="w3agile_special_deals_grid_left_grid_pos1">
                            <h5>30%<span>Off/-</span></h5>
                        </div>
                        <div class="w3agile_special_deals_grid_left_grid_pos">
                            <h4>We Offer <span>Best Products</span></h4>
                        </div>
                    </div>
                    <div class="wmuSlider example1">
                        <div class="wmuSliderWrapper">
                            <article style="position: absolute; width: 100%; opacity: 0;">
                                <div class="banner-wrap">
                                    <div class="w3agile_special_deals_grid_left_grid1">
                                        <img src="images/t1.png" alt=" " class="img-responsive" />
                                        <p>Thank you for everything, it is always a pleasure to hear from you and I have to say, having been a truly captive audience browsing so many consignment shops online I can see unequivocally that your business is by far the most well organized, well curated, well stocked, descriptive and fairly priced that I’ve ever seen.</p>
                                        <h4>Laura</h4>
                                    </div>
                                </div>
                            </article>
                            <article style="position: absolute; width: 100%; opacity: 0;">
                                <div class="banner-wrap">
                                    <div class="w3agile_special_deals_grid_left_grid1">
                                        <img src="images/t2.png" alt=" " class="img-responsive" />
                                        <p>The site is incredibly user friendly, incredibly straightforward, and a real pleasure to browse. It’s honestly my favorite site. It means so much to have such a well-tended site with such a knowledgeable owner such as yourself.</h4>
                                    </div>
                                </div>
                            </article>
                            <article style="position: absolute; width: 100%; opacity: 0;">
                                <div class="banner-wrap">
                                    <div class="w3agile_special_deals_grid_left_grid1">
                                        <img src="images/t3.png" alt=" " class="img-responsive" />
                                        <p>10 years in business is no small feat and I want to thank you for everything. I can shop confidently and it’s rare that there aren’t 3-4 bags I’m coveting from your site at any given time."
                                            Lani, Montreal, QC.</p>
                                        <h4>Rosy</h4>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    <script src="js/jquery.wmuSlider.js"></script>
                    <script>
                        $('.example1').wmuSlider();
                    </script>
                </div>
                <div class="col-md-5 w3agile_special_deals_grid_right">
                    <img src="images/20.jpg" alt=" " class="img-responsive" />
                    <div class="w3agile_special_deals_grid_right_pos">
                        <h4>Festive <span>Special</span></h4>
                        <h5>save up <span>to</span> 30%</h5>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //special-deals -->
    <!-- new-products -->
    <div class="new-products">
        <div class="container">
            <h3>Latest Products</h3>
            <div class="agileinfo_new_products_grids">

                <?php
                $query = "SELECT * FROM product";
                $result = mysqli_query($db, $query);

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        $count = 0;
                        while ($row = mysqli_fetch_array($result)) {
                            $productID = $row['productID'];
                            $productName = $row['productName'];
                            $productPrice = $row['productPrice'];
                            $promimg = $row['proimg'];
                            ?>
                            <div class="col-md-3 agileinfo_new_products_grid">
                                <div class="agile_ecommerce_tab_left agileinfo_new_products_grid1">
                                    <div class="hs-wrapper hs-wrapper1">
                                        <img src="<?php echo '../products/' . $promimg; ?>" alt=" " class="img-responsive" />
                                        <div class="w3_hs_bottom w3_hs_bottom_sub">
                                            <ul>
                                                <li>
                                                    <a href="#" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h5><a href="single.php?productID=<?php echo $productID ?>"><?php echo $productName ?></a></h5>
                                    <div class="simpleCart_shelfItem">
                                        <p><i class="item_price">R<?php echo $productPrice ?></i></p>
                                        <form action="#" method="post">
                                            <input type="hidden" name="cmd" value="_cart">
                                            <input type="hidden" name="add" value="1">
                                            <input type="hidden" name="w3ls_item" value="<?php echo $productName ?>">
                                            <input type="hidden" name="amount" value="<?php echo $productPrice ?>">
                                            <input type="hidden" name="productID" value="<?php echo $productID ?>">
                                            <button type="submit" class="w3ls-cart" style="margin-bottom: 25px;">Add to cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                <?php

                            $count++;
                        }
                    }
                }
                ?>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //new-products -->
    <!-- top-brands -->
    <div class="top-brands">
        <div class="container">
            <h3>Top Brands</h3>
            <div class="sliderfig">
                <ul id="flexiselDemo1">
                    <li>
                        <img src="images/tb1.jpg" alt=" " class="img-responsive" />
                    </li>
                    <li>
                        <img src="images/tb2.jpg" alt=" " class="img-responsive" />
                    </li>
                    <li>
                        <img src="images/tb3.jpg" alt=" " class="img-responsive" />
                    </li>
                    <li>
                        <img src="images/tb4.jpg" alt=" " class="img-responsive" />
                    </li>
                    <li>
                        <img src="images/tb5.jpg" alt=" " class="img-responsive" />
                    </li>
                </ul>
            </div>
            <script type="text/javascript">
                $(window).load(function() {
                    $("#flexiselDemo1").flexisel({
                        visibleItems: 4,
                        animationSpeed: 1000,
                        autoPlay: true,
                        autoPlaySpeed: 3000,
                        pauseOnHover: true,
                        enableResponsiveBreakpoints: true,
                        responsiveBreakpoints: {
                            portrait: {
                                changePoint: 480,
                                visibleItems: 1
                            },
                            landscape: {
                                changePoint: 640,
                                visibleItems: 2
                            },
                            tablet: {
                                changePoint: 768,
                                visibleItems: 3
                            }
                        }
                    });

                });
            </script>
            <script type="text/javascript" src="js/jquery.flexisel.js"></script>
        </div>
    </div>
    <!-- //top-brands -->
    <!-- newsletter -->
    <div class="newsletter">
        <div class="container">
            <div class="col-md-6 w3agile_newsletter_left">
                <h3>Newsletter</h3>
                <p>Subscribe to our newsletter and get the best deals.</p>
            </div>
            <div class="col-md-6 w3agile_newsletter_right">
                <form action="#" method="post">
                    <input type="email" name="Email" placeholder="Email" required="">
                    <input type="submit" value="" />
                </form>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <!-- //newsletter -->
    <!-- footer -->
    <?php include('_footer.php'); ?>
    <!-- //footer -->
    <!-- cart-js -->
    <script src="js/minicart.js"></script>
    <script>
        w3ls.render();

        w3ls.cart.on('w3sb_checkout', function(evt) {
            var items, len, i;

            if (this.subtotal() > 0) {
                items = this.items();

                for (i = 0, len = items.length; i < len; i++) {}
            }
        });
    </script>
    <!-- //cart-js -->

    <script>
        $(document).ready(function() {
            //$('.fixed-action-btn').floatingActionButton();

            $('#btn_login').click(function(e) {
                e.preventDefault();
                alert('llll');
                var cell = $('#Cell').val();
                var passW = $('#Password').val();
                //var signAs = $('#signAs').val();
                var signAs = 1;
                $.ajax({
                    type: "post",
                    url: "../loginCpu.php",
                    data: {
                        cell: cell,
                        passW: passW,
                        signAs: signAs

                    },
                    success: function(response) {
                        $('#after').html(response);
                    }
                });

            });

        });
    </script>
</body>

</html>