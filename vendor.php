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

    $query = "SELECT * FROM `vendor` WHERE `phone` = '$cell'";
    $result = mysqli_query($db, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $name = $row['name'];
                $img = $row['img'];
                $id = $row['vendorID'];
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
        <li><a href="logout.php">Logout</a></li>
        <li><a href="#">Home</a></li>
      </ul>
    </div>

  </nav>
  <!--<a href="#" data-target="slide-out" class="sidenav-trigger">Dashboard</a>-->
  <ul class="sidenav" id="mobile-demo">
    <li><a href="sass.html">Sass</a></li>
    <li><a href="badges.html">Components</a></li>
    <li><a href="collapsible.html">JavaScript</a></li>
  </ul>

  

<!-- Modal Structure -->


  <!--modal to add prods-->
  <div id="addProdMod" class="modal modal-fixed-footer valign-wrapper" style="width:50%">

        <span id="mod_content" class="valign-wrapper" style="padding-top: 30px;"></span>
</div>


  <div class="container">
  <ul >
    <li>
      <div class="vendor-view">
        <div id="ven-view">
        <a href="#user"><img id="user_profile" class="circle" src="<?php echo 'img/'.$img.'?'.mt_rand(); ?>"
      
      </a><br>
        <a href="#name"><span class="white-text name"><h5><?php echo"$name"; ?> </h5></span></a>
        <a href="#email"><span class="white-text email"><?php echo"$email"; ?></span></a><br>
        </div>
        
      
    </div><br>
 
  <div id="control"> 
  </li>
  <li><a class="subheader">Change Profile Picture</a></li>
 <li>
 <form id="form" action="ajaxupload.php" method="post" enctype="multipart/form-data"> 

 <input id="uploadImage" type="file" accept="image/*" name="image" />
 

<input class="btn btn-success" type="submit" value="Upload Picture">

  
</form>
<div id="err"></div>
</li><br>
    <li><a id="editPro" class="waves-effect waves-light btn">edit profile</a></li><br>
    <li><div class="divider"></div></li>
    <li><a class="subheader">DashBoard</a></li>
    <li><a href="viewProds.php" id="viewProds" class="waves-effect waves-light btn">view products</a></li><br>
    
  </ul>

  
  
  
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
        var id="<?php echo $id; ?>";
        
        $.ajax({
            type:"post",
            url: "updateProfile.php",
            data:{
              id:id
            },
            success: function(response) {
                $('#mod_content').html(response);
                $('#addProdMod').modal('open');
                
            }
        });
      });
/*
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
            $('#resultfil').html(response);
           
            
        }
    });
  });*/

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

    <script>
    $(document).ready(function (e) {
      
 $("#form").on('submit',(function(e) {
   alert("pressed");
  var something =$('#uploadImage').val();
 
  e.preventDefault();
  $.ajax({
         url: "ajaxupload.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
    //$("#preview").fadeOut();
    $("#err").fadeOut();
   },
   success: function(data)
   $('#err').html(data);
      {
    if(data=='invalid')
    {
     // invalid file format.
     $("#err").html("Invalid File !").fadeIn();
    }
    else
    {
     // view uploaded file.
     $("#preview").html(data).fadeIn();
     $("#form")[0].reset(); 
    }
      },
     error: function(e) 
      {
    $("#err").html(e).fadeIn();
      }          
    });
 }));
});
    
    
    </script>

</body>

</html> 