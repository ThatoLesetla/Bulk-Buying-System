<?php
session_start();
include 'connect.php';

$errors = array();
$name=$_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$city = $_POST['city'];
$email = $_POST['email'];

$daytime = date('d l M Y H:i:s');
if (empty($phone) || strlen($phone) != 10) {
    array_push($errors, 'Please Enter a Valid Contact Number!');
} else {
    $num = substr($phone, 1, 1);

    if ($num < 6 || $num > 8) {
        array_push($errors, 'Please Enter a Valid South African Contact Number!');
    }
}
if (empty($name) || is_numeric($name)) {
    array_push($errors, 'Please Enter Valid Name');
    
} else {
    $name = strip_tags($name);
    $name = $db->real_escape_string($name);
    $name = strtoupper($name);
}
if (preg_match('#[0-9]+#', $name)) {
    array_push($errors, 'Name must not include numbers! ');
}
if (preg_match("#\W+#", $name)) {
    array_push($errors, 'Name must not include symbols! ');
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($errors, 'Please Enter a valid Email!');
} else {
    $email = strip_tags($email);
    $email = $db->real_escape_string($email);
}
if (empty($address)) {
    array_push($errors, 'Enter address!');
}
if (empty($city)) {
    array_push($errors, 'Enter city!');
}
if (preg_match("#\W+#", $city)) {
    array_push($errors, 'city must not include symbols! ');
}
$cell = $_SESSION['phone'];
    if (count($errors) == 0) {
        $query1 = "UPDATE vendor SET `name`='$name', `phone` = '$phone', `email`='$email', `city` = '$city',`address`='$address' WHERE `phone`='$cell'";
        $result1 = mysqli_query($db, $query1);

        if ($result1) {
            // $cell = $_SESSION['phone'];
            echo "<script>alert('Succesfully Updated');
           
            window.location.assign('vendor.php');
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