<?php

session_start();

include 'connect.php';

$errors = array();
$name = $_POST['name'];
$surname  = $_POST['surname'];
$cell = $_POST['cell'];
$city = $_POST['city'];
$email = $_POST['email'];
$passW = $_POST['passW'];
$passW1 = $_POST['passW1'];

if (empty($name) || is_numeric($name)) {
    array_push($errors, 'Please Enter Valid Name');
    if (preg_match('#[0-9]+#', $name)) {
        array_push($errors, 'Name must not include numbers! ');
    }
} else {
    $name = strip_tags($name);
    $name = $db->real_escape_string($name);
    $name = strtoupper($name);
}

if (empty($surname) || is_numeric($surname)) {
    array_push($errors, 'Please Enter Valid Surname');
    if (preg_match('#[0-9]+#', $surname)) {
        array_push($errors, 'Surname must not include numbers! ');
    }
} else {
    $surname = strip_tags($surname);
    $surname = $db->real_escape_string($surname);
    $surname = strtoupper($surname);
}

if (empty($city) || is_numeric($city)) {
    array_push($errors, 'Please Enter Valid city');
    if (preg_match('#[0-9]+#', $city)) {
        array_push($errors, 'City not must include numbers! ');
    }
} else {
    $city = strip_tags($city);
    $city = $db->real_escape_string($city);
    $city = strtoupper($city);
}
if (preg_match("#\W+#", $name)) {
    array_push($errors, 'Name must not include symbols! ');
}
/*
if (preg_match("#\W+#", $surname)) {
    array_push($errors, 'Surname must not include symbols! ');
}

if (empty($surname) || is_numeric($surname)) {
    array_push($errors, 'Please Enter Valid Surname');
    if (preg_match('#[0-9]+#', $name)) {
        array_push($errors, 'Name must not include numbers! ');
    }
} else {
    $surname = strip_tags($surname);
    $surname = $db->real_escape_string($surname);
    $surname = strtoupper($surname);
}*/

if (empty($cell) || strlen($cell) != 10) {
    array_push($errors, 'Please Enter a Valid Contact Number!');
} else {
    $num = substr($cell, 1, 1);

    if ($num < 6 || $num > 8) {
        array_push($errors, 'Please Enter a Valid South African Mobile Number!');
    } else {
        $query = "SELECT * FROM `customer` WHERE `phone` = '$cell'";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) > 0) {
            array_push($errors, 'Contact Number Already Registered, <a href="login.php">Login</a>');
            $cell = strip_tags($cell);
            $cell = $db->real_escape_string($cell);
        }
    }
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($errors, 'Please Enter a valid Email!');
} else {
    $email = strip_tags($email);
    $email = $db->real_escape_string($email);
}

if (!preg_match('#[0-9]+#', $passW)) {
    array_push($errors, 'Password must include at least one number! ');
}

if (strcspn($passW, '') != strlen($passW)) {
    array_push($errors, 'Password must include at least one letter! ');
}

if (!preg_match('#[A-Z]+#', $passW)) {
    array_push($errors, 'Password must include at least one CAPS! ');
}

if (!preg_match("#\W+#", $passW)) {
    array_push($errors, 'Password must include at least one symbol! ');
}
if (empty($passW) || strlen($passW) < 8) {
    array_push($errors, 'Please Create a valid Password, Password cannot have less than 8 characters');
} else {
    $passW = strip_tags($passW);
    $passW = $db->real_escape_string($passW);

    if (empty($passW1) || strlen($passW1) < 8) {
        array_push($errors, 'Cornfirmation Password is Wrong');
    } else {
        $passW1 = strip_tags($passW1);
        $passW1 = $db->real_escape_string($passW1);

        if ($passW != $passW1) {
            array_push($errors, "Passwords Provided don't match, Please be careful and try again");
        } else {
            $passW = md5($passW);
        }
    }
}

$table = 'customer';

if (count($errors) == 0) {
    $query1 = 'INSERT INTO '.$table." (`name`,`surname`,`phone`,`email`,`city`,`password`) VALUES ('$name','$surname','$cell','$email','$city','$passW')";
    $result1 = mysqli_query($db, $query1);

    if ($result1) {
        $_SESSION['phone'] = $cell;
        echo '<script>window.location.assign("customer.php");</script>';
    } else {
        echo 'error'.mysqli_connect_error();
    }
}

include 'errors.php';
