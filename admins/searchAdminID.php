<?php

include('connect.php');

$idNo = $_POST['idno'];

$query = "SELECT * FROM administrator WHERE `adminID` = '$idNo'";
$result = mysqli_query($db,$query);

$query1 = "SELECT * FROM driver WHERE `driverID` = '$idNo'";
$result1 = mysqli_query($db,$query1);

if ($result) {


    if (mysqli_num_rows($result) == 1) {
        while($row = mysqli_fetch_array($result)) {
            $name = $row['sname']. ' '. $row['name'];
           

            if (empty($row['passW'])) {
                echo("<script>$('#create_userDetails').html('{$name}');</script>");
                echo("<script>$('#modal1').modal('open');</script>");
                
                
            }else { 
                
            }
        }
    }else{
      
        
    }
}else {
   // echo('<p class="red-text text-lighten-2">Something went wrong, Please Refresh the Page and Try again</p>');
}




if ($result1) {
    
    $result=false;
    if (mysqli_num_rows($result1) == 1) {
        while($row1 = mysqli_fetch_array($result1)) {
            $name = $row1['sname']. ' '. $row1['name'];
           

            if (empty($row1['passW'])) {
                echo("<script>$('#create_userDetails').html('{$name}');</script>");
                echo("<script>$('#modal1').modal('open');</script>");
                echo("<script> $('#pass').slideUp(); $('#passW-wrapper').slideUp();</script>");
            }else { 
                echo("<script> $('#pass').slideDown(); $('#passW-wrapper').slideDown();</script>");
            }
        }
    }else{
       
        
    }
}else {
  //  echo('<p class="red-text text-lighten-2">Something went wrong, Please Refresh the Page and Try again</p>');
}



?>