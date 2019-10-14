<?php

$mysqli = new mysqli('localhost', 'root', '', 'onstore');

$errors = array();

$id = $_POST['ids'];

$_id = str_replace(' ', ',', $id);

$result = $mysqli->query("DELETE FROM Inventory WHERE productID  in($_id)");

$r = $mysqli->query("delete from product where productID in($_id)");

if ($r) {
    echo " <script>alert('Successully Deleted');
    window.location.assign('viewProds.php');
    </script>";
} else {
    echo " <script>alert('Not Successully Deleted');
    window.location.assign('viewProds.php');
    </script>";
}
