<?php
$loc = array();

//Get locations
$query = "SELECT * FROM `location` ORDER BY `location` ASC";
$result = mysqli_query($db, $query);

if ($result) {
    ?>
<select name="loc" id="loc" class="browser-default validate">
   



<?php //if (count($loc) > 0) : 
if (mysqli_num_rows($result)>0) :
        while ($row = mysqli_fetch_array($result)) :?>
         <option value="<?php echo ($row['location']) ?>"><?php echo ($row['location']) ?></option> 
         <?php endwhile ?>  
    
    
 <?php else : ?>
<option value="">No Locations Available</option>
<?php endif ?> 
    
    
</select>
<?php } ?>