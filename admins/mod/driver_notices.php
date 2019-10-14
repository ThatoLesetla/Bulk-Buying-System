<?php

session_start();

include('../connect.php');

if (!empty($_SESSION['driverID'])) {
    $user = $_SESSION['driverID'];
} else {
    $user = "";
}
$query = " ";
$result="";
$query1 = "SELECT `role` FROM driver WHERE `driverID` = '$user'";
$result1 = mysqli_query($db, $query1);

if (mysqli_num_rows($result1) > 0) {
    while ($row = mysqli_fetch_array($result1)) {
        if ($row['role'] == 1) {
            $query = "SELECT * FROM notice ORDER BY `time` DESC";
        } elseif ($row['role'] == 2) {
            $query = "SELECT * FROM notice WHERE `notice_to` = '1' OR `notice_to` = '3' ORDER BY `time` DESC";
        } else {
            $query = "SELECT * FROM notice WHERE `notice_to` = '2' OR `notice_to` = '3' ORDER BY `time` DESC";
        }
    }
}

$result = mysqli_query($db, $query);

?>





<ul class="collection">
    <?php if (mysqli_num_rows($result) > 0) : ?>
    <?php while ($row = mysqli_fetch_array($result)) : ?>
    <?php 
    if ($row['notice_to'] == 1) {
        $to = "staff Members";
    } elseif ($row['notice_to'] == 2) {
        $to = "Students";
    } else {
        $to = "All";
    }

    $timer = strtotime($row['time']);

    $date = date("d M Y H:i", $timer);
    ?>
    <a href="" class="collection-item">
        <li class="black-text">
            <h5><?php echo ($to); ?></h5>
            <p><?php echo ($row['notice']); ?></p>
            <p class="grey-text"><i><?php echo ($date); ?></i></p>
        </li>
    </a>
    <?php endwhile ?>
    <?php else : ?>
    <h5>No Notices</h5>
    <?php endif ?>
</ul> 