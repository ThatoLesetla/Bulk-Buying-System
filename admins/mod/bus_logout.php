<?php

include('../connect.php');

$id = $_POST['id'];

$query = "UPDATE bus SET `onDuty` = '0' WHERE `regNo` = '$id'";
$result = mysqli_query($db, $query);


if ($result) {
    echo ('all '.$id.' Bus Duties has Been Suspended for the Day');
}
 