<?php

include 'connect.php';

$errors = array();

$proID = $_POST['pID'];

$query = "DELETE FROM Inventory WHERE `productID` = '$proID'";
$result = mysqli_query($db, $query);

$query1 = "DELETE FROM product WHERE `productID` = '$proID'";
$result1 = mysqli_query($db, $query1);
    if ($result1) {
        echo " <script>alert('Successully Deleted');
        window.location.assign('viewProds.php');
        </script>";
    } else {
        echo " <script>alert('Not Successully Deleted');
        window.location.assign('viewProds.php');
        </script>";
    }
