<?php

include '../connect.php';

$total = $_POST['total'];
$paymentType = $_POST['paymentType'];
$customerID = $_POST['customerID'];
$orderDate = $_POST['orderDate'];
echo 'its working';

$query = "INSERT INTO bulk_order(customerId, orderDate, total, paymentType, orderFilled) VALUES ('$customerID', '$orderDate', '$total', '$paymentType', 0)";
$result = mysqli_query($db, $query);

?>