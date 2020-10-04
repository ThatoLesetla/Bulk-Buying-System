<?php
session_start();

include '../connect.php';
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

include '../errors.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Bulk Store</title>
	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Electronic Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	SmartPhone Compatible web template, free web designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //for-mobile-apps -->
	<!-- Custom Theme files -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/fasthover.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../script/dataTables/media/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<!-- //Custom Theme files -->
	<!-- font-awesome icons -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //font-awesome icons -->
	<!-- js -->
	<script src="js/jquery.min.js"></script>
	<link rel="stylesheet" href="css/jquery.countdown.css" /> <!-- countdown -->
	<!-- //js -->
	<!-- web fonts -->
	<link href='//fonts.googleapis.com/css?family=Glegoo:400,700' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<!-- //web fonts -->
	<!-- start-smooth-scrolling -->
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- //end-smooth-scrolling -->
</head>

<body>
	<!-- for bootstrap working -->
	<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
	<!-- //for bootstrap working -->
	<!-- header modal -->
	<?php include '_header.php' ?>
	<!-- //banner -->
	<!-- breadcrumbs -->
	<div class="breadcrumb_dress">
		<div class="container">
			<ul>
				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
				<li>Orders & Invoices</li>
			</ul>
		</div>
	</div>
	<!-- //breadcrumbs -->
	<!-- Orders & Invoices -->
	<div class="typo codes">
		<div class="container">
			<h3 class="agileits-title">Orders & Invoices</h3>
			<div class="grid_3 grid_4">
				<h3 class="w3ls-hdg">Orders</h3>
				<div class="bs-example w3layouts">
					<table class="table" id="orderTable">
						<thead>
							<tr>
								<th>Order ID</th>
								<th>Product Name </th>
								<th>Order Status </th>
								<th>Discount</th>
								<th>Price</th>
								<th>Total Amount</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$query = "SELECT * FROM bulk_order b, order_items o, product p WHERE b.id = o.orderId AND o.productId = p.productID AND b.customerID = '$id'";
							$result = mysqli_query($db, $query);

							if ($result) {
								if (mysqli_num_rows($result) > 0) {
									while ($row = mysqli_fetch_array($result)) {
										$discountPrice = $row['discountPrice'];
										$orderFilled = $row['orderFilled'];
										$orderId = $row['orderId'];
										$productName = $row['productName'];
										$productPrice = $row['productPrice'];
										$item_id = $row['item_id'];

										if ($orderFilled == true) {
											$status = "Complete";
											$invoiceBtn = "btn btn-primary";
										} else {
											$status = "Processing";
											$invoiceBtn = "btn btn-primary disable";
										}
										?>
										<tr>
											<td><?php echo $orderId ?></td>
											<td>
												<h4 id="h3.-bootstrap-heading"><?php echo $productName ?><a class="anchorjs-link" href="#h3.-bootstrap-heading"><span class="anchorjs-icon"></span></a></h4>
											</td>
											<td><?php echo $status ?></td>
											<td class="type-info w3l"><?php if($discountPrice == 0) {
												echo $discountPrice;
											} else {
												echo $productPrice - $discountPrice;
											}?></td>
											<td class="type-info w3l"><?php echo $productPrice ?></td>
											<td class="type-info w3l"><?php echo $discountPrice ?></td>
											<?php 
												if($status == "Complete")
												{ ?>
													<td><a href="invoice.php?item_id=<?php echo $item_id ?>" class="btn btn-info">View Invoice</a></td> <?php
												} else { ?>
													<td><button class="btn btn-success" onclick="alert(\'Order is still in progress\')">View Invoice</button></td><?php
												}
											?>
										</tr>
							<?php
									}
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>


		</div>
	</div>
	<!-- //Orders & Invoices -->
	<!-- newsletter -->
	<div class="newsletter">
		<div class="container">
			<div class="col-md-6 w3agile_newsletter_left">
				<h3>Newsletter</h3>
				<p>Subscribe to our newsletter and receive massive discounts</p>
			</div>
			<div class="col-md-6 w3agile_newsletter_right">
				<form action="#" method="post">
					<input type="email" name="Email" placeholder="Email" required="">
					<input type="submit" value="" />
				</form>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //newsletter -->
	<!-- footer -->
	<?php include("_footer.php"); ?>
	<!-- //footer -->
	<!-- cart-js -->
	<script src="js/minicart.js"></script>
	<script>
		w3ls.render();

		w3ls.cart.on('w3sb_checkout', function(evt) {
			var items, len, i;

			if (this.subtotal() > 0) {
				items = this.items();

				for (i = 0, len = items.length; i < len; i++) {}
			}
		});
	</script>
	<!-- //cart-js -->

	<script src="../script/dataTables/media/js/jquery.dataTables.min.js"></script>
	<script src="../script/dataTables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
	<script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
	<script>
		//$('#productTable').dataTable();

		$(document).ready(function() {
			$('#orderTable').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			});
		});
	</script>
</body>

</html>