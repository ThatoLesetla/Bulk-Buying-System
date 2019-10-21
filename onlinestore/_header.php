<?php 

echo '<div class="header" id="home1">
        <div class="container">
            <div class="w3l_login">
                <a href="#" data-toggle="modal" data-target="#myModal88"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
            </div>
            <div class="w3l_logo">
                <h1><a href="index.php">Bulk Buying Store<span>Your stores. Your place.</span></a></h1>
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
                                            <h6>Vendors</h6>';

                                            
                                            $query = "SELECT name FROM vendor";
                                            $result = mysqli_query($db, $query);

                                            if ($result) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    $count = 0;
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $name = $row["name"];

                                                        echo '<li><a href="#">' . $name . '</a></li>';
                                                    }
                                                }
                                            }
                                            

                                        echo '</ul>
                                    </div>

                                    <div class="col-sm-2">
                                        <ul class="multi-column-dropdown">
                                            <h6>Categories</h6>';

                                           
                                            $query = "SELECT * FROM category";
                                            $result = mysqli_query($db, $query);

                                            if ($result) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    $count = 0;
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $categoryID = $row['categoryID'];
                                                        $categoryName = $row['categoryName'];

                                                        echo '<li><a href="products.php?categoryCode=' . $categoryID . '">' . $categoryName . '</a></li>';
                                                    }
                                                }
                                            }
                                            
                                        echo '</ul>
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
                        <li><a href="about.php">About Us</a></li>
                        <li class="w3pages"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Orders <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="orders.php">Completed Orders</a></li>
                                <li><a href="orders.php">Pending Orders</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- //navigation -->
    <!-- banner -->
    <div class="banner">
        <div class="container">
            <h3>Bulk Buying Store <span>Special Offers</span></h3>
        </div>
    </div>';
?>