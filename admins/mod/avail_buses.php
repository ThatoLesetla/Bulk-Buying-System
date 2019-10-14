<?php

$buses = array();

// Get Buses
$query = "SELECT * FROM bus";
$result = mysqli_query($db, $query);

if($result){
?>
<select name="bus" id="bus" class="browser-default validate">
<?php 

if (mysqli_num_rows($result)  > 0) :

    while ($row = mysqli_fetch_array($result)): ?>
    <option value="<?php echo ($row['regNo']) ?>"><?php echo ($row['regNo']) ?></option>
    <?php endwhile ?>

<?php else : ?>
<option value="">No Buses Available</option>
<?php endif ?> 
</select> 
<?php } ?>