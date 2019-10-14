<?php


session_start();
include('connect.php');

$time = $_POST['time'];
$bus = $_POST['bus'];
$id = $_POST['id'];


$query = "SELECT * FROM booking WHERE `time` = '$time' AND `bus` = '$bus' AND `stdNo` = '$id'";
$result = mysqli_query($db, $query);

if ($result) {
    $query1 = "DELETE FROM booking WHERE `time` = '$time' AND `bus` = '$bus' AND `stdNo` = '$id'";
    $result1 = mysqli_query($db, $query1);

    $path = "images/";
    $filename = $time . $bus . $id . '.png';

    if (file_exists($path . $filename)) {
        unlink($path . $filename);
    }

    echo ("<script>window.location.assign('show_bookings.php');</script>");

    ?>

<?php

}
?> 