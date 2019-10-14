<?php

session_start();
include 'connect.php';
$errors = array();

$cell = $_POST['cell'];
$passW = $_POST['passW'];
$signAs = $_POST['signAs'];

if (empty($cell) || (strlen($cell) != 10)) {
    array_push($errors, 'Please Enter a Valid Contact Number');
} else {
    $cell = strip_tags($cell);
    $cell = $db->real_escape_string($cell);
}

if (empty($passW)) {
    array_push($errors, 'Please Enter Password');
} else {
    $passW = strip_tags($passW);
    $passW = $db->real_escape_string($passW);
    $passW = md5($passW);
}
if ($signAs == 0) {
    array_push($errors, 'Please Select Your Sign As!!');
}

if (count($errors) == 0) {
    if ($signAs == 1) {
        $query = "SELECT * FROM vendor WHERE `phone` = '$cell' AND `password` = '$passW'";
        $result = mysqli_query($db, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $_SESSION['phone'] = $cell;
                echo '<script>window.location.assign("vendor.php");</script>';
            } else {
                array_push($errors, 'Incorrect Combination of Cell and Password');
            }
        } else {
            array_push($errors, 'User does Not Exist');
        }
    } else {
        $query = "SELECT * FROM customer WHERE `phone` = '$cell' AND `password` = '$passW'";
        $result = mysqli_query($db, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $_SESSION['phone'] = $cell;
                echo '<script>window.location.assign("customer.php");</script>';
            } else {
                array_push($errors, 'Incorrect Combination of Contacts and Password');
            }
        } else {
            array_push($errors, 'User does Not Exist');
        }
    }
}

include 'errors.php';
