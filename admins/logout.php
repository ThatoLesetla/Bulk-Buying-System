<?php

session_start();
include('connect.php');
$userID = $_SESSION['studentID'];

$query = "UPDATE student SET `active` = '0' WHERE `studentID` = '$userID'";
$result = mysqli_query($db, $query);

if ($result) {
    unset($_SESSION['studentID']);
    session_destroy();
    header('location: login.php');
}

?>