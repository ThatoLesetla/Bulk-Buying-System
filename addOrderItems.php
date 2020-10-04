<?php

include '../connect.php';

$quantity = $_POST['quantity'];

$orderID = $_POST['orderID'];

$productID = $_POST['productID'];
$discount = 'n0';
$bulkCount = 'n0';
$standPrice = '';
$stockAmount = '';

$prodInfo = "SELECT * FROM inventory i, product p WHERE i.productID = p.productID AND p.productID ='$productID'";
$prodInfor = mysqli_query($db, $prodInfo);
if ($prodInfor) {
    while ($row = mysqli_fetch_array($prodInfor)) {
        $discount = $row['discount'];
        $bulkCount = $row['bulkCount'];
        $standPrice = $row['productPrice'];
        $stockAmount = $row['stockAmount'];
    }
}

echo $discount.'|'.$bulkCount;

$query7 = "INSERT INTO order_items(`orderId`,`productId`,`quantity`,`orderFilled`) VALUES('$orderID','$productID','$quantity','0')";

            $result7 = mysqli_query($db, $query7);
            if ($result7) {
                //updating quabtity
                $stockAmount -= $quantity;
                $upQ = "UPDATE inventory SET stockAmount='$stockAmount' WHERE productID='$productID'";
                $rQ = mysqli_query($db, $upQ);
            } else {
                echo 'denied'.$quantity.'|'.$orderID.'|'.$productID;
            }

$query = 'SELECT o.productId AS productID, SUM(o.quantity) AS quantity
            FROM order_items o, bulk_order b
            WHERE o.orderId = b.id
            AND b.orderFilled = 0 AND o.orderFilled = 0
            GROUP BY o.productId';

$result1 = mysqli_query($db, $query);

if ($result1) {
    if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_array($result1)) {
            $quantity = $row['quantity'];
            $productID = $row['productID'];

           // $query2 = "SELECT CURRENT_TIMESTAMP()";
            //$result2 = mysqli_
            if ($quantity > $bulkCount) {
                $query2 = "INSERT INTO `vendorOrder` (dateOrder, quantity,productId) VALUES (CURRENT_TIMESTAMP(), '$quantity','$productID')";
                $result2 = mysqli_query($db, $query2);

                if ($result2) {
                    $id_v='';
                    $now='';
                    $up="SELECT * FROM vendorOrder WHERE productId='$productID'";
                    $rup=mysqli_query($db, $up);
                    while ($row = mysqli_fetch_array($rup)) {
                        $id_v=$row['id'];
                        $now=$row['dateOrder'];

                    }
                    

                    $disscPrice = $standPrice - ($standPrice * $discount / 100);
                    $filled = "UPDATE `order_items` SET `orderFilled`='1', `discountPrice`='$disscPrice',`vendoroderId`='$id_v' WHERE `productID`='$productID' AND `orderFilled`=0";
                    $filledr = mysqli_query($db, $filled);



                } else {
                    
                }
            } else {
                echo("ur quantity is greater than bulk");
            }
        }
    }
}
