<?php
include 'connect.php';
$id = $_POST['pID'];
$name = ' ';
$price = ' ';
$des = ' ';
$daytime = date('d l M Y H:i:s');
$q = "SELECT * FROM product WHERE `productID`='$id'";
$r = mysqli_query($db, $q);

if ($r) {
    while ($row = mysqli_fetch_array($r)) {
        $name = $row['productName'];
        $price = $row['productPrice'];
        $des = $row['productDescription'];
    }
}
?>
<div class="container">
        <h4>Update Product</h4>
        <div class="divider"></div>
        <form action="" method="POST" enctype="multipart/form-data">

                <div class="input-field">
                <input value="<?php echo $name; ?>" id="name" type="text" class="validate">
                <label class="active" for="name">Product Name</label>
                </div>

            <div class="input-field">
                <input id="price" type="number" class="validate" value="<?php echo $price; ?>">
                <label class="active" for="price">Product Price</label>
            </div>
            <div class="input-field">
                <input id="des" type="text" class="validate"  value="<?php echo $des; ?>">
                <label class="active" for="des">Product Description</label>
            </div>
           
            
    </form>
            
            </div>

            </div>
        
            
           <!-- <button type="submit" name="submit" id="submrk" class="lighten-2 waves-effect waves-light btn">Upload</button> -->
    
            <div id="result"></div>
                    <div class="row">
                    <div class="input-field">
                <button name="submit"  id="upProd" class="lighten-2 waves-effect waves-light btn" >Update</button>
               
            </div>
            <div class="input-field">
            <button   id="upCancel" class="lighten-2 waves-effect waves-light btn">Cancel</button>
            </div>
                    </div>
            

        </form>
    </div>
    
    <script async="true">
      
      
      
        $(document).ready(function(){
            M.updateTextFields();

            $("#but_upload").click(function(){
                
                var fd = new FormData();
                var files = $('#file')[0].files[0];
                var fill= "<?php echo $_POST['pID']; ?>"
                fd.append('file',files,);
               
               
                $.ajax({
                    url: 'prodpic.php',
                    type: 'post',
                    data:
                    fd,
                    contentType: false,
                    processData: false,
                    
                    success: function(response){
                        if(response != 0){
                            $("#img").attr("src",response); 
                            $(".preview img").show(); // Display image element
                            $('#result').html(response);
                        }else{
                            alert('file not uploaded');
                        }
                    },
                });

});

    
            $('#upProd').click(function(e) {
                e.preventDefault();

              
                var proID ="<?php echo $_POST['pID']; ?>";
                var name = $('#name').val();
                var price = $('#price').val();
                var des = $('#des').val();
                var updateP = confirm("you want to update product?");
                if(updateP==true)
                {
                    
                    $.ajax({
                        type: "post",
                        url: "updateProdCpu.php",
                        data: {
                        name:name,
                          price:price,
                          des: des,
                          proID:proID
                         
                        },
                        success: function(response) {
                            $('#result').html(response);
                        }
                    });
                }
              
        
        });
            });
    
        
    
    </script>