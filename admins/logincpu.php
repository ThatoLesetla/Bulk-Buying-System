<?php
session_start();
include('connect.php');
$errors = array();

$idNo = $_POST['stdNo'];
$passW = $_POST['passW'];
$stud="000000000";

$query = "SELECT * FROM student WHERE `studentID` = '$idNo'";
$result = mysqli_query($db,$query);

if ($result) {

    if (mysqli_num_rows($result) == 1) {
        while($row = mysqli_fetch_array($result)) {
            $stud=$row['studentID'] ;


        }
    }
}

if($idNo!=$stud)
{
    array_push($errors, "Student Number do not exist, try Again.."); 
}else{
    if (empty($idNo) || (strlen($idNo) != 9)) {
        array_push($errors, "Please Enter a Valid Student Number");
    } else {
        $idNo = strip_tags($idNo);
        $idNo = $db->real_escape_string($idNo);
    }
    
    if (empty($passW)) {
        array_push($errors, "Please Enter Password");
    } else {
        $passW = strip_tags($passW);
        $passW = $db->real_escape_string($passW);
        $passW = md5($passW);
    }
}






if (count($errors) == 0) {

    $query = "SELECT * FROM student WHERE `studentID` = '$idNo' AND `passW` = '$passW' AND `role`='3'";
    $result = mysqli_query($db, $query);

    if ($result) {

        
        if (mysqli_num_rows($result) == 1) {

            while ($row = mysqli_fetch_array($result)) {
                $role = $row['role'];

                $active_q = "UPDATE student SET `active` = '1' WHERE `studentID` = '$idNo'";
                $active_r = mysqli_query($db, $active_q);

                if ($active_r) {
                    if ($role == 3) {
                        $_SESSION['studentID'] = $idNo;
                        echo ('<script>window.location.assign("index.php");</script>');
                       
                    }
                }else {
                    array_push($errors, "Something went wrong, Please retry");
                }
            }
        } else {
            array_push($errors, "Incorrect Password");
        }
    }
    else{
        echo($row['role']);
    }
}

include('errors.php');
 