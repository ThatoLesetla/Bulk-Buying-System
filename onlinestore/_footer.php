<?php
    echo '<div class="footer">
        <div class="container">
            <div class="w3_footer_grids">
                <div class="col-md-3 w3_footer_grid">
                    <h3>Contact</h3>
                    <p>Bulk Buyers the store to make small purchases and get bulk discounts.</p>
                    <ul class="address">
                        <li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>410 Madiba St, Arcadia, Pretoria, 0002  <span>South Africa</span></li>
                        <li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@bulkbuers.com">info@bulkbuers.com</a></li>
                        <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+1234 567 567</li>
                    </ul>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <h3>Information</h3>
                    <ul class="info">
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="products.php">Shop Now</a></li>
                    </ul>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <h3>Category</h3>
                    <ul class="info">';

                    
                        $query = "SELECT * FROM category";
                        $result = mysqli_query($db, $query);

                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                            
                                while ($row = mysqli_fetch_array($result)) {
                                    
                                    $categoryName = $row['categoryName'];
                                    $categoryCode = $row['categoryID'];

                                    echo '<li><a href="products.php?categoryCode=' . urlencode($categoryCode) . '">' . $categoryName . '</a></li>';
                                }
                            }
                        }
                      
                    echo '</ul>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <h3>Profile</h3>
                    <ul class="info">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="products.php">Today\'s Deals</a></li>
                    </ul>
                    <h4>Follow Us</h4>
                    <div class="agileits_social_button">
                        <ul>
                            <li><a href="#" class="facebook"> </a></li>
                            <li><a href="#" class="twitter"> </a></li>
                            <li><a href="#" class="google"> </a></li>
                            <li><a href="#" class="pinterest"> </a></li>
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
                <p>&copy; 2017 Bulk Buying Store. All rights reserved | Design by <a href="http://w3layouts.com/">Bulk Buying</a></p>
            </div>
        </div>
    </div>';

?>