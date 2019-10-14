<script src="script/jquery.min.js"></script>
    <script src="script/materialize.min.js"></script>
    <script src="script/fontawesome.min.js"></script>
    <script src="script/all.min.js"></script>
    <script src="script/wow.min.js"></script>
   <script type="text/javascript">
        alert("file format not accepted, try jpeg jpg png.....");
    </script>';

<?php

session_start();
include 'connect.php';
$cell = $_SESSION['phone'];
echo'  <script>
alert("file format not accepted, try jpeg jpg png2");
</script>';

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

$errors = array();
if (!isset($_POST['file'])) {
    array_push($errors, 'll');
    header('location:vendor.php?notupdated');
}
if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = $id.'.'.$fileActExt;
                $fileDistination = 'img/'.$fileNameNew;
                $img = $fileNameNew;
                array_push($errors, $img);
                move_uploaded_file($fileTmpName, $fileDistination);
                $sql = "UPDATE vendor SET `img`='$fileNameNew' WHERE `vendorID`='$id'";
                $result = mysqli_query($db, $sql);

                header('location:vendor.php?uploadsuccess');
            } else {
                //array_push($errors, 'your file is too large!!');
                echo'  <script>
                alert("file format not accepted, try jpeg jpg png2");
                </script>';
            }
        } else {
            //array_push($errors, 'There was an error uploading your file, try again..');
            echo'  <script>
        alert("file format not accepted, try jpeg jpg png1");
        </script>';
        }
    } else {
        //array_push($errors, 'file format not accepted, try jpeg jpg png');
        ?>
        <script>
        alert("file format not accepted, try jpeg jpg png.....");
        </script>';
        <?php
    }
} else {
    echo'  <script>
    alert("file format not accepted, try jpeg jpg png");
    </script>';
}
include 'errors.php';
