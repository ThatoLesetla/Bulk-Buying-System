<?php

include 'connect.php';
session_abort();
$errors = array();
$price=$_POST['value'];

?>
<table>
        <thead>
          <tr>
          <th>
                <label>
                    <input id="all_checked" type="checkbox" class="filled-in" />
                    <span>Check All</span>
                </label>
            </th>
              <th>No</th>
              <th>Products Name</th>
              <th>Products Description</th>
              <th>Products Exp Date</th>
              <th>Products Price</th>
              <th>Delete/Update</th>
          </tr>
        </thead>
        <tbody>
          
<?php
$number = 0;
$query = "SELECT * FROM `product` WHERE `productPrice`<='$price'";
$result = mysqli_query($db, $query);

if ($result) {
    ?>
  <tr>
  <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <td>
      <label>
        <input class="check_item" type="checkbox" class="filled-in" value="<?php echo $row['categoryCode']; ?>" />
        <span></span>
      </label>
     
</td>
 <td>
 <?php
  echo $number = $number + 1; ?>
</td>

<td>
<?php
 echo  $row['productName']; ?>   
</td>

<td>
<?php
 echo  $row['productDescription']; ?>   
</td>

<td>
<?php
 echo  $row['expiryDate']; ?>   
</td>

<td>
<?php
 echo  $row['productPrice']; ?>   
</td>

<td>

<button  id="updPrd" class="lighten-2 waves-effect waves-light btn" onclick=" moses('<?php echo $row['productCode']; ?>')" >Update</button>
<button  id="dltPrd" class="lighten-2 waves-effect waves-light-red btn" onclick=" moses2('<?php echo $row['productCode']; ?>')">Delete</button>
</td>
</tr>   
<?php
        }
    } ?>
    
    </tbody>
    </table>
    
    <?php
}
if (mysqli_num_rows($result) == 0) {
    ?>
    <h4>Products not found...</h4>
    <?php
}
?>