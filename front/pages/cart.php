<?php
session_start();
if (!isset($_SESSION["uId"])) {
	header("Location:../signIn/signIn.php");
} else {
?>

	<!DOCTYPE html>
	<html lang="zxx">

	<head>
		<title>The Plaza - eCommerce Template</title>
		<meta charset="UTF-8">
		<meta name="description" content="The Plaza eCommerce Template">
		<meta name="keywords" content="plaza, eCommerce, creative, html">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Favicon -->
		<link href="../assets/img/favicon.ico" rel="shortcut icon" />

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

		<!-- Stylesheets -->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../assets/css/owl.carousel.css" />
		<link rel="stylesheet" href="../assets/css/style.css" />
		<link rel="stylesheet" href="../assets/css/animate.css" />


		<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	</head>

	<body>
		<!-- Page Preloder -->
		<div id="preloder">
			<div class="loader"></div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="clearCartModal" tabindex="-1" role="dialog" aria-labelledby="clearCartModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="clearCartModalLabel">Clear Cart</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Do you want to clear your cart
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<a href="../../functions/cart/clearCart.php" class="btn btn-primary">Clear Cart</a>
					</div>
				</div>
			</div>
		</div>



		<!-- Page Info -->
		<div class="page-info-section page-info">
			<div class="container">
				<div class="site-breadcrumb">
					<a href="./index.php">Home</a> /
					<!-- <a href="">Sales</a> /
				<a href="">Bags</a> / -->
					<span>Cart</span>
				</div>
				<img src="../assets/img/page-info-art.png" alt="" class="page-info-art">
			</div>
		</div>
		<!-- Page Info end -->


		<!-- Page -->
		<div class="page-area cart-page spad">
			<form method="post" action="../../functions/cart/createOrder.php">
				<div class="container">
					<div class="cart-table">
						<table>
							<thead>
								<tr>
									<th class="product-th">Product</th>
									<th>Price</th>
									<th>Quantity</th>
									<th class="total-th">Total</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($_SESSION['cart'] as $cartItem) {
									$ProductFetch = "
								select 
								p.productName, 
								p.productDesc, 
								p.productShortDesc, 
								p.productId, 
								p.productAmount, 
								p.productImg, 
								c.catName as catName 
								from `product_db` as p 
								left join product_category_db as c on p.productCatId=c.catId 
								WHERE p.productId='" . $cartItem['id'] . "' and p.deleted=0;";
									require("../../functions/conn.php");
									$data = $connection->query($ProductFetch);
									if ($data) {
										while ($row = $data->fetch_assoc()) {
								?>
											<tr>
												<td class="product-col">
													<img src="<?php echo $row['productImg'] ?>" alt="">
													<div class="pc-title">
														<h4><?php echo $row['productName'] ?></h4>
														<a href="#"><?php echo $row['productDesc'] ?></a>
													</div>
												</td>

												<td class="price-col"><?php echo $row['productAmount'] ?></td>
												<td class="quy-col">
													<div class="quy-input">
														<span>Qty</span>
														<input type="number" name="<?php echo $row['productId'] ?>" min=0 value="<?php echo $cartItem['quantity'] ?>" onchange="totalForPro(this,`total-<?php echo $row['productId'] ?>`,`<?php echo $row['productAmount'] ?>`)">
													</div>
												</td>
												<td class="total-col" id="total-<?php echo $row['productId'] ?>">
													<?php echo $row['productAmount'] * $cartItem['quantity'] ?>
												</td>
											</tr>
								<?php
										}
									}
								}
								?>
							</tbody>
						</table>
					</div>
					<div class="row cart-buttons">
						<div class="col-lg-5 col-md-5">
							<a class="site-btn btn-continue" href="./index.php">Continue shooping</a>
						</div>
						<div class="col-lg-7 col-md-7 text-lg-right text-left">
							<button type="button" class="btn btn-primary site-btn btn-clear" data-toggle="modal" data-target="#clearCartModal">
								Clear cart
							</button>
							<!-- <butotn class="site-btn btn-line btn-update" onclick="">Place Order</button> -->
						</div>
					</div>
				</div>
				<div class="card-warp">
					<div class="container">
						<div class="row">
							<div class="col-lg-4">
								<div class="shipping-info">
									<h4>Shipping method</h4>
									<p>Select the one you want</p>
									<div class="shipping-chooes">
										<div class="sc-item">
											<input type="radio" name="sc" id="one">
											<label for="one">Next day delivery<span>$4.99</span></label>
										</div>
										<div class="sc-item">
											<input type="radio" name="sc" id="two">
											<label for="two">Standard delivery<span>$1.99</span></label>
										</div>
										<div class="sc-item">
											<input type="radio" name="sc" id="three">
											<label for="three">Personal Pickup<span>Free</span></label>
										</div>
									</div>
									<h4>Cupon code</h4>
									<p>Enter your cupone code</p>
									<div class="cupon-input">
										<input type="text">
										<button class="site-btn">Apply</button>
									</div>
								</div>
							</div>
							<div class="offset-lg-2 col-lg-6">
								<div class="cart-total-details">
									<h4>Cart total</h4>
									<p>Final Info</p>
									<ul class="cart-total-card">
										<li>Subtotal
											<span id="grandTotal">
												<?php echo isset($_SESSION['totalAmount']) ? $_SESSION['totalAmount'] : 0; ?>
											</span>
										</li>
										<li>Shipping<span>Free</span></li>
										<li class="total">Total<span id="grandTotalWithDel"><?php echo isset($_SESSION['totalAmount']) ? $_SESSION['totalAmount'] : 0; ?></span></li>
									</ul>
									<input type="Submit" value="Place Order" class="site-btn btn-full" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- Page end -->

		<?php
		require('../components/footer.php');
		?>

		<script>
			function totalForPro(comp, id, total) {
				document.getElementById(id).innerHTML = `${comp.value * total}`;
				document.getElementById('grandTotal').innerHTML = 0
				document.getElementById('grandTotalWithDel').innerHTML = 0
				Array.from(document.getElementsByClassName('total-col')).map((e) => {
					document.getElementById('grandTotal').innerHTML = `${parseInt(document.getElementById('grandTotal').innerHTML)+parseInt(e.innerHTML)}`
					document.getElementById('grandTotalWithDel').innerHTML = `${parseInt(document.getElementById('grandTotalWithDel').innerHTML)+parseInt(e.innerHTML)}`
				})

			}

			// function clearCart() {
			// $('#clearCartModal').modal('show');
			// $('#clearCartModal').on('shown.bs.modal')
			// console.log(document.getElementById('clearCartModal').style)
			// document.getElementById('clearCartModal').className += ' show'
			// document.getElementById('clearCartModal').style = 'display: block; padding-right: 17px;'

			// }
		</script>

		<!--====== Javascripts & Jquery ======-->
		<script src="../assets/js/jquery-3.2.1.min.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/js/owl.carousel.min.js"></script>
		<script src="../assets/js/mixitup.min.js"></script>
		<script src="../assets/js/sly.min.js"></script>
		<script src="../assets/js/jquery.nicescroll.min.js"></script>
		<script src="../assets/js/main.js"></script>
	</body>

	</html>

<?php
}
?>