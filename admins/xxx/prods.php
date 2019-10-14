<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>blind System</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/datepicker.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<div class="container">

<div class="row">
<div id="feedback">

</div>
<span class="title">
<h2 class="white-text">
<div class="card-panel" style="width: 76rem;"></div>    
</h2>
<div>
<a href="#">

    <div class="input-field col s3">
        <input  id="srcBy" type="text" class="validate">
        <label class="active" for="srcBy" >Filter by Product Name...</label>
        </div>
        </a> 
                

    </div>

<div>
<a href="#">

<div class="input-field col s3">
        <input  id="expDate" type="text" class="datepicker" class="validate">
      <label class="active" for="expDate" >Filter by Prodect Exp date...</label>
    </div>
    </a> 
            

</div>


<div>
<a href="#">

<form >
<div class="input-field col s3">
<label for="formControlRange">Filter by Prodect Price...</label>    
<input type="range" class="form-control-range" id="formControlRange" value="0" max="500000" step="10">

</div>


</form>
    </a> 
            

</div>






</span><br>
<button type="button"  class="btn btn-danger" id="deleteS" >Delete Checked Product</button>
<div id="listed">
<table>
        <thead>
          <tr>
          <th>
                <label>
                    <input id="all_checked" type="checkbox" class="filled-in" />
                    <span>Check All</span>
                </label>
            </th>
              <th>No</th>
              <th>Products Name</th>
              <th>Products Description</th>
              <th>Products Updated date</th>
              <th>Products Price</th>
              <th>Delete/Update</th>
          </tr>
        </thead>
        <tbody>
          
<?php
include('connect.php');
$number = 0;
$query = 'SELECT * FROM `product`';
$result = mysqli_query($db, $query);

if ($result) {
    ?>
  <tr>
  <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <td>
      <label>
        <input class="check_item" type="checkbox" class="filled-in" value="<?php echo $row['categoryCode']; ?>" />
        <span></span>
      </label>
     
</td>
 <td>
 <?php
  echo $number = $number + 1; ?>
</td>

<td>
<?php
 echo  $row['productName']; ?>   
</td>

<td>
<?php
 echo  $row['productDescription']; ?>   
</td>

<td>
<?php
 echo  $row['updated']; ?>   
</td>

<td>
<?php
 echo  $row['productPrice']; ?>   
</td>

<td>

<button  id="updPrd" class="lighten-2 waves-effect waves-light btn" onclick=" moses('<?php echo $row['productCode']; ?>')" >Update</button>
<button  id="dltPrd" class="lighten-2 waves-effect waves-light-red btn" onclick=" moses2('<?php echo $row['productCode']; ?>')">Delete</button>
</td>
</tr>   
<?php
        }
    } ?>
    
    </tbody>
    </table>
    
    <?php
}
if (mysqli_num_rows($result) == 0) {
    ?>
    <h4>Empty Products</h4>
    <?php
}
?>
 </div>       
            
            
   


</div>

</div>




















<!-- RIGHT SIDEBAR	 -->
<ul id="sidenav-2" class="sidenav">    
	<li>
    <div class="user-view">
    <div class="background"></div>
    <p>
    <h5 class="white-text">
    <?php
        echo $surname.' '.substr($name, 0, 1);
        ?>   
    </h5>
    </p>
    <h6  class="white-text">
    <?php
        echo $email;
        ?> 
    </h6><br>
    </div>
    </li>
	<li><a class="subheader">DashBoard</a></li>
	<li>
    <div class="divider"></div>
    </li>
    <li><a id="add" href="#" data-target="sidenav-1" class="sidenav-trigger"><i id="drps" class="fas fa-plus-square"></i>Add Product</a></li>
    <li><a href="logout.php"><i class="fas fa-sign-in-alt"></i>logout</a></li>
    <li><a href="adim.php"><i class="fas fa-home-alt"></i>home</a></li>

</ul>



<!-- add Category SIDEBAR	 -->
<ul id="sidenav-1" class="sidenav" style="width:50%">    
<div class="container">
    <h4>Add Products</h4>
    <div class="divider"></div>
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="input-field">
            <input id="pname" type="text" class="validate">
            <label for="pname">Enter Product Name</label>
        </div>

        <div class="input-field">
            <input id="pcat" type="text" class="validate">
            <label for="pcat">Enter Product Category</label>
        </div>

        <div class="input-field">
            <input id="prodDes" type="text" class="validate">
            <label for="prodDes">Enter Product Description</label>
        </div>

        <div class="input-field">
            
            <input  id="expDate1" type="text" class="datepicker" class="validate">
            <label class="active" for="expDate1">Enter Expiry Date</label>
        </div>

        <div class="input-field">
            <input id="prodPrice" type="text" class="validate">
            <label for="prodPrice">Enter Product Price</label>
        </div>


        <div id="result"></div>
        <div class="input-field">
            <button type="submit" name="submit"  id="addp" class="lighten-2 waves-effect waves-teal lighten-2 btn" >Add Product</button>
           
        </div>
    </form>
   
</div>
	
</ul>

<!-- update Category SIDEBAR	 -->
<ul id="sidenav-3" class="sidenav" style="width:50%">    
<div class="container">
    <h4>Update Products</h4>
    <div class="divider"></div>
   <!--nav content-->
   <span id="nav_content">
    

  
   </span>
  
</div>
	
</ul>


    <script src="script/jquery.min.js"></script>
    <script src="script/materialize.min.js"></script>
    <script src="script/fontawesome.min.js"></script>
    <script src="script/all.min.js"></script>
    <script src="script/wow.min.js"></script>
   

<script>
$(document).ready(function() {



    $('#deleteS').slideUp();
    
    $("#all_checked").on('change',function(){
    $('.check_item').prop("checked",$(this).prop("checked"));
    $('#deleteS').slideDown();
});

$(".check_item").on('change',function(){
  
    $('#deleteS').slideDown();
});



$('#deleteS').click(function () {
  var ids =$('.check_item:checked').map(function () {
        return $(this).val();
  }).get().join(' '); 

if(ids !== null && ids !=='')
{
    
    //$.post('deleteSelectedProd.php?p=del', {ids :ids}, function(data){page();});
    $.ajax({
    url:'checkDel_P.php',
    type:'POST',
    data:{
        ids:ids,
    },
    success: function(data) {
        $("#feedback").html(data);  
    }
});
}else{
    
    $.ajax({
    url:'respond.html',
    type:'POST',
    data:{
        ids:ids,
    },
    success: function(data) {
        $("#feedback").html(data);  
    }
}); 
}
  

});


$('.fixed-action-btn').floatingActionButton();

$('.sidenav').sidenav();
$('#sidenav-2').sidenav({edge:'left'});
$('#sidenav-1').sidenav({edge:'right'});
$('#sidenav-1').sidenav({edge:'right'});



$('.tabs').tabs();


$('.modal').modal();


new WOW().init();

var currYear = (new Date()).getFullYear();
                    $(".datepicker").datepicker({
                defaultDate: new Date(currYear,1,31),
                // setDefaultDate: new Date(2000,01,31),
                maxDate: new Date(currYear+5,12,31),
                yearRange: [2019, currYear+5],
                format: "yyyy/mm/dd"    
            });

$('#add').click(function(e) {
       
    $('#sidenav-2').sidenav('close');
   
    });
    
        $('#addp').click(function(e) {
            e.preventDefault();
           
            var pname = $('#pname').val();
            var prodDes=$('#prodDes').val();
            var expDate1 =$('#expDate1').val();
            var prodPrice=$('#prodPrice').val();
            var pcat=$('#pcat').val();
          
            $.ajax({
                type: "post",
                url: "addProd.php",
                data: {
                  pname:pname,
                  pcat:pcat,
                  prodDes:prodDes,
                  expDate1:expDate1,
                  prodPrice:prodPrice
                },
                success: function(response) {
                    $('#result').html(response);
                }
            });
    
    });

    $("#srcBy").on('change',function(){
    var value=$(this).val();
    var cell ="<?php echo $id; ?>";
    var val = $('#formControlRange').val();
    var date =$('#expDate').val();

    //var date =$('#bdate').val(); 
    
        $.ajax({
        url:'srcProd.php',
        type:'POST',
        data:{
            value:value,
            val:val,
            date:date,
        },
        beforeSend:function(){
            $("#listed").html('Filtering...');
        },
        success:function(data)
        {
            $("#listed").html(data);
        },
    });
});  

$("#expDate").on('change',function(){
    var value=$(this).val();
    var cell ="<?php echo $id; ?>";
    var val = $('#formControlRange').val();
    var date =$('#expDate').val();
    

    //var date =$('#bdate').val(); 
    
        $.ajax({
        url:'srcProddate.php',
        type:'POST',
        data:{
            value:value,
            val:val,
            date:date,
        },
        beforeSend:function(){
            $("#listed").html('Filtering...');
        },
        success:function(data)
        {
            $("#listed").html(data);
        },
    });
});

$("#formControlRange").on('change',function(){
    var value=$(this).val();
    var cell ="<?php echo $id; ?>";
    var val = $('#formControlRange').val();
    var date =$('#expDate').val();
    

    //var date =$('#bdate').val(); 
    
        $.ajax({
        url:'srcProdprice.php',
        type:'POST',
        data:{
            value:value,
            val:val,
            date:date,
        },
        beforeSend:function(){
            $("#listed").html('Filtering...');
        },
        success:function(data)
        {
            $("#listed").html(data);
        },
    });
});  

    
});

function moses(id) {

var id=id;

$.ajax({
    type:'post',
    url: "updateProd.php",
    data: {
        id:id,
        },
    success: function(response) {
        $('#nav_content').html(response);
        $('#sidenav-3').sidenav('open');
   
    }
});

}

function moses2(id) {

var idprod=id;
var updateP = confirm("Are you sure you want to delete product?");
if(updateP==true){
$.ajax({
type:'post',
url: "deleteProd.php",
data: {
    idprod:idprod,
},
success: function(response) {
$('#'+idcat).html(response);

}
});
}

}


</script>



</body>
</html>