<?php

include '../connect.php';

$total = $_POST['total'];
$paymentType = $_POST['paymentType'];
$customerID = $_POST['customerID'];
$orderDate = $_POST['orderDate'];
$id="";
$flag=0;
//echo($total . $paymentType. $customerID. $orderDate);

$query = "INSERT INTO bulk_order(customerId, orderDate, total, paymentType, orderFilled) VALUES ('$customerID', '$orderDate', '$total', '$paymentType', 0)";
$result = mysqli_query($db, $query);





    if($result)
    {
    
    $q = "SELECT * FROM `bulk_order` WHERE `orderDate` like '$orderDate'";
    $qr = mysqli_query($db, $q);

    if ($qr) {
        
        if (mysqli_num_rows($qr) > 0) {
           
            while ($row = mysqli_fetch_array($qr)) {
                $id = $row['id'];
                $flag=1;
            }


            
        }
    }
   
    }

    if($flag==1)
    {
       
       echo("
        <script>
        var productAttributes = w3ls.cart.items();
        for (var i = 0; i < productAttributes.length; i++) {
				var product = productAttributes[i]._data;
				var quantity = product.quantity;
                var orderID = '$id';
                var productID= product.productID;
				console.log(product.productID);
				$.ajax({
					type: 'POST',
					url: 'addOrderItems.php',
					data: {
						quantity: quantity,
                        orderID: orderID,
                        productID:productID
					},

					success: function(response) {
                        $('#after').html(response);
                        alert('java');
					}
                });
            }

                
        </script>
       ");
       
       
       
       
       
    }
    



?>