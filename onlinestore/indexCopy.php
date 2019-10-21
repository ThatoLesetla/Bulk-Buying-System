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
    <title>BulkBuying Store</title>
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
    <link rel="stylesheet" href="css/jquery.countdown.css" />
    <!-- countdown -->
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
    <div class="modal fade" id="myModal88" tabindex="-1" role="dialog" aria-labelledby="myModal88" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;</button>
                    <h4 class="modal-title" id="myModalLabel">Don't Wait, Login now!</h4>
                </div>
                <div class="modal-body modal-body-sub">
                    <div class="row">
                        <div class="col-md-8 modal_body_left modal_body_left1" style="border-right: 1px dotted #C2C2C2;padding-right:3em;">
                            <div class="sap_tabs">
                                <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                                    <ul>
                                        <li class="resp-tab-item" aria-controls="tab_item-0"><span>Sign in</span></li>
                                        <li class="resp-tab-item" aria-controls="tab_item-1"><span>Sign up</span></li>
                                    </ul>
                                    <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
                                        <div class="facts">
                                            <div class="register">
                                                <form action="#" method="post" id="loginForm">
                                                    <input class="form-controll" value="00000" name="Cell" id="Cell" placeholder="Type Cell Number" type="number" required="">
                                                    <input name="Password" id="Password" placeholder="Password" type="password" required="">
                                                    <div class="sign-up">
                                                        <input type="submit" id="btn_login" value=" Sign in" />
                                                    </div>

                                                </form>
                                                <DIV id="after"></DIV>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
                                        <div class="facts">
                                            <div class="register">
                                                <form action="#" method="post">
                                                    <input placeholder="Name" name="Name" type="text" required="">
                                                    <input placeholder="Email Address" name="Email" type="email" required="">
                                                    <input placeholder="Password" name="Password" type="password" required="">
                                                    <input placeholder="Confirm Password" name="Password" type="password" required="">
                                                    <div class="sign-up">
                                                        <input type="submit" value="Create Account" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $('#horizontalTab').easyResponsiveTabs({
                                        type: 'default', //Types: default, vertical, accordion           
                                        width: 'auto', //auto or any width like 600px
                                        fit: true // 100% fit in a container
                                    });
                                });
                            </script>
                            <div id="OR" class="hidden-xs">OR</div>
                        </div>
                        <div class="col-md-4 modal_body_right modal_body_right1">
                            <div class="row text-center sign-with">
                                <div class="col-md-12">
                                    <h3 class="other-nw">Sign in with</h3>
                                </div>
                                <div class="col-md-12">
                                    <ul class="social">
                                        <li class="social_facebook">
                                            <a href="#" class="entypo-facebook"></a>
                                        </li>
                                        <li class="social_dribbble">
                                            <a href="#" class="entypo-dribbble"></a>
                                        </li>
                                        <li class="social_twitter">
                                            <a href="#" class="entypo-twitter"></a>
                                        </li>
                                        <li class="social_behance">
                                            <a href="#" class="entypo-behance"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#myModal88').modal('show');
    </script>
    <!-- header modal -->
    <!-- header -->
    <div id="nav-head">



    </div>
    <!-- //navigation -->
    <!-- banner -->
    <div class="banner">
        <div class="container">
            <h3>Bulk Buying Store, <span>Special Offers</span></h3>
        </div>
    </div>
    <!-- //banner -->
    <!-- banner-bottom -->
    <div class="banner-bottom">
        <div class="container">
            <div class="col-md-5 wthree_banner_bottom_left">
                <div class="video-img">
                    <a class="play-icon popup-with-zoom-anim" href="#small-dialog">
                        <span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- pop-up-box -->
                <script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
                <!--//pop-up-box -->
                <div id="small-dialog" class="mfp-hide">
                    <iframe src="https://www.youtube.com/embed/ZQa6GUVnbNM"></iframe>
                </div>
                <script>
                    $(document).ready(function() {
                        $('.popup-with-zoom-anim').magnificPopup({
                            type: 'inline',
                            fixedContentPos: false,
                            fixedBgPos: true,
                            overflowY: 'auto',
                            closeBtnInside: true,
                            preloader: false,
                            midClick: true,
                            removalDelay: 300,
                            mainClass: 'my-mfp-zoom-in'
                        });

                    });
                </script>
            </div>
            <div class="col-md-7 wthree_banner_bottom_right">
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs" role="tablist">
                        <?php
                        $query = "SELECT categoryName FROM category";
                        $result = mysqli_query($db, $query);

                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                $count = 0;
                                while ($row = mysqli_fetch_array($result)) {
                                    $name = $row['categoryName'];

                                    if ($count == 0) {
                                        echo '<li role="presentation" class="active"><a href="#tv" role="tab" id="' . $name . '" data-toggle="tab" aria-controls="tv">' . $name . '</a></li>';
                                    } else {
                                        echo '<li role="presentation"><a href="#tv" role="tab" id="' . $name . '" data-toggle="tab" aria-controls="tv">' . $name . '</a></li>';
                                    }


                                    $count++;
                                }
                            }
                        }
                        ?>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <?php
                        $query = "SELECT categoryName FROM category";
                        $result = mysqli_query($db, $query);

                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                $count = 0;
                                while ($row = mysqli_fetch_array($result)) {
                                    $categoryTab = $row['categoryName'];

                                    ?>
                                    <!--
                                    <div role="tabpanel" class="tab-pane fade active in" id="<?php echo $name ?>" aria-labelledby="<?php echo $name ?>">
                                        <div class="agile_ecommerce_tabs">
                                            <div class="col-md-4 agile_ecommerce_tab_left">
                                                <div class="hs-wrapper">
                                                    <img src="images/3.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/4.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/5.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/6.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/7.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/3.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/4.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/5.jpg" alt=" " class="img-responsive" />
                                                    <div class="w3_hs_bottom">
                                                        <ul>
                                                            <li>
                                                                <a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h5><a href="single.html">Mobile Phone1</a></h5>
                                                <div class="simpleCart_shelfItem">
                                                    <p><span>$380</span> <i class="item_price">$350</i></p>
                                                    <form action="#" method="post">
                                                        <input type="hidden" name="cmd" value="_cart" />
                                                        <input type="hidden" name="add" value="1" />
                                                        <input type="hidden" name="w3ls_item" value="Mobile Phone1" />
                                                        <input type="hidden" name="amount" value="350.00" />
                                                        <button type="submit" class="w3ls-cart">Add to cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-4 agile_ecommerce_tab_left">
                                                <div class="hs-wrapper">
                                                    <img src="images/4.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/5.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/6.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/7.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/3.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/4.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/5.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/6.jpg" alt=" " class="img-responsive" />
                                                    <div class="w3_hs_bottom">
                                                        <ul>
                                                            <li>
                                                                <a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h5><a href="single.html"><?php echo $categoryTab ?></a></h5>
                                                <div class="simpleCart_shelfItem">
                                                    <p><span>$330</span> <i class="item_price">$302</i></p>
                                                    <form action="#" method="post">
                                                        <input type="hidden" name="cmd" value="_cart" />
                                                        <input type="hidden" name="add" value="1" />
                                                        <input type="hidden" name="w3ls_item" value="Mobile Phone2" />
                                                        <input type="hidden" name="amount" value="302.00" />
                                                        <button type="submit" class="w3ls-cart">Add to cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-4 agile_ecommerce_tab_left">
                                                <div class="hs-wrapper">
                                                    <img src="images/7.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/6.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/4.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/3.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/5.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/7.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/4.jpg" alt=" " class="img-responsive" />
                                                    <img src="images/6.jpg" alt=" " class="img-responsive" />
                                                    <div class="w3_hs_bottom">
                                                        <ul>
                                                            <li>
                                                                <a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h5><a href="single.html">Mobile Phone3</a></h5>
                                                <div class="simpleCart_shelfItem">
                                                    <p><span>$250</span> <i class="item_price">$245</i></p>
                                                    <form action="#" method="post">
                                                        <input type="hidden" name="cmd" value="_cart" />
                                                        <input type="hidden" name="add" value="1" />
                                                        <input type="hidden" name="w3ls_item" value="Mobile Phone3" />
                                                        <input type="hidden" name="amount" value="245.00" />
                                                        <button type="submit" class="w3ls-cart">Add to cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="clearfix"> </div>
                                        </div>
                                    </div>
                                    -->
                        <?php


                                    $count++;
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <!-- //banner-bottom -->
    <!-- modal-video -->
    <div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <section>
                    <div class="modal-body">
                        <div class="col-md-5 modal_body_left">
                            <img src="images/3.jpg" alt=" " class="img-responsive" />
                        </div>
                        <div class="col-md-7 modal_body_right">
                            <h4>The Best Mobile Phone 3GB</h4>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
                            <div class="rating">
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="modal_body_right_cart simpleCart_shelfItem">
                                <p><span>$380</span> <i class="item_price">$350</i></p>
                                <form action="#" method="post">
                                    <input type="hidden" name="cmd" value="_cart">
                                    <input type="hidden" name="add" value="1">
                                    <input type="hidden" name="w3ls_item" value="Mobile Phone1">
                                    <input type="hidden" name="amount" value="350.00">
                                    <button type="submit" class="w3ls-cart">Add to cart</button>
                                </form>
                            </div>
                            <h5>Color</h5>
                            <div class="color-quality">
                                <ul>
                                    <li><a href="#"><span></span></a></li>
                                    <li><a href="#" class="brown"><span></span></a></li>
                                    <li><a href="#" class="purple"><span></span></a></li>
                                    <li><a href="#" class="gray"><span></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="modal video-modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModal1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <section>
                    <div class="modal-body">
                        <div class="col-md-5 modal_body_left">
                            <img src="images/9.jpg" alt=" " class="img-responsive" />
                        </div>
                        <div class="col-md-7 modal_body_right">
                            <h4>Multimedia Home Accessories</h4>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
                                sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <div class="rating">
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="modal_body_right_cart simpleCart_shelfItem">
                                <p><span>$180</span> <i class="item_price">$150</i></p>
                                <form action="#" method="post">
                                    <input type="hidden" name="cmd" value="_cart">
                                    <input type="hidden" name="add" value="1">
                                    <input type="hidden" name="w3ls_item" value="Headphones">
                                    <input type="hidden" name="amount" value="150.00">
                                    <button type="submit" class="w3ls-cart">Add to cart</button>
                                </form>
                            </div>
                            <h5>Color</h5>
                            <div class="color-quality">
                                <ul>
                                    <li><a href="#"><span></span></a></li>
                                    <li><a href="#" class="brown"><span></span></a></li>
                                    <li><a href="#" class="purple"><span></span></a></li>
                                    <li><a href="#" class="gray"><span></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="modal video-modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModal2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <section>
                    <div class="modal-body">
                        <div class="col-md-5 modal_body_left">
                            <img src="images/11.jpg" alt=" " class="img-responsive" />
                        </div>
                        <div class="col-md-7 modal_body_right">
                            <h4>Quad Core Colorful Laptop</h4>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
                                sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
                            <div class="rating">
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="modal_body_right_cart simpleCart_shelfItem">
                                <p><span>$880</span> <i class="item_price">$850</i></p>
                                <form action="#" method="post">
                                    <input type="hidden" name="cmd" value="_cart">
                                    <input type="hidden" name="add" value="1">
                                    <input type="hidden" name="w3ls_item" value="Laptop">
                                    <input type="hidden" name="amount" value="850.00">
                                    <button type="submit" class="w3ls-cart">Add to cart</button>
                                </form>
                            </div>
                            <h5>Color</h5>
                            <div class="color-quality">
                                <ul>
                                    <li><a href="#"><span></span></a></li>
                                    <li><a href="#" class="brown"><span></span></a></li>
                                    <li><a href="#" class="purple"><span></span></a></li>
                                    <li><a href="#" class="gray"><span></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="modal video-modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModal3">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <section>
                    <div class="modal-body">
                        <div class="col-md-5 modal_body_left">
                            <img src="images/14.jpg" alt=" " class="img-responsive" />
                        </div>
                        <div class="col-md-7 modal_body_right">
                            <h4>Cool Single Door Refrigerator </h4>
                            <p>Duis aute irure dolor inreprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <div class="rating">
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="modal_body_right_cart simpleCart_shelfItem">
                                <p><span>$950</span> <i class="item_price">$820</i></p>
                                <form action="#" method="post">
                                    <input type="hidden" name="cmd" value="_cart">
                                    <input type="hidden" name="add" value="1">
                                    <input type="hidden" name="w3ls_item" value="Mobile Phone1">
                                    <input type="hidden" name="amount" value="820.00">
                                    <button type="submit" class="w3ls-cart">Add to cart</button>
                                </form>
                            </div>
                            <h5>Color</h5>
                            <div class="color-quality">
                                <ul>
                                    <li><a href="#"><span></span></a></li>
                                    <li><a href="#" class="brown"><span></span></a></li>
                                    <li><a href="#" class="purple"><span></span></a></li>
                                    <li><a href="#" class="gray"><span></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="modal video-modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModal4">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <section>
                    <div class="modal-body">
                        <div class="col-md-5 modal_body_left">
                            <img src="images/17.jpg" alt=" " class="img-responsive" />
                        </div>
                        <div class="col-md-7 modal_body_right">
                            <h4>New Model Mixer Grinder</h4>
                            <p>Excepteur sint occaecat laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur cupidatat non proident, sunt in culpa qui officia
                                deserunt mollit anim id est laborum.</p>
                            <div class="rating">
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="modal_body_right_cart simpleCart_shelfItem">
                                <p><span>$460</span> <i class="item_price">$450</i></p>
                                <form action="#" method="post">
                                    <input type="hidden" name="cmd" value="_cart">
                                    <input type="hidden" name="add" value="1">
                                    <input type="hidden" name="w3ls_item" value="Mobile Phone1">
                                    <input type="hidden" name="amount" value="450.00">
                                    <button type="submit" class="w3ls-cart">Add to cart</button>
                                </form>
                            </div>
                            <h5>Color</h5>
                            <div class="color-quality">
                                <ul>
                                    <li><a href="#"><span></span></a></li>
                                    <li><a href="#" class="brown"><span></span></a></li>
                                    <li><a href="#" class="purple"><span></span></a></li>
                                    <li><a href="#" class="gray"><span></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="modal video-modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModal5">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <section>
                    <div class="modal-body">
                        <div class="col-md-5 modal_body_left">
                            <img src="images/36.jpg" alt=" " class="img-responsive" />
                        </div>
                        <div class="col-md-7 modal_body_right">
                            <h4>Dry Vacuum Cleaner</h4>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
                                sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <div class="rating">
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="modal_body_right_cart simpleCart_shelfItem">
                                <p><span>$960</span> <i class="item_price">$920</i></p>
                                <form action="#" method="post">
                                    <input type="hidden" name="cmd" value="_cart">
                                    <input type="hidden" name="add" value="1">
                                    <input type="hidden" name="w3ls_item" value="Vacuum Cleaner">
                                    <input type="hidden" name="amount" value="920.00">
                                    <button type="submit" class="w3ls-cart">Add to cart</button>
                                </form>
                            </div>
                            <h5>Color</h5>
                            <div class="color-quality">
                                <ul>
                                    <li><a href="#"><span></span></a></li>
                                    <li><a href="#" class="brown"><span></span></a></li>
                                    <li><a href="#" class="purple"><span></span></a></li>
                                    <li><a href="#" class="gray"><span></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="modal video-modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModal6">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <section>
                    <div class="modal-body">
                        <div class="col-md-5 modal_body_left">
                            <img src="images/37.jpg" alt=" " class="img-responsive" />
                        </div>
                        <div class="col-md-7 modal_body_right">
                            <h4>Kitchen & Dining Accessories</h4>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
                                sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <div class="rating">
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star-.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="rating-left">
                                    <img src="images/star.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="modal_body_right_cart simpleCart_shelfItem">
                                <p><span>$280</span> <i class="item_price">$250</i></p>
                                <form action="#" method="post">
                                    <input type="hidden" name="cmd" value="_cart">
                                    <input type="hidden" name="add" value="1">
                                    <input type="hidden" name="w3ls_item" value="Induction Stove">
                                    <input type="hidden" name="amount" value="250.00">
                                    <button type="submit" class="w3ls-cart">Add to cart</button>
                                </form>
                            </div>
                            <h5>Color</h5>
                            <div class="color-quality">
                                <ul>
                                    <li><a href="#"><span></span></a></li>
                                    <li><a href="#" class="brown"><span></span></a></li>
                                    <li><a href="#" class="purple"><span></span></a></li>
                                    <li><a href="#" class="gray"><span></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- //modal-video -->
    <!-- banner-bottom1 -->
    <div class="banner-bottom1">
        <div class="agileinfo_banner_bottom1_grids">
            <div class="col-md-7 agileinfo_banner_bottom1_grid_left">
                <h3>Grand Opening Event With flat<span>20% <i>Discount</i></span></h3>
                <a href="products.html">Shop Now</a>
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
                            <h4>We Offer <span>Quality Products</span></h4>
                        </div>
                    </div>
                    <div class="wmuSlider example1">
                        <div class="wmuSliderWrapper">
                            <article style="position: absolute; width: 100%; opacity: 0;">
                                <div class="banner-wrap">
                                    <div class="w3agile_special_deals_grid_left_grid1">
                                        <img src="images/t1.png" alt=" " class="img-responsive" />
                                        <p>Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur</p>
                                        <h4>Laura</h4>
                                    </div>
                                </div>
                            </article>
                            <article style="position: absolute; width: 100%; opacity: 0;">
                                <div class="banner-wrap">
                                    <div class="w3agile_special_deals_grid_left_grid1">
                                        <img src="images/t2.png" alt=" " class="img-responsive" />
                                        <p>Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur</p>
                                        <h4>Michael</h4>
                                    </div>
                                </div>
                            </article>
                            <article style="position: absolute; width: 100%; opacity: 0;">
                                <div class="banner-wrap">
                                    <div class="w3agile_special_deals_grid_left_grid1">
                                        <img src="images/t3.png" alt=" " class="img-responsive" />
                                        <p>Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur</p>
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
                        <h4>Tech <span>Special</span></h4>
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
            <h3>New Products</h3>
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

                            ?>
                            <div class="col-md-3 agileinfo_new_products_grid">
                                <div class="agile_ecommerce_tab_left agileinfo_new_products_grid1">
                                    <div class="hs-wrapper hs-wrapper1">
                                        <img src="images/25.jpg" alt=" " class="img-responsive" />
                                        <img src="images/23.jpg" alt=" " class="img-responsive" />
                                        <img src="images/24.jpg" alt=" " class="img-responsive" />
                                        <img src="images/22.jpg" alt=" " class="img-responsive" />
                                        <img src="images/26.jpg" alt=" " class="img-responsive" />
                                        <div class="w3_hs_bottom w3_hs_bottom_sub">
                                            <ul>
                                                <li>
                                                    <a href="#" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h5><a href="single.html"><?php echo $productName ?></a></h5>
                                    <div class="simpleCart_shelfItem">
                                        <p><i class="item_price">R<?php echo $productPrice ?></i></p>
                                        <form action="#" method="post">
                                            <input type="hidden" name="cmd" value="_cart">
                                            <input type="hidden" name="add" value="1">
                                            <input type="hidden" name="w3ls_item" value="<?php echo $productName ?>">
                                            <input type="hidden" name="amount" value="<?php echo $productPrice ?>">
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
                <p>Excepteur sint occaecat cupidatat non proident, sunt.</p>
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
    <div class="footer">
        <div class="container">
            <div class="w3_footer_grids">
                <div class="col-md-3 w3_footer_grid">
                    <h3>Contact</h3>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
                    <ul class="address">
                        <li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>1234k Avenue, 4th block, <span>New York City.</span></li>
                        <li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">info@example.com</a></li>
                        <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+1234 567 567</li>
                    </ul>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <h3>Information</h3>
                    <ul class="info">
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="mail.html">Contact Us</a></li>
                        <li><a href="codes.html">Short Codes</a></li>
                        <li><a href="faq.html">FAQ's</a></li>
                        <li><a href="products.html">Special Products</a></li>
                    </ul>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <h3>Category</h3>
                    <ul class="info">

                        <?php
                        $query = "SELECT categoryName FROM category";
                        $result = mysqli_query($db, $query);

                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                $count = 0;
                                while ($row = mysqli_fetch_array($result)) {
                                    $name = $row['categoryName'];

                                    echo '<li><a href="about.html">' . $name . '</a></li>';
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <h3>Profile</h3>
                    <ul class="info">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="products.html">Today's Deals</a></li>
                    </ul>
                    <h4>Follow Us</h4>
                    <div class="agileits_social_button">
                        <ul>
                            <li>
                                <a href="#" class="facebook"> </a>
                            </li>
                            <li>
                                <a href="#" class="twitter"> </a>
                            </li>
                            <li>
                                <a href="#" class="google"> </a>
                            </li>
                            <li>
                                <a href="#" class="pinterest"> </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="footer-copy">
            <div class="footer-copy1">
                <div class="footer-copy-pos">
                    <a href="#home1" class="scroll"><img src="images/arrow.png" alt=" " class="img-responsive" /></a>
                </div>
            </div>
            <div class="container">
                <p>&copy; 2017 Bulk Buying Store. All rights reserved | Design by <a href="#">Bulk Stores</a></p>
            </div>
        </div>
    </div>
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

    <script>
        function onstart() {

            $.ajax({
                type: "post",
                url: "nav-head.php",
                data: {},
                success: function(response) {
                    $('#nav-head').html(response);
                }
            });
        }

        onstart();

        function viewProducts(vendorID) {
            alert(vendorID);
            var vendorID = vendorID;
            $.ajax({
                type: "post",
                url: "products.php",
                data: {
                    vendorID: vendorID
                },
                success: function(response) {
                    $('#after').html(response);
                }
            });
        };


        $(document).ready(function() {


        });
    </script>

</body>

</html>