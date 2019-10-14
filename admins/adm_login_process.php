<?php

session_start();
include 'connect.php';
$errors = array();

$idNo = $_POST['idno'];
$passW = $_POST['passW'];

if (empty($idNo) || (strlen($idNo) != 10)) {
    array_push($errors, 'Please Enter a Valid Contact Number');
} else {
    $idNo = strip_tags($idNo);
    $idNo = $db->real_escape_string($idNo);
}

if (empty($passW)) {
    array_push($errors, 'Please Enter Password');
} else {
    $passW = strip_tags($passW);
    $passW = $db->real_escape_string($passW);
    $passW = md5($passW);
}

if (count($errors) == 0) {
    $query = "SELECT * FROM administrator WHERE `cell` = '$idNo' AND `password` = '$passW'";
    $result = mysqli_query($db, $query);

    if ($result) {
        $_SESSION['cell'] = $idNo;
        echo '<script>window.location.assign("admin_dashboard.php");</script>';
    } else {
        echo 'Admin do not exist...';
    }
}

include 'errors.php';
