<?php

include('connect.php');

$id = $_POST['id'];

$query = "UPDATE staff SET `onDuty` = '0' WHERE `staffIDNo` = '$id'";
$result = mysqli_query($db, $query);


if ($result) {
    echo('all  staff Member Duties has Been Suspended for the Day');
}
?>