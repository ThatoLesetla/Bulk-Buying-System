<?php

include('connect.php');
$errors = array();

$idno = $_POST['idno'];
$stdNo = $_POST['stdNo'];
$sname = $_POST['sname'];
$name = $_POST['name'];


if (empty($idno) || !is_numeric($idno) || strlen($idno) != 13) {
    array_push($errors, "Please Enter a Valid ID Number");
} else {
    $idno = strip_tags($idno);
    $idno = $db->real_escape_string($idno);

    $query = "SELECT * FROM student WHERE `IDNo` = '$idno'";
    $result = mysqli_query($db, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            array_push($errors, 'ID Number Already Registered');
        }
    }
}

if (empty($stdNo) || !is_numeric($stdNo) || strlen($stdNo) != 9) {
    array_push($errors, "Please Enter Correct Student Number");
} else {
    $stdNo = strip_tags($stdNo);
    $stdNo = $db->real_escape_string($stdNo);

    $query = "SELECT * FROM student WHERE `studentID` = '$stdNo'";
    $result = mysqli_query($db, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            array_push($errors, 'User Already Exist');
        }
    }
}

if (empty($sname) || is_numeric($sname) || strlen($sname) < 3) {
    array_push($errors, "Please Enter a valid Surname");
} else {
    $sname = strip_tags($sname);
    $sname = $db->real_escape_string($sname);
    $sname = strtoupper($sname);
}

if (empty($name) || is_numeric($name)) {
    array_push($errors, "Please Enter valid Full Name(s)");
} else {
    $name = strip_tags($name);
    $name = $db->real_escape_string($name);
    $name = strtoupper($name);
    $name = strtoupper($name);
}

if (count($errors) == 0) {

    $query = "INSERT INTO student (`studentID`,`IDNo`,`sname`,`name`, `role`) VALUES ('$stdNo', '$idno','$sname','$name', '3')";
    $result = mysqli_query($db, $query);

    if ($result) {

        echo ("<script>$('#adm_mod').modal('close');</script>");
        ?>
<script>
    function students() {
        $.ajax({
            type: "post",
            url: "students.php",
            data: "data",
            success: function(response) {
                $('#content').html(response);
            }
        });
    }

    students();
</script>


<?php

}
}

include('errors.php');

 ?>