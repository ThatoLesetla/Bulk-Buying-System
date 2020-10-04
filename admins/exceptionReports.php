<?php

session_start();
include 'connect.php';

if (empty($_SESSION['cell'])) {
    header('location:index.php');
} else {
    $cell = $_SESSION['cell'];

    $query = "SELECT * FROM administrator WHERE `cell` = '$cell'";
    $result = mysqli_query($db, $query);

    while ($row = mysqli_fetch_array($result)) {
        $userName = $row['surname'].' '.$row['name'];

        $email = $row['email'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/flexboxgrid.css" />
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/Style.css">

</head>

<body>
<div id="adm_mod" class="modal modal-fixed-footer valign-wrapper">
        <span id="mod_content" class="valign-wrapper" style="padding-top: 30px;width:100%;"></span>
    </div>
    <nav >
        <div class="nav-wrapper">
            <div class="container-fluid">
                <a href="admin.php" class="brand-logo">Sammury Reports</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="admin_dashboard.php"><i class="fa fa-angle-double-left"></i> Back</a></li>
                    <li><a href="logout_adm.php"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="container">
            <h4 id="admin"><?php echo $userName; ?></h4>
            <h6 class="grey-text"><i>admin</i></h6>
            <div class="divider"></div>
            <br>
            <!--Reports Nav-->
            <nav class="grey darken-4" id="bus_nav" style="border-bottom: #08acea medium solid; border-top: #08acea medium solid;">
                <div class="container-fluid">
                    <div class="nav-wrapper">
                        <ul id="nav-mobile" class="hide-on-med-and-down">
                            <li><a id="btn_Std">vendor Report</a></li>
                            <li><a id="btn_Staff">customer Report</a></li>
                            <li><a id="btn_Book">products Report</a></li>
                            
                            <li class="right blue-text text-lighten-2"><span id="show"></span></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <h4>
                <form action="">
                <div id="vendor_repot">
                <label>
                        <input id="typeOfSam" name="typeOfSam" type="radio" value="1" checked/>
                        <span>All</span>
                    </label>
                    <label>
                        <input id="typeOfSam" name="typeOfSam" type="radio" value="2"/>
                        <span>Week Sammury</span>
                    </label>
                    <label>
                        <input id="typeOfSam" name="typeOfSam" type="radio" value="3"/>
                        <span>1 Month Sammury</span>
                    </label>
                    <label>
                        <input id="typeOfSam" name="typeOfSam" type="radio" value="4"/>
                        <span>3 Months Samury</span>
                    </label>
                    <button class="btn blue lighten-2 waves-effect waves-dark eound-btn right" id="btn_print">Print Data</button>
                </div>
                <!--products-->
                <div id="products_reports">
                <button class="btn blue lighten-2 waves-effect waves-dark eound-btn right" id="btn_print">Print Data</button>
                <div class="container">
                <div class="row">
                
                <div class="input-field col s4">
                    <input  id="srcVendor" type="text" class="validate">
                    <label class="active" for="srcVendor">Search by Vendor Name...</label>
                    </div>
                    <div class="input-field col s4">
                        <input type=text name="bdate" id="bdate" class="datepicker" required>
                        <label for="bdate">Search by Date..</label>
                    </div>
                    <div class="input-field col s4">
                    <input  id="srcPrice" type="text" class="validate">
                    <label class="active" for="srcPrice">Search by Product Price(eg 100)...</label>
                    </div>
                    
                </div>
                </div>
                

                    
               
                
              
                </div>
                <!--customers-->
                <div id="cus_reports">
                <div class="input-field col s4">
                    <input  id="srcPro" type="text" class="validate">
                    <label class="active" for="srcPro">Search by Product Name...</label>
                    </div>
                <button class="btn blue lighten-2 waves-effect waves-dark eound-btn right" id="btn_print">Print Data</button>
                </div>
                   
                </form>
            </h4>

            <span id="content"></span>


        </div>
    </div>



    <!-- Scripts -->
    <script type="text/javascript" src="script/jquery.min.js"></script>
    <script type="text/javascript" src="script/materialize.min.js"></script>
    <script type="text/javascript" src="script/jquery.PrintArea.js"></script>

    <script>
    $('#vendor_repot').slideUp();
    $('#products_reports').slideUp();
    $('#cus_reports').slideUp();
    
        $(document).ready(function() {

            var currYear = (new Date()).getFullYear();
            //var month = (new Date()).getFullMonth();
                    $(".datepicker").datepicker({
                defaultDate: new Date(currYear,1,31),
                // setDefaultDate: new Date(2000,01,31),
                maxDate: new Date(currYear+5,12,31),
                yearRange: [2019, currYear],
                format: "yyyy/mm/dd"    
            });
            //Init Modal
            $('.modal').modal();

            //Students
            function stdSammury() { 
                var typeOfSam = $("input[name='typeOfSam']:checked").val();

                $.ajax({
                    type: "post",
                    url: "stdReport.php",
                    data: {typeOfSam: typeOfSam},
                    success: function (response) {
                        $('#content').html(response);
                    }
                });
                
            };

            //Saff
            function staffSammury() { 
                var typeOfSam = $("input[name='typeOfSam']:checked").val();

                $.ajax({
                    type: "post",
                    url: "staffReport.php",
                    data: {typeOfSam: typeOfSam},
                    success: function (response) {
                        $('#content').html(response);
                    }
                });
                
            };

            //Book
            function bookSammury() { 
                var typeOfSam = $("input[name='typeOfSam']:checked").val();

                $.ajax({
                    type: "post",
                    url: "busReport.php",
                    data: {typeOfSam: typeOfSam},
                    success: function (response) {
                        $('#content').html(response);
                    }
                });
                
            };

            //Book
            function busSammury() { 
                var typeOfSam = $("input[name='typeOfSam']:checked").val();

                $.ajax({
                    type: "post",
                    url: "busReport.php",
                    data: {typeOfSam: typeOfSam},
                    success: function (response) {
                        $('#content').html(response);
                    }
                });
                
            };

           // bookSammury();

           

            $('#btn_Std').click(function (e) { 
                e.preventDefault();
                $('#vendor_repot').slideDown();
                $('#products_reports').slideUp();
                $('#cus_reports').slideUp();
                
                stdSammury();
            })

            $('#btn_Staff').click(function (e) { 
                e.preventDefault();
                staffSammury();
            });

            $('#btn_Book').click(function (e) { 
                e.preventDefault();
                $('#vendor_repot').slideUp();
                $('#products_reports').slideDown();
                $('#cus_reports').slideUp();
                bookSammury();
            });

            $('#btn_Bus').click(function (e) { 
                e.preventDefault();
                busSammury();
            });
            
            


            //Filter Results
            $("input[name='typeOfSam']").change(function (e) { 
                e.preventDefault();
                

                if ($('#show').html() == "Student Sammury") {
                    stdSammury();
                }
                
                if ($('#show').html() == "Staff Sammury") {
                    staffSammury();
                }

                if ($('#show').html() == "Booking Sammury") {
                    bookSammury();
                }
            });

            //Print
            $('#btn_print').click(function(e) {
                e.preventDefault();
                var mode = 'iframe';
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };

                $('#content').printArea(options);
            });
            
        });
    </script>
    <script>
$(document).ready(function() {



    

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