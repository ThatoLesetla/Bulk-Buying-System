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
                $surname = $row['surname'];
                $city = $row['city'];
            }
        }
    }
}

$item_id = $_GET['item_id'];

include '../errors.php';
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Bulk Buying Invoice </title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />

    <style>
        /* =============================================================
   GENERAL STYLES
 ============================================================ */
        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
            line-height: 30px;
        }

        .pad-top-botm {
            padding-bottom: 40px;
            padding-top: 60px;
        }

        h4 {
            text-transform: uppercase;
        }

        /* =============================================================
   PAGE STYLES
 ============================================================ */

        .contact-info span {
            font-size: 14px;
            padding: 0px 50px 0px 50px;
        }

        .contact-info hr {
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .client-info {
            font-size: 15px;
        }

        .ttl-amts {
            text-align: right;
            padding-right: 50px;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="row pad-top-botm ">
            <div class="col-lg-6 col-md-6 col-sm-6 ">
                <img src="https://pngimage.net/wp-content/uploads/2018/06/online-store-logo-png-6.png" style="padding-bottom:20px;" />
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">

                <h3><b>Invoice# BLK000<?php echo $item_id ?></b>
                <br/>
                <strong> Bulk Buying Store</strong>
                <br />
                <i>Address :</i> 410 Madiba St,
                <br />
                Arcadia, Pretoria, 0002
                <br />
                South Africa

            </div>
        </div>
        <div class="row text-center contact-info">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <hr />
                <span>
                    <strong>Email : </strong> info@bulkbuying.co.za
                </span>
                <span>
                    <strong>Call : </strong> +95 - 890- 789- 9087
                </span>
                <span>
                    <strong>Fax : </strong> +012340-908- 890
                </span>
                <hr />
            </div>
        </div>

        <?php
        $query1 = "SELECT * FROM order_items o, product p, vendororder v, bulk_order b WHERE o.productid = p.productID AND v.productID = o.productID AND o.orderId = b.id AND o.item_id = '$item_id'";
        $result = mysqli_query($db, $query1);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $productPrice = $row['productPrice'];
                    $discountPrice = $row['discountPrice'];
                    $dateOrder = $row['dateOrder'];
                    $orderDate = $row['orderDate'];
                    $quantity = $row['quantity'];
                    $productName = $row['productName'];
                }
            }
        }
        ?>
        <div class="row pad-top-botm client-info">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h4> <strong>Client Information</strong></h4>
                <strong>Name : <?php echo $name  ?></strong>
                <br />
                <b>City :</b> <?php echo $city ?>

                <br />
                <b>Call :</b> <?php echo $cell ?>
                <br />
                <b>E-mail :</b> <?php echo $email ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">

                <h4> <strong>Payment Details </strong></h4>
                <b>Bill Amount : R<?php echo $productPrice - $discountPrice ?></b>
                <br />
                Bill Date : <?php echo $dateOrder ?>
                <br />
                <b>Payment Status : UnPaid </b>
                <br />
                Delivery Date : 10th August 2014
                <br />
                Purchase Date : <?php echo $orderDate ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S. No.</th>
                                <th>Product Name</th>
                                <th>Quantity.</th>
                                <th>Unit Price</th>
                                <th>Discount</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $item_id ?></td>
                                <td><?php echo $productName ?></td>
                                <td><?php echo $quantity ?></td>
                                <td><?php echo $productPrice ?></td>
                                <td><?php echo $discountPrice ?></td>
                                <td><?php echo ($productPrice - $discountPrice) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr />
                <div class="ttl-amts">
                    <h5> Total Amount : R<?php echo ($productPrice - $discountPrice) ?></h5>
                </div>
                <hr />
                <div class="ttl-amts">
                    <h5> VAT : R<?php echo 0.14 * ($productPrice - $discountPrice) ?> ( by 14 % on bill ) </h5>
                </div>
                <hr />
                <div class="ttl-amts">
                    <h4> <strong>Bill Amount :R<?php echo ($productPrice - $discountPrice) ?></strong> </h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <strong> Important: </strong>
                <ol>
                    <li>
                        This is an electronic generated invoice so doesn't require any signature.

                    </li>
                    <li>
                        Please read all terms and polices on www.yourdomaon.com for returns, replacement and other issues.

                    </li>
                </ol>
            </div>
        </div>
        <div class="row pad-top-botm">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <hr />
                <a href="#" class="btn btn-primary btn-lg">Print Invoice</a>
                &nbsp;&nbsp;&nbsp;
                <a href="#" class="btn btn-success btn-lg">Download In Pdf</a>

            </div>
        </div>
    </div>

</body>

</html>