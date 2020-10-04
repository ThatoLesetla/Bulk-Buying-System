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
				$surname = $row['surname'];
				$city = $row['city'];
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
	<title>Bulk Buying | Checkout</title>
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
	<link href="css/core-style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- //Custom Theme files -->
	<!-- font-awesome icons -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //font-awesome icons -->
	<!-- js -->
	<script src="js/jquery.min.js"></script>
	<!-- //js -->
	<!-- web fonts -->
	<link href='//fonts.googleapis.com/css?family=Glegoo:400,700' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<!-- //web fonts -->
	<!-- for bootstrap working -->
	<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
	<!-- //for bootstrap working -->
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
	<!-- header modal -->
	<div class="modal fade" id="myModal88" tabindex="-1" role="dialog" aria-labelledby="myModal88" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;</button>
					<h4 class="modal-title" id="myModalLabel">Don't Wait, Login now!</h4>
				</div>
				<div class="modal-body modal-body-sub">
					<div class="row">
						<div class="col-md-8 modal_body_left modal_body_left1" style="border-right: 1px dotted #C2C2C2;padding-right:3em;">
							<div class="sap_tabs">
								<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
									<ul>
										<li class="resp-tab-item" aria-controls="tab_item-0"><span>Sign in</span></li>
										<li class="resp-tab-item" aria-controls="tab_item-1"><span>Sign up</span></li>
									</ul>
									<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
										<div class="facts">
											<div class="register">
												<form action="#" method="post">
													<input name="Email" placeholder="Email Address" type="text" required="">
													<input name="Password" placeholder="Password" type="password" required="">
													<div class="sign-up">
														<input type="submit" value="Sign in" />
													</div>
												</form>
											</div>
										</div>
									</div>
									<div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
										<div class="facts">
											<div class="register">
												<form action="#" method="post">
													<input placeholder="Name" name="Name" type="text" required="">
													<input placeholder="Email Address" name="Email" type="email" required="">
													<input placeholder="Password" name="Password" type="password" required="">
													<input placeholder="Confirm Password" name="Password" type="password" required="">
													<div class="sign-up">
														<input type="submit" value="Create Account" />
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
							<script type="text/javascript">
								$(document).ready(function() {
									$('#horizontalTab').easyResponsiveTabs({
										type: 'default', //Types: default, vertical, accordion           
										width: 'auto', //auto or any width like 600px
										fit: true // 100% fit in a container
									});
								});
							</script>
							<div id="OR" class="hidden-xs">OR</div>
						</div>
						<div class="col-md-4 modal_body_right modal_body_right1">
							<div class="row text-center sign-with">
								<div class="col-md-12">
									<h3 class="other-nw">Sign in with</h3>
								</div>
								<div class="col-md-12">
									<ul class="social">
										<li class="social_facebook"><a href="#" class="entypo-facebook"></a></li>
										<li class="social_dribbble"><a href="#" class="entypo-dribbble"></a></li>
										<li class="social_twitter"><a href="#" class="entypo-twitter"></a></li>
										<li class="social_behance"><a href="#" class="entypo-behance"></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- header modal -->
	<!-- header -->
	<?php include '_header.php' ?>
	<!-- //banner -->

	<!-- checkout form -->
	<!-- ****** Checkout Area Start ****** -->
	<div class="checkout_area section_padding_100">
		<div class="container">
			<div class="row">

				<div class="col-12 col-md-6">
					<div class="checkout_details_area mt-50 clearfix">

						<div class="cart-page-heading">
							<h5>Billing Address</h5>

						</div>

						<form action="#" method="post">
							<div class="row">
								<div class="col-12 mb-3">
									<label for="first_name">First Name <span>*</span></label>
									<input type="text" value="<?php echo $name ?>" class="form-control" id="first_name" value="" required>
								</div>
								<div class="col-12 mb-3">
									<label for="last_name">Last Name <span>*</span></label>
									<input type="text" class="form-control" id="last_name" value="<?php echo $surname ?>" required>
								</div>

								<div class="col-12 mb-3">
									<label for="city">Town/City <span>*</span></label>
									<input type="text" value="<?php echo $city ?>" class="form-control" id="city" value="">
								</div>
								<div class="col-12 mb-3">
									<label for="phone_number">Phone No <span>*</span></label>
									<input type="number" class="form-control" value=<?php echo $cell ?> id="phone_number" min="0" value="">
								</div>
								<div class="col-12 mb-4">
									<label for="email_address">Email Address <span>*</span></label>
									<input type="email" class="form-control" value="<?php echo $email ?>" id="email_address" value="">
								</div>

								<div class="col-12" style="margin-top: 20px;">
									<div class="custom-control custom-checkbox d-block mb-2">
										<input type="checkbox" class="custom-control-input" id="customCheck1">
										<label class="custom-control-label" for="customCheck1">Terms and conitions</label>
									</div>
									<div class="custom-control custom-checkbox d-block mb-2">
										<input type="checkbox" class="custom-control-input" id="customCheck2">
										<label class="custom-control-label" for="customCheck2">Create an accout</label>
									</div>
									<div class="custom-control custom-checkbox d-block">
										<input type="checkbox" class="custom-control-input" id="customCheck3">
										<label class="custom-control-label" for="customCheck3">Subscribe to our newsletter</label>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="col-12 col-md-6 col-lg-5 ml-lg-auto" style="padding-left: 55px;">
					<div class="order-details-confirmation">

						<div class="cart-page-heading">
							<h5>Your Order</h5>
							<p>The Details</p>
						</div>

						<ul class="order-details-form mb-4" id="orderList">
							<li><span>Product</span> <span>Total</span></li>
							<li><span>Shipping</span> <span>Free</span></li>
							<li><span>Total</span> <span id="cartTotal"></span></li>
						</ul>


						<div id="accordion" role="tablist" class="mb-4">
							<div class="card">
								<div class="card-header" role="tab" id="headingOne">
									<h6 class="mb-0">
										<a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><i class="fa fa-circle-o mr-3"></i>Paypal</a>
									</h6>
								</div>

								<div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
									<div class="card-body">
										<p></p>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-header" role="tab" id="headingTwo">
									<h6 class="mb-0">
										<a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-circle-o mr-3"></i>cash on delievery</a>
									</h6>
								</div>
								<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
									<div class="card-body">
										<p></p>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-header" role="tab" id="headingThree">
									<h6 class="mb-0">
										<a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-circle-o mr-3"></i>credit card</a>
									</h6>
								</div>
								<div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
									<div class="card-body">
										<p></p>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-header" role="tab" id="headingFour">
									<h6 class="mb-0">
										<a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour"><i class="fa fa-circle-o mr-3"></i>direct bank transfer</a>
									</h6>
								</div>
								<div id="collapseFour" class="collapse show" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
									<div class="card-body">
										<p></p>
									</div>
								</div>
							</div>
						</div>
						<div id="after"></div>
						</br>
						<a href="#!" id="placeOrder" class="btn karl-checkout-btn">Place Order</a>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- ****** Checkout Area End ****** -->

	<!-- Checkout form -->

	<!-- //short-codes -->
	<!-- newsletter -->
	<div class="newsletter">
		<div class="container">
			<div class="col-md-6 w3agile_newsletter_left">
				<h3>Newsletter</h3>
				<p>Subscribe to our newsletter and get the best deals.</p>
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
	<?php include('_footer.php'); ?>
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
	<script>
		var order = document.getElementById('placeOrder');
		var total = w3ls.cart.total();
		document.getElementById('cartTotal').innerHTML = "R" + total.toString();
		order.addEventListener('click', placeOrder);

		function placeOrder() {

			var cartItems = w3ls.cart;

			var productAttributes = w3ls.cart.items();
			var customerID = "<?php echo $id; ?>";
			var paymentType = "EFT";
			var orderDate = new Date();

			$.ajax({
				type: "POST",
				url: "addToCart.php",
				data: {
					total: total,
					customerID: customerID,
					paymentType: paymentType,
					orderDate: orderDate
				},

				success: function(response) {
					$('#after').html(response);

				}
			});


			/*for (var i = 0; i < productAttributes.length; i++) {
				var product = productAttributes[i]._data;
				var quantity = product.quantity;
				var productID = product.productID;
				console.log(product);
				$.ajax({
					type: "POST",
					url: "addOrderItems.php",
					data: {
						quantity: quantity,
						orderDate: orderDate,
						productID: productID
					},

					success: function(response) {
						$('#after').html(response);
					}
				});
			}*/



			alert('Discount percentage will be sent out soon your order is still being processed.');
			//w3ls.cart.cartItems().
		
		

		}
	</script>
</body>

</html>