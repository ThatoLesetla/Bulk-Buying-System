<?php
include 'connect.php';
session_start();
$errors = array();
$name = $_POST['name'];
$price = $_POST['price'];
$des = $_POST['des'];
$stock = $_POST['stock'];
$point = $_POST['point'];
$phone = $_SESSION['phone'];
$daytime = date('Y/m/d');
//2014/03/04
if (empty($name)) {
    array_push($errors, 'Enter Name!');
}
if (empty($point)) {
    array_push($errors, 'Enter point');
}
if (empty($price)) {
    array_push($errors, 'Enter Price!');
}
if (empty($des)) {
    array_push($errors, 'Enter Description!');
}

$img = 'none';
$query = "SELECT * FROM product WHERE `productName`='$name'";
$resl = mysqli_query($db, $query);
if ($resl) {
    if (mysqli_num_rows($resl) > 0) {
        array_push($errors, 'Products name already exists');
    }
}

    if (count($errors) == 0) {
        $query1 = "INSERT INTO product (`productName`,`productPrice`,`updated`,`productDescription`) VALUES ('$name','$price','$daytime','$des')";
        $result1 = mysqli_query($db, $query1);

        $query = "INSERT into inventory(`productID`,`vendorID`,`stockAmount`,`reorderPoint`)
            VALUES((SELECT `productID` from product where `productName`='$name'),(SELECT `vendorID` from vendor where `phone`='$phone'),'$stock','$point')";
        $result = mysqli_query($db, $query);

        if ($result1) {
            // $_SESSION['vendorCellNo'] = $cell;
            echo "<script>
        alert('succesfully added');
        window.location.assign('viewProds.php');
        </script>";
        } else {
            echo 'error'.mysqli_connect_error();
        }
    }

include 'errors.php';

?>

