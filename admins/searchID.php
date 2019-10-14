<?php

include('connect.php');

$idNo = $_POST['idno'];


$query = "SELECT * FROM student WHERE `studentID` = '$idNo'";
$result = mysqli_query($db,$query);

if ($result) {

    if (mysqli_num_rows($result) == 1) {
        while($row = mysqli_fetch_array($result)) {
            $name = $row['sname']. ' '. $row['name'];
           

            if (empty($row['passW'])) {
                echo("<script>$('#create_userDetails').html('{$name}');</script>");
                echo("<script>$('#modal1').modal('open');</script>");
                
                echo("<script> $('#pass').slideUp(); $('#passW-wrapper').slideUp();</script>");
            }else { 
                echo("<script> $('#pass').slideDown(); $('#passW-wrapper').slideDown();</script>");
            }
        }
    }else{
        echo("<script> $('#pass').slideUp(); $('#passW-wrapper').slideUp();</script>");
        
    }
}else {
    echo('<p class="red-text text-lighten-2">Something went wrong, Please Refresh the Page and Try again</p>');
}

?>