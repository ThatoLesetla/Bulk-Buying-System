<?php

include 'connect.php';

$typeOfSam = $_POST['typeOfSam'];
$no = 0;
//Sammury Type

if ($typeOfSam == 1) {
    //All
    $query = 'Select * FROM vendor';
    $type = 'All Time';
    $date = 'Last Record';
} elseif ($typeOfSam == 2) {
    //Week
    $today = date('d-m-Y');
    $date = date('d-m-Y', strtotime($today.'-7 days'));

    $query = "Select * FROM vendor WHERE `date` >= '$date'";
    $type = 'Week Sammury';
} elseif ($typeOfSam == 3) {
    //Month
    $today = date('d-m-Y');
    $date = date('d-m-Y', strtotime($today.'-29 days'));

    $query = "Select * FROM vendor WHERE `date` >= '$date'";
    $type = '1 Month Sammury';
} elseif ($typeOfSam == 4) {
    //3 months
    $today = date('d-m-Y');
    $date = date('d-m-Y', strtotime($today.'-90 days'));

    $query = "Select * FROM vendor WHERE `date` >= '$date'";
    $type = '3 Months';
}

$result = mysqli_query($db, $query);

//Get Gender
function getGender($identity)
{
    $gender = (int) substr($identity, 6, 1);

    return ($gender >= 0 && $gender <= 4) ? 'Female' : 'Male';
}

if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        $no = $no + 1;
    }
}
echo '<script>$("#show").html("vendor Sammury")</script>';
?>
<h5>vendor Report</h5>
<div class="divider"></div>
<p><i class="grey-text"><?php echo $type.' From '.$date; ?></i></p>


<!--No Students Using Bus-->

<div class="progress red lighten-4" style="height: 15px;">
    <div class="determinate blue lighten-2" style="width: <?php echo round($totStdBus / $totStd * 100, 2); ?>%;"></div>
</div>
<p>Number of vendors: <?php echo mysqli_num_rows($result); ?> </p><br>










<p></p>
<p></p>

