<?php
session_start();

include 'connect.php';
$errors = array();
$id = '';
if (empty($_SESSION['phone'])) {
    unset($_SESSION['phone']);
    session_abort();
    header('location: login.php');
} else {
    $cell = $_SESSION['phone'];
    $name = ' ';
    $surname = ' ';

    $query = "SELECT * FROM vendor WHERE `email` = '$cell'";
    $result = mysqli_query($db, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $name = $row['name'];
                $surname = $row['surname'];
                $id = $row['vendorID'];
            }
        }
    }
}
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
 

  
 
</style>

<body>
<nav class="nav-extended">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo"><i class="">Bulk Buying System</i></a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <a href="vendor.php" data-target="sidenav-2" class="right sidenav-trigger show-on-medium-and-up"></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="logout.php">Logout</a></li>
        <li><a href="vendor.php">Home</a></li>
      </ul>
    </div>

  </nav>
  <ul class="sidenav" id="mobile-demo">
    <li><a href="sass.html">Sass</a></li>
    <li><a href="badges.html">Components</a></li>
    <li><a href="collapsible.html">JavaScript</a></li>
  </ul>
<div class="container">

<span class="title">

<h2>My Products</h2>
</span><br>
<div class="row">
    <div class="input-field col s4">
      <input  id="srcBy" type="text" class="validate">
      <label class="active" for="srcBy">Search by Name...</label>
    </div>
    <div class="input-field col s4">
            <input type=text name="bdate" id="bdate" class="datepicker" required>
            <label for="bdate">Search by Date..</label>
          </div>
    <div class="switch">
    <label>
      not checked
      <input type="checkbox" id="alls" onclick="alls()">
      <span class="lever"></span>
      all checked
    </label>
  </div>
  <a class="btn-floating" id="selectedBox">Delete Selected</a>
  </div>
 
<ul class="collection" id="prodsList">
<?php

include 'connect.php';
$cell = $_SESSION['phone'];
//$prodsTitle = $_POST['prodsTitle'];

$id = '';
$query = "SELECT * FROM vendor WHERE `phone` = '$cell'";
$result = mysqli_query($db, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $name = $row['name'];
                //$surname = $row['surname'];
                $id = $row['vendorID'];
            }
        }
    }

$query = "SELECT *
FROM vendor v, inventory i, product p 
WHERE v.vendorID = i.vendorID 
AND i.productID = p.productID 
AND v.vendorID = '$id'";
$result = mysqli_query($db, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                //name updated des

                $name = $row['productName'];
                $updated = $row['updated'];
                $des = $row['productDescription'];
                $price = $row['productPrice']; ?>

                <div>
                
               
                    <li id="<?php
                        echo $row['productID']; ?>" class="collection-item avatar">
                        <img src="products/<?php echo $row['proimg']; ?>" alt="" class="circle"

                        >
                        <span class="title">
                        <?php
                        echo $name; ?>
                        </span>

                        <p>
                         R   
                        <?php
                        echo number_format($price, 2); ?>
                        <br>   
                        <?php
                        echo $des; ?>
                        <br>
                        <i>updated </i>: 
                        <?php
                        echo $updated; ?>
                        </p>
                        <div class="row">
                        <button  id="updPrd" class="lighten-2 waves-effect waves-light btn" onclick=" moses('<?php echo $row['productID']; ?>')" >Update</button>
                        <button  id="dltPrd" class="lighten-2 waves-effect waves-light btn" onclick=" moses2('<?php echo $row['productID']; ?>')">Delete</button>
                        </div>
                        <form id="form" action="prodpic.php" method="post" enctype="multipart/form-data"> 
                        <input type="number" class="form-control" id="email" name="email" placeholder="Enter email" hidden value="<?php echo $row['productID']; ?>" />
                        <input id="uploadImage" type="file" accept="image/*" name="image" />
                        
<input class="btn btn-success" type="submit" value="Upload Picture"onclick="pic('<?php echo $row['productID']; ?>')">
                        </form>
                        <div id="err"></div>
                        <a class="secondary-content" >
                                
                                <label>
                                    <input class="item" type="checkbox" onclick="tick()" value="<?php echo $row['productID']; ?>">
                                    <span></span>
                                </label>
                        </a>
                    </li>

            <?php
            }
        } else {
            ?>
            <h4><i>No Products Added</i></h4>
            <?php
        }
    } else {
        echo 'query ddnt read';
    }

?>

</ul>

</div>

<div id="addProdMod" class="modal modal-fixed-footer valign-wrapper" style="">

        <span id="mod_content" class="valign-wrapper" style="padding-top: 20px;"></span>
</div>

<div class="fixed-action-btn wow fadeIn" data-wow-delay="1s">
  <button id="addProds" class="btn-floating btn-large red darken-4 waves-effect waves-dark">
  <i class="large fa fa-plus"></i>
  </button>
  </div>


  
  <script src="script/jquery.min.js"></script>
    <script src="script/materialize.min.js"></script>
    <script src="script/fontawesome.min.js"></script>
    <script src="script/all.min.js"></script>
    <script src="script/wow.min.js"></script>       
<script>
$(document).ready(function() {
        $('.sidenav').sidenav();   
        $('.modal').modal();
        var currYear = (new Date()).getFullYear();
                    $(".datepicker").datepicker({
                defaultDate: new Date(currYear,1,31),
                // setDefaultDate: new Date(2000,01,31),
                maxDate: new Date(currYear+5,12,31),
                yearRange: [2019, currYear],
                format: "yyyy/mm/dd"    
            });
                    
$("#srcBy").on('change',function(){
    var value=$(this).val();
    var cell ="<?php echo $cell; ?>";
    var date =$('#bdate').val(); 
    
    $.ajax({
        url:'srcprod.php',
        type:'POST',
        data:{
            value:value,
            cell:cell,
            date:date

        },
        beforeSend:function(){
            $("#prodsList").html('Loading...');
        },
        success:function(data)
        {
            $("#prodsList").html(data);
        },
    });
});


$("#bdate").on('change',function(){
    var value=$(this).val();
    var cell ="<?php echo $cell; ?>";
    var date =$('#bdate').val(); 
    
    $.ajax({
        url:'prodByDate.php',
        type:'POST',
        data:{
            value:value,
            cell:cell,
            date:date

        },
        beforeSend:function(){
            $("#prodsList").html('Loading...');
        },
        success:function(data)
        {
            $("#prodsList").html(data);
        },
    });
});






$('#addProds').click(function() {
    
    $.ajax({
        url: "addPros.html",
        success: function(response) {
            $('#mod_content').html(response);
            $('#addProdMod').modal('open');
            
        }
    });
});

});


//functions
function moses(id) {

                var pID=id;
               // alert(id)
                $.ajax({
                    type:'post',
                    url: "updateProd.php",
                    data: {
                        pID:pID,
                        },
                    success: function(response) {
                        $('#mod_content').html(response);
                        $('#addProdMod').modal('open');
                    }
                });
          
}

function moses2(idd) {

var pID=idd;
var updateP = confirm("Are you sure you want to delete product?");
if(updateP==true){
$.ajax({
    type:'post',
    url: "delProd.php",
    data: {
        pID:pID,
        },
    success: function(response) {
        $('#'+idd).html(response);
       
    }
});
}

}
$("#alls").on('change',function(){
    $('.item').prop("checked",$(this).prop("checked"));
});

function alls() {
  

}
function page() {
    $.ajax({
    url:'deleteSelectedProd.php',
    type:'GET',
    success: function(data) {
        $("#prodsList").html(data);  
    }
});
}

$('#selectedBox').click(function () {
  var ids =$('.item:checked').map(function () {
        return $(this).val();
  }).get().join(' '); 

if(ids !== null && ids !=='')
{
   
    //$.post('deleteSelectedProd.php?p=del', {ids :ids}, function(data){page();});
    $.ajax({
    url:'deleteSelectedProd.php',
    type:'POST',
    data:{
        ids:ids,
    },
    success: function(data) {
        $("#prodsList").html(data);  
    }
});
}else{
   
    //page();
    
    alert("Nothing Checked...");
  
}
  

});

</script>

<script>
    $(document).ready(function (e) {
 
$("#form").on('submit',(function(e) {
        e.preventDefault();
  $.ajax({
    url: "prodpic.php",
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