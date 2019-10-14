<?php


$drivers = array();
$driverID = array();

//Get Drivers
$query = "SELECT * FROM driver WHERE `role` = '2' AND `passW` != ''";
$result = mysqli_query($db, $query);

if ($result) {
?>

<select name="driver" id="driver" class="browser-default validate">
    <?php
    if (mysqli_num_rows($result) > 0) :
        while ($row = mysqli_fetch_array($result)) : ?>
            <option value="<?php echo ($row['driverID']) ?>"><?php echo ($row['sname'] . ' ' . $row['name']) ?></option>
        <?php endwhile ?>
    <?php else : ?>
        <option value="">No Drivers Available</option>
    <?php endif ?>
</select> 
<?php } ?>