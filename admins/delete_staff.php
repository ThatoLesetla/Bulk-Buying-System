<?php

session_start();
$errors = array();
include('connect.php');

$idno = $_POST['idno'];






    $query1 = "DELETE FROM customer WHERE `customerID` = '$idno'";
    $result1 = mysqli_query($db, $query1);
    
    if ($result1) 
    {
        echo(" <script>alert('Successully Deleted');</script>");
        
    }
  

?>


<script>
    function students() {
        $.ajax({
            type: "post",
            url: "mod/all_cus.php.php",
            data: "data",
            success: function(response) {
                $('#content').html(response);
            }
        });
    }

    students();
</script>

