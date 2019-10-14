<?php

session_start();
include 'connect.php';
$errors = array();

$cell = $_POST['cell'];
$passW = $_POST['passW'];


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
