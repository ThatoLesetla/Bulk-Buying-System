<?php
session_start();
include 'connect.php';
$cell = $_SESSION['phone'];

$query = "SELECT * FROM `vendor` WHERE `phone` = '$cell'";
    $result = mysqli_query($db, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $name = $row['name'];
                $id = $row['vendorID'];
                $email = $row['email'];
            }
        }
    }

$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
$path = 'img/'; // upload directory
if(!empty($_POST['name']) || !empty($_POST['email']) || $_FILES['image'])
{
$img = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];
// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function
$final_image = $id.'#'.$img;
$fileNameNew = $name.$id.'.'.$ext;
// check's valid format
if(in_array($ext, $valid_extensions)) 
{ 
$path = $path.strtolower($fileNameNew); 
if(move_uploaded_file($tmp,$path)) 
{
//echo "<img src='$path' />";

//include database configuration file
$sql = "UPDATE vendor SET `img`='$fileNameNew' WHERE `vendorID`='$id'";
$result = mysqli_query($db, $sql);
//header('location:vendor.php');
//echo $insert?'ok':'err';
echo'  <script>
$(document).ready(function (e) {
alert("Picture Uploaded");
});
</script>';
}
} 
else 
{
echo'  <script>
alert("file format not accepted, try jpeg jpg png, Make cure you have chosen file!!");
</script>';
}
}

?>