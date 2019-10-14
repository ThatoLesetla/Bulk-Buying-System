<?php
session_start();

include 'connect.php';
$errors = array();

if (empty($_SESSION['phone'])) {
    unset($_SESSION['phone']);
    session_abort();
    header('location: login.php');
} else {
    $cell = $_SESSION['phone'];
    $name = ' ';

    $id = '';
    $email = '';

    $query = "SELECT * FROM `customer` WHERE `phone` = '$cell'";
    $result = mysqli_query($db, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $name = $row['name'];
                $img = $row['img'];
                $id = $row['customerID'];
                $email = $row['email'];
            }
        }
    }
}

include 'errors.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnlineStore</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">
    
</head>

<style>
 #photo {
   border-bottom: 2.5px solid #fcf9f2  !important;
  }
  #name{
    border-bottom: 2.5px solid #ea454b  !important;
    
  }
  #price{
    border-bottom: 2.5px solid #ea454b  !important;
   
  }
  #des{
    border-bottom: 2.5px solid #ea454b  !important;
   
  }
 
.vendor-view{
  background-image: url('images/road-1072823_640.jpg');
  height: 300px;
  background-size:no-repeat;
  

}

#ven-view{
  padding-top:10%;
  padding-left:4%;
}
  #user_profile{
    width: 100px;
    height: 100px;
  }

  
 
</style>

<body>

<nav class="nav-extended">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo"><i class="">Bulk Buying System</i></a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <a href="#" data-target="sidenav-2" class="right sidenav-trigger show-on-medium-and-up"></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
         
        <li><a href="#">Cart</a></li>
        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><?php echo"$name"; ?></a></li>
   
        
    </ul>
      </ul>
    </div>

  </nav>
  <!--<a href="#" data-target="slide-out" class="sidenav-trigger">Dashboard</a>-->
  <ul class="sidenav" id="mobile-demo">
    <li><a href="sass.html">Sass</a></li>
    <li><a href="badges.html">Components</a></li>
    <li><a href="collapsible.html">JavaScript</a></li>
  </ul>
  <!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
  <li><a href="#!">Profile</a></li>
  <li><a href="logout.php">Logout</a></li>
  <li class="divider"></li>
  <li><a href="#!">more</a></li>
</ul>

  <!--modal to add prods-->
  <div id="addProdMod" class="modal modal-fixed-footer valign-wrapper" style="">

        <span id="mod_content" class="valign-wrapper" style="padding-top: 20px;"></span>
</div>
<div>


</div>

     

  <div class="container">
    <h1>Coming soon...</h1>
    
  </div>             
  
        

   
     <!--scripts-->
    <script src="script/jquery.min.js"></script>
    <script src="script/materialize.min.js"></script>
    <script src="script/fontawesome.min.js"></script>
    <script src="script/all.min.js"></script>
    <script src="script/wow.min.js"></script>
    <script async>

    $(document).ready(function() {
        $('.sidenav').sidenav();   
        $(".dropdown-trigger").dropdown(); 
        $('#sidenav-1').sidenav({ edge: 'left' });
	      $('#sidenav-2').sidenav({ edge: 'left' });
        $('.modal').modal();
        });

    $('#editPro').click(function() {
        
        $.ajax({
           
            url: "updateProfile.html",
            success: function(response) {
                $('#mod_content').html(response);
                $('#addProdMod').modal('open');
                
            }
        });
      });

      $('#pic').click(function(e) {
        //e.preventDefault();
        var file=$('#prepic').val();
       
        
        
        

    $.ajax({
      type:"post",
        url: "pp.php",
        data: {
          file:file,
},
        success: function(response) {
            $('#result').html(response);
           
            
        }
    });
  });

  function showUser(str) {
    if (str == "") {
        document.getElementById("result").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("result").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","vendor.php?q="+str,true);
        xmlhttp.send();
    }
  }

        

   
    </script>

</body>

</html> 