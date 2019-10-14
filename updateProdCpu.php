<?php
include 'connect.php';

$errors = array();
$name = $_POST['name'];
$proID = $_POST['proID'];
$Uprice = $_POST['price'];
$Udes = $_POST['des'];
$daytime = date('d l M Y H:i:s');

if (empty($Uprice)) {
    array_push($errors, 'Enter Price!');
}
if (empty($Udes)) {
    array_push($errors, 'Enter Description!');
}

if (empty($name)) {
    array_push($errors, 'Enter Product Name!');
}

$img = 'none';

    if (count($errors) == 0) {
        $query1 = "UPDATE product SET `productName`='$name',`productPrice` = '$Uprice', `updated`='$daytime', `productDescription` = '$Udes' WHERE `productID`='$proID'";
        $result1 = mysqli_query($db, $query1);

        if ($result1) {
            echo "<script>alert('Succesfully Updated');
            $('#addProdMod').modal('close');
            window.location.assign('viewProds.php');
            </script>"; ?>
            <script >
                
            </script>
    <?php
        } else {
            echo 'error'.mysqli_connect_error();
        }
    }

include 'errors.php';
?>