
<?php
session_start();
include 'connect.php';
$cell = $_SESSION['cell'];
//$prodsTitle = $_POST['prodsTitle'];

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

$query = 'SELECT *
FROM vendor v, inventory i, product p 
WHERE v.vendorID = i.vendorID 
AND i.productID = p.productID 
AND v.vendorID';
$result = mysqli_query($db, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                //name updated des

                $name = $row['productName'];
                $updated = $row['updated'];
                $des = $row['productDescription'];
                $price = $row['productPrice'];
                $ven = $row['name']; ?>
                
                <div>
                
               
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
                        <br>
                        <i>vendor: </i>: 
                        <?php
                            echo $ven; ?>
                        </p>
                        
                        
                    </li>

            <?php
            }
        } else {
            ?>
            <h4><i>No Products Added</i></h4>
            <?php
        }
    } else {
        echo 'query ddnt read';
    }

?>

</ul>

</div>