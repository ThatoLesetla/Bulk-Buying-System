<?php

$errors = array();
session_start();

include('connect.php');

$idno =$_POST['idno'];
$email = $_POST['email'];
$cell = $_POST['cell'];
$passW = $_POST['passW'];
$passW1 = $_POST['passW1'];

$study="";
$drivy="";
$adimy="";


if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($errors, "Please Enter a Valid Email!");
}else { 
    $email = strip_tags($email);
    $email = $db->real_escape_string($email);
}

if (empty($cell) || strlen($cell) != 10) {
    array_push($errors, "Please Enter a Valid Contact Number!");
}else {
    $num = substr($cell,1,1);

    if ($num < 6  ||  $num > 8) {
        array_push($errors, "Please Enter a Valid South African Contact Number!");
    }else {
        $cell = strip_tags($cell);
        $cell = $db->real_escape_string($cell);
    }
}

if (empty($passW) || (strlen($passW) != 8)) {
    array_push($errors, "passsword must contain 8 characters");
} else {
    $passW = strip_tags($passW);
    $passW = $db->real_escape_string($passW);
}

if (empty($passW1) || (strlen($passW1) != 8)) {
    array_push($errors, "Confirmation passsword must contain 8 characters");
} else {
    $passW1 = strip_tags($passW1);
    $passW1 = $db->real_escape_string($passW1);
}

if (!preg_match("#[0-9]+#", $passW)) {

    array_push($errors, "Password must include at least one number! ");
}

if (strcspn($passW, '') != strlen($passW)) {

    array_push($errors, "Password must include at least one letter! ");
}

if (!preg_match("#[A-Z]+#", $passW)) {

    array_push($errors, "Password must include at least one CAPS! ");
}

if (!preg_match("#\W+#", $passW)) {

    array_push($errors, "Password must include at least one symbol! ");
}

if ($passW1 != $passW) {
    array_push($errors, "password does not match");
}else {
    $passW = md5($passW);
}

if (count($errors) ==0) {
//student
    $search_q = "SELECT * FROM student WHERE `studentID`= '$idno'";
    $search_r = mysqli_query($db, $search_q);

    while ($row2 = mysqli_fetch_array($search_r))
    {
       $study=$row2['role'];
    }


    if($study==3)
    {
        $query = "UPDATE `student` SET `email` = '$email',`cell` = '$cell',`passW` = '$passW' WHERE `studentID` = '$idno'";
        $result = mysqli_query($db, $query);
    
        if ($result) {
            $_SESSION["studentID"] = $idno;
            echo ("<script>$('#modal1').modal('close'); $('#pass').slideDown(); $('#passW-wrapper').slideDown();</script>");
        } 
    }
    


   // driver
    $search_s= "SELECT * FROM driver WHERE `driverID`= '$idno'";
    $search_d = mysqli_query($db, $search_s);
    while ($row1 = mysqli_fetch_array($search_d))
    {
       $drivy=$row1['role'];
    }


    if($drivy==2)
    {
        $query = "UPDATE `driver` SET `email` = '$email',`cell` = '$cell',`passW` = '$passW' WHERE `driverID` = '$idno'";
        $result = mysqli_query($db, $query);
    
        if ($result) {
            $_SESSION["driverID"] = $idno;
            echo ("<script>$('#modal1').modal('close'); $('#pass').slideDown(); $('#passW-wrapper').slideDown();</script>");
        } 
    }
//admin
$search_q= "SELECT * FROM administrator WHERE `adminID`= '$idno'";
$search_r = mysqli_query($db, $search_q);
while ($row3 = mysqli_fetch_array($search_r))
{
   $adimy=$row3['role'];
}


if($adimy==1)
{
    $query = "UPDATE administrator SET `email` = '$email',`cell` = '$cell',`passW` = '$passW' WHERE `adminID` = '$idno'";
    $result = mysqli_query($db, $query);

    if ($result) {
        $_SESSION["adminID"] = $idno;
        echo ("<script>$('#modal1').modal('close'); $('#pass').slideDown(); $('#passW-wrapper').slideDown();</script>");
    } 
}

}

include('errors.php');

?>