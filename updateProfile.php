<?php
include 'connect.php';
$errors = array();

$id=$_POST['id'];
$name=" ";
$phone=" ";
$address=" ";
$email=" ";
$city=" ";

$q="SELECT * FROM `vendor` WHERE `vendorID` ='$id'";
$r=mysqli_query($db, $q);

if($r)
{
    if (mysqli_num_rows($r) > 0) {
        while ($row = mysqli_fetch_array($r)) {
            $name = $row['name'];
            $phone=$row['phone'];
            $address=$row['address'];
            $email = $row['email'];
            $city=$row['city'];
            
        }
    }
}else{

}



?>
<div class="container">
        <h4 id="first_h">Update Profile</h4>
        <div class="divider"></div>
        <form action="" method="POST" enctype="multipart/form-data">

        <div class="input-field">
                <input id="name" type="text" class="validate" value="<?php echo($name)?>">
                <label  class="active" for="name">Enter Name</label>
            </div>
    
            <div class="input-field">
                <input id="phone" type="number" class="validate"  value="<?php echo($phone)?>">
                <label  class="active" for="phone">Enter Contact No</label>
            </div>
            <div class="input-field">
                <input id="email" type="email" class="validate"  value="<?php echo($email)?>">
                <label  class="active" for="email">Enter email</label>
            </div>
            <div class="input-field">
                <input id="address" type="text" class="validate"  value="<?php echo($address)?>">
                <label  class="active" for="address">Enter Address</label>
            </div>

            <div class="input-field">
                <input id="city" type="text" class="validate"  value="<?php echo($city)?>">
                <label  class="active" for="city">Enter city</label>
            </div>

           <!-- <button type="submit" name="submit" id="submrk" class="lighten-2 waves-effect waves-light btn">Upload</button> -->
    
            <div id="result"></div>
           
            <button   id="upCancel" class="lighten-2 waves-effect waves-light btn">Cancel</button>
            <button   id="upProf" class="lighten-2 waves-effect waves-light btn">update</button>
            
        </form>
    </div>
    
    <script async="true">
      
      

        $(document).ready(function(){
           
    
            $('#upProf').click(function(e) {
                e.preventDefault();

              
                var phone =$('#phone').val();
                var name =$('#name').val();
                var address = $('#address').val();
                var city = $('#city').val();
                var email =$('#email').val();
                var updateP = confirm("you want to update profile?");
                if(updateP==true)
                {
                    
                    $.ajax({
                        type: "post",
                        url: "profCpu.php",
                        data: {
                            name:name,
                            phone:phone,
                            address: address,
                            city:city,
                            email:email
                         
                        },
                        success: function(response) {
                            $('#result').html(response);
                        }
                    });
                }
              
        
        });
            });
    
        
    
    </script>