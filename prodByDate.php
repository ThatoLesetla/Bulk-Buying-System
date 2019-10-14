<?php

include 'connect.php';
session_abort();
$errors = array();


//$prodsTitle = $_POST['prodsTitle'];
if($_POST['value'])
{
    
    $names = $_POST['value'];
    $cell = $_POST['cell'];
    $date = $_POST['date'];


    $id = '';
    $query = "SELECT * FROM vendor WHERE `phone` = '$cell'";
    $result = mysqli_query($db, $query);
    
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $name = $row['name'];
                    //$surname = $row['surname'];
                    $id = $row['vendorID'];
                }
            }
        }
    
    $query = "SELECT *
    FROM vendor v, inventory i, product p 
    WHERE v.vendorID = i.vendorID 
    AND i.productID = p.productID
    AND v.vendorID = '$id' 
    AND p.updated='$date'";
    $result = mysqli_query($db, $query);
    
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    //name updated des
    
                    $name = $row['productName'];
                    $updated = $row['updated'];
                    $des = $row['productDescription'];
                    $price = $row['productPrice']; ?>
                    
                        <li id="<?php
                            echo $row['productID']; ?>" class="collection-item avatar">
                            <img src="images/<?php echo $name; ?>.jpg" alt="" class="circle">
                            <span class="title">
                            <?php
                            echo $name; ?>
                            </span>
    
                            <p>
                             R   
                            <?php
                            echo number_format($price, 2); ?>
                            <br>   
                            <?php
                            echo $des; ?>
                            <br>
                            <i>updated </i>: 
                            <?php
                            echo $updated; ?>
                            </p>
                            <div class="row">
                            <button  id="updPrd" class="lighten-2 waves-effect waves-light btn" onclick=" moses('<?php echo $row['productID']; ?>')" >Update</button>
                            <button  id="dltPrd" class="lighten-2 waves-effect waves-light btn" onclick=" moses2('<?php echo $row['productID']; ?>')">Delete</button>
                            </div>
                        </li>
    
                <?php
                }
            } else {
                ?>
                <h4><i>Product/s Not found...</i></h4>
                <?php
            }
        } else {
            echo 'query ddnt read';
        }
}


?>
