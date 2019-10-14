<?php

include('../connect.php');


$id = $_POST['id'];
$bus = $_POST['bus'];
$driver = $_POST['driver'];

if (empty($date)) {
    $query1 = "SELECT * FROM schedule WHERE (`bus` = '$bus' AND `driver` = '$driver')";
}else {
    $date = $_POST['dater'];
    $query1 = "SELECT * FROM schedule WHERE (`bus` = '$bus' AND `driver` = '$driver' AND `schedule_date` = '$date')";
}


$result1 = mysqli_query($db, $query1);

if ($result1) {
    if (mysqli_num_rows($result1) - 1 == 0 ) {
        $query2 = "UPDATE bus SET `onDuty` = '0' WHERE `regNo` = '$bus'";
        $result2 = mysqli_query($db, $query2);

        $query3 = "UPDATE driver SET `active` = '0' WHERE `driverID` = '$driver'";
        $result3 = mysqli_query($db, $query3);

        if ($result2 && $result3) {
            $query = "DELETE FROM schedule WHERE `scheduleID` = '$id'";
            $result = mysqli_query($db, $query);

            if ($result) {
                echo("<script>Mat erialize.toast('Successfully Deleted', 4000, 'rounded');</script>");
            }
        }
    }else {
        $query = "DELETE FROM schedule WHERE `scheduleID` = '$id'";
        $result = mysqli_query($db, $query);

        if ($result) {
            echo(" <script >Mat erialize.toast('Successfully Deleted', 4000, 'rounded');</script>");
            }
    }
}

?>