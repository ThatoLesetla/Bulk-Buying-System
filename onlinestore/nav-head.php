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

$categoryName = $_POST['']
?>


<div class="header" id="home1">
    <div class="container">
        <div class="w3l_login">
            <a href="#" data-toggle="modal" data-target="#myModal88"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
        </div>
        <div class="w3l_logo">
            <h1><a href="index.html">Bulk Buying Store<span>Your stores. Your place.</span></a></h1>
        </div>
        <div class="search">
            <input class="search_box" type="checkbox" id="search_box">
            <label class="icon-search" for="search_box"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></label>
            <div class="search_form">
                <form action="#" method="post">
                    <input type="text" name="Search" placeholder="Search...">
                    <input type="submit" value="Send">
                </form>
            </div>
        </div>
        <div class="cart cart box_1">
            <form action="#" method="post" class="last">
                <input type="hidden" name="cmd" value="_cart" />
                <input type="hidden" name="display" value="1" />
                <button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
            </form>
        </div>
    </div>
</div>
<!-- //header -->
<!-- navigation -->
<div class="navigation">
    <div class="container">
        <nav class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header nav_2">
                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                <ul class="nav navbar-nav">
                    <li><a href="index.php" class="act">Home</a></li>
                    <!-- Mega Menu -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-column columns-3">
                            <div class="row">
                                <div class="col-sm-3">
                                    <ul class="multi-column-dropdown">
                                        <h6>Vendors</h6>


                                        <?php
                                        $query = "SELECT * FROM vendor";
                                        $result = mysqli_query($db, $query);

                                        if ($result) {
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $vendorID = $row['vendorID'];
                                                    $vendorName = $row['name'];
                                                    $registerDate = $row['date'];

                                                    if ($registerDate == '2019-05-06') {
                                                        echo '<li><a href="products.php/' . $vendorID . '">Mp3 Players <span>New</span></a></li>';
                                                    } else {

                                                        //echo '<li onclick="viewProducts()"> <a> ' . $vendorName . '</a></li>';
                                                        //echo '<li><a  onclick="viewProducts()">' .  $vendorName . '</a></li>';
                                                        //echo(" <li><a onclick='viewProducts('".$vendorID.")'>$vendorName</a></li>");
                                                        ?>
                                                        <li><a onclick="viewProducts('<?php echo ($vendorID) ?>')"><?php echo ($vendorName) ?></a></li>

                                        <?php




                                                    }
                                                }
                                            }
                                        }
                                        ?>

                                    </ul>
                                </div>
                                <div class="col-sm-2">
                                    <ul class="multi-column-dropdown">
                                        <h6>Categories</h6>

                                        <?php
                                        $query = "SELECT * FROM category";
                                        $result = mysqli_query($db, $query);

                                        if ($result) {
                                            if (mysqli_num_rows($result) > 0) {
                                                $count = 0;
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $name = $row['categoryName'];
                                                    $categoryID = $row['categoryID'];

                                                    echo '<li><a href="#">' . $name . '</a></li>';
                                                }
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <div class="w3ls_products_pos">
                                        <h4>30%<i>Off/-</i></h4>
                                        <img src="images/1.jpg" alt=" " class="img-responsive" />
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </ul>
                    </li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="orders.html">View Orders</a></li>
                    <li><a href="mail.html">Contact Us</a></li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<script src="js/jquery.min.js"></script>
<script>
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
</script>