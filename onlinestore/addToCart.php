<?php

include '../connect.php';

$total = $_POST['total'];
$paymentType = $_POST['paymentType'];
$customerID = $_POST['customerID'];
echo 'its working';

$query = "INSERT INTO bulk_order(customerId, orderDate, total, paymentType, orderFilled) VALUES ('$customerID', '2019-05-06', '$total', '$paymentType', 0)";
$result = mysqli_query($db, $query);

?>