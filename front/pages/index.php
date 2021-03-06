<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>The Plaza - eCommerce Template</title>
	<meta charset="UTF-8">
	<meta name="description" content="The Plaza eCommerce Template">
	<meta name="keywords" content="plaza, eCommerce, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="../assets/img/favicon.ico" rel="shortcut icon" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />
	<link rel="stylesheet" href="../assets/css/owl.carousel.css" />
	<link rel="stylesheet" href="../assets/css/style.css" />
	<link rel="stylesheet" href="../assets/css/animate.css" />

	<!-- Top Button CSS -->

	<style>
		html {
			scroll-behavior: smooth;
		}

		body {
			font-family: Arial, Helvetica, sans-serif;
			font-size: 20px;

		}

		#myTopBtn {
			display: none;
			position: fixed;
			bottom: 20px;
			right: 30px;
			z-index: 99;
			font-size: 18px;
			border: none;
			outline: none;
			color: white;
			cursor: pointer;
			padding: 15px;
			border-radius: 4px;
			background: #a36ec8;
			background: -webkit-linear-gradient(top left, #a36ec8, #ca7bce);
			background: -moz-linear-gradient(top left, #a36ec8, #ca7bce);
			background: linear-gradient(to bottom right, #a36ec8, #ca7bce);

		}

		#myTopBtn:hover {
			background-color: #555;
		}
	</style>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>

	<!-- Top Button -->
	<button onclick="topFunction()" id="myTopBtn" title="Go to top">&#8593;</button>

	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<?php
	include('../components/navBar.php');
	frontHead("Home"); ?>

	<!-- Hero section -->
	<section class="hero-section set-bg" data-setbg="../assets/img/bg.jpg">
		<div class="hero-slider owl-carousel">
			<div class="hs-item">
				<div class="hs-left"><img src="../../pictures/banner-1.png" style="margin-top:150px ;" alt=""></div>
				<div class="hs-right">
					<div class="hs-content">
						<div class="price">Enjoy Each Healthy Grain Of Rice</div>
						<h2><span>Rice</span> <br>Zee Trading</h2>
					</div>
				</div>
			</div>
			<div class="hs-item">
				<div class="hs-left"><img src="../../pictures/banner-2.png" style="margin-top:150px ;" alt=""></div>
				<div class="hs-right">
					<div class="hs-content">
						<div class="price">Eat healthly and live healthily</div>
						<h2><span>Dates</span> <br>Zee Trading</h2>
					</div>
				</div>
			</div>
			<div class="hs-item">
				<div class="hs-left"><img src="../../pictures/banner-3.png" alt=""></div>
				<div class="hs-right">
					<div class="hs-content">
						<div class="price">Eat healthly and live healthily</div>
						<h2><span>SPICES</span> <br>Zee Trading</h2>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero section end -->


	<!-- Intro section -->
	<section class="intro-section spad pb-0 slider-1">
		<div class="section-title">
			<h2>Hot Products</h2>
			<p>We recommend</p>
		</div>
		<div class="intro-slider">
			<ul class="slidee">
				<?php
				require("../../functions/conn.php");
				$ProductFetch = "
				select 
				p.productName, 
				p.productDesc, 
				p.productShortDesc, 
				p.productId, 
				p.productStatus, 
				p.productAmount, 
				p.productImg, 
				p.productAddedTime, 
				p.productUpdateTime, 
				c.catName as catName, 
				sc.subCatName as subCatName 
				from `product_db` as p 
				left join product_sub_category_db as sc on p.productSubCatId=sc.subCatId 
				left join product_category_db as c on p.productCatId=c.catId 
				WHERE p.deleted=0 and subCatName='Hot';";
				$data = $connection->query($ProductFetch);
				if ($data) {
					while ($row = $data->fetch_assoc()) {
				?>
						<li>
							<div class="intro-item">
								<figure>
									<img src="<?php echo $row['productImg']; ?>" alt="<?php echo $row['productDesc'] ?>">
								</figure>
								<div class="product-info">
									<h5><?php echo $row['productName']; ?></h5>
									<p><?php echo isset($_SESSION["uId"]) ? $row['productAmount'] : "Please Sign In First" ?></p>
									<?php if (isset($_SESSION["uId"])) { ?>
										<form name="formings" name="formings" method="post" action="#" id="Hot-<?php echo $row['productId'] ?>">
											<input type="hidden" value="<?php echo $row['productAmount'] ?>" name="productAmount" />
											<input type="hidden" value="<?php echo $row['productId'] ?>" name="productId" />
											<input type="hidden" value="1" name="productQuan" />
											<!-- <input class="site-btn btn-line" type="submit" name="formSubmit" value="ADD TO CART" /> -->
											<input class="site-btn btn-line" type="button" onClick='addProd("Hot-<?php echo $row['productId'] ?>")' name="formSubmit" value="ADD TO CART" />
										</form>
									<?php
									};
									?>
									<!-- <a href="#" class="site-btn btn-line">ADD TO CART</a> -->
								</div>
							</div>
						</li>
				<?php
					}
				}
				?>
			</ul>
		</div>
		<div class="container">
			<div class="scrollbar">
				<div class="handle">
					<div class="mousearea"></div>
				</div>
			</div>
		</div>
	</section>
	<!-- Intro section end -->


	<!-- Intro section -->
	<section class="intro-section spad pb-0 slider-2">
		<div class="section-title">
			<h2>Popular Products</h2>
			<p>We recommend</p>
		</div>
		<div class="intro-slider">
			<ul class="slidee">
				<?php
				require("../../functions/conn.php");
				$ProductFetch = "
				select 
				p.productName, 
				p.productDesc, 
				p.productShortDesc, 
				p.productId, 
				p.productStatus, 
				p.productAmount, 
				p.productImg, 
				p.productAddedTime, 
				p.productUpdateTime, 
				c.catName as catName, 
				sc.subCatName as subCatName 
				from `product_db` as p 
				left join product_sub_category_db as sc on p.productSubCatId=sc.subCatId 
				left join product_category_db as c on p.productCatId=c.catId 
				WHERE p.deleted=0 and subCatName='Popular';";
				$data = $connection->query($ProductFetch);
				if ($data) {
					$i = 0;
					while ($row = $data->fetch_assoc()) {
						$i++
				?>
						<li>
							<div class="intro-item">
								<figure>
									<img src="<?php echo $row['productImg']; ?>" alt="<?php echo $row['productDesc'] ?>">
								</figure>
								<div class="product-info">
									<h5><?php echo $row['productName']; ?></h5>
									<p><?php echo isset($_SESSION["uId"]) ? $row['productAmount'] : "Please Sign In First" ?></p>
									<?php if (isset($_SESSION["uId"])) { ?>
										<form name="formings" method="post" action="#" id="Popular-<?php echo $row['productId'] ?>">
											<!-- action="../../functions/cart/cart.php" -->
											<input type="hidden" value="<?php echo $row['productAmount'] ?>" name="productAmount" />
											<input type="hidden" value="<?php echo $row['productId'] ?>" name="productId" />
											<input type="hidden" value="1" name="productQuan" />
											<!-- <input class="site-btn btn-line" type="submit" name="formSubmit" value="ADD TO CART" /> -->
											<input class="site-btn btn-line" type="button" onClick='addProd("Popular-<?php echo $row['productId'] ?>")' name="formSubmit" value="ADD TO CART" />
										</form>
									<?php } ?>
									<!-- <a href="#" class="site-btn btn-line">ADD TO CART</a> -->
								</div>
							</div>
						</li>
				<?php
					}
				}
				?>
			</ul>
		</div>
		<div class="container">
			<div class="popular-scrollbar">
				<div class="handle">
					<div class="mousearea"></div>
				</div>
			</div>
		</div>
	</section>
	<!-- Intro section end -->



	<!-- Product section -->
	<section class="product-section spad">
		<div class="container">
			<ul class="product-filter controls">
				<li class="control" data-filter=".Hot">Hot</li>
				<li class="control" data-filter="all">Recommended</li>
				<li class="control" data-filter=".Popular">Popular</li>
			</ul>
			<div class="row" id="product-filter">
				<?php
				require("../../functions/conn.php");
				$ProductFetch = "
				select 
				p.productName, 
				p.productDesc, 
				p.productShortDesc, 
				p.productId, 
				p.productStatus, 
				p.productAmount, 
				p.productImg, 
				p.productAddedTime, 
				p.productUpdateTime, 
				c.catName as catName, 
				sc.subCatName as subCatName 
				from `product_db` as p 
				left join product_sub_category_db as sc on p.productSubCatId=sc.subCatId 
				left join product_category_db as c on p.productCatId=c.catId 
				WHERE p.deleted=0;";
				$data = $connection->query($ProductFetch);
				if ($data) {
					while ($row = $data->fetch_assoc()) {
						// echo 
				?>
						<div class="mix col-lg-3 col-md-6 <?php echo $row['subCatName'] ?>">
							<div class="product-item">
								<figure>
									<img src="<?php echo $row['productImg'] ?>" alt="<?php echo $row['productImg'] ?>">
								</figure>
								<div class="product-info">
									<h6><?php echo $row['productName'] ?></h6>
									<p><?php echo isset($_SESSION["uId"]) ? $row['productAmount'] : "Please Sign In First" ?></p>
									<!-- <form method="post" action="../../functions/cart/cart.php"> -->
									<?php if (isset($_SESSION["uId"])) { ?>
										<form name="formings" method="post" action="#" id="<?php echo $row['productId'] ?>">
											<input type="hidden" value="<?php echo $row['productAmount'] ?>" name="productAmount" />
											<input type="hidden" value="<?php echo $row['productId'] ?>" name="productId" />
											<input type="hidden" value="1" name="productQuan" />
											<!-- <input class="site-btn btn-line" type="submit" name="formSubmit" value="ADD TO CART" /> -->
											<input class="site-btn btn-line" type="button" onClick='addProd("<?php echo $row['productId'] ?>")' name="formSubmit" value="ADD TO CART" />
										</form>
									<?php } ?>
									<!-- <a href="#" class="site-btn btn-line">ADD TO CART</a> -->
								</div>
							</div>
						</div>
				<?php
					}
				}
				?>
				<!-- <div class="mix col-lg-3 col-md-6 popular">
					<div class="product-item">
						<figure>
							<img src="../assets/img/products/2.jpg" alt="">
							<div class="bache">NEW</div>
							<div class="pi-meta">
								<div class="pi-m-left">
									<img src="../assets/img/icons/eye.png" alt="">
									<p>quick view</p>
								</div>
								<div class="pi-m-right">
									<img src="../assets/img/icons/heart.png" alt="">
									<p>save</p>
								</div>
							</div>
						</figure>
						<div class="product-info">
							<h6>Hype grey shirt</h6>
							<p>$19.50</p>
							<a href="#" class="site-btn btn-line">ADD TO CART</a>
						</div>
					</div>
				</div>
				<div class="mix col-lg-3 col-md-6 hot">
					<div class="product-item">
						<figure>
							<img src="../assets/img/products/3.jpg" alt="">
							<div class="pi-meta">
								<div class="pi-m-left">
									<img src="../assets/img/icons/eye.png" alt="">
									<p>quick view</p>
								</div>
								<div class="pi-m-right">
									<img src="../assets/img/icons/heart.png" alt="">
									<p>save</p>
								</div>
							</div>
						</figure>
						<div class="product-info">
							<h6>long sleeve jacket</h6>
							<p>$59.90</p>
							<a href="#" class="site-btn btn-line">ADD TO CART</a>
						</div>
					</div>
				</div>
				<div class="mix col-lg-3 col-md-6 popular best">
					<div class="product-item">
						<figure>
							<img src="../assets/img/products/4.jpg" alt="">
							<div class="bache sale">SALE</div>
							<div class="pi-meta">
								<div class="pi-m-left">
									<img src="../assets/img/icons/eye.png" alt="">
									<p>quick view</p>
								</div>
								<div class="pi-m-right">
									<img src="../assets/img/icons/heart.png" alt="">
									<p>save</p>
								</div>
							</div>
						</figure>
						<div class="product-info">
							<h6>Denim men shirt</h6>
							<p>$32.20 <span>RRP 64.40</span></p>
							<a href="#" class="site-btn btn-line">ADD TO CART</a>
						</div>
					</div>
				</div>
				<div class="mix col-lg-3 col-md-6 hot">
					<div class="product-item">
						<figure>
							<img src="../assets/img/products/5.jpg" alt="">
							<div class="pi-meta">
								<div class="pi-m-left">
									<img src="../assets/img/icons/eye.png" alt="">
									<p>quick view</p>
								</div>
								<div class="pi-m-right">
									<img src="../assets/img/icons/heart.png" alt="">
									<p>save</p>
								</div>
							</div>
						</figure>
						<div class="product-info">
							<h6>Long red Shirt</h6>
							<p>$39.90</p>
							<a href="#" class="site-btn btn-line">ADD TO CART</a>
						</div>
					</div>
				</div>
				<div class="mix col-lg-3 col-md-6 popular">
					<div class="product-item">
						<figure>
							<img src="../assets/img/products/6.jpg" alt="">
							<div class="bache">NEW</div>
							<div class="pi-meta">
								<div class="pi-m-left">
									<img src="../assets/img/icons/eye.png" alt="">
									<p>quick view</p>
								</div>
								<div class="pi-m-right">
									<img src="../assets/img/icons/heart.png" alt="">
									<p>save</p>
								</div>
							</div>
						</figure>
						<div class="product-info">
							<h6>Hype grey shirt</h6>
							<p>$19.50</p>
							<a href="#" class="site-btn btn-line">ADD TO CART</a>
						</div>
					</div>
				</div>
				<div class="mix col-lg-3 col-md-6 hot">
					<div class="product-item">
						<figure>
							<img src="../assets/img/products/7.jpg" alt="">
							<div class="pi-meta">
								<div class="pi-m-left">
									<img src="../assets/img/icons/eye.png" alt="">
									<p>quick view</p>
								</div>
								<div class="pi-m-right">
									<img src="../assets/img/icons/heart.png" alt="">
									<p>save</p>
								</div>
							</div>
						</figure>
						<div class="product-info">
							<h6>long sleeve jacket</h6>
							<p>$59.90</p>
							<a href="#" class="site-btn btn-line">ADD TO CART</a>
						</div>
					</div>
				</div> -->
				<!-- <div class="mix col-lg-3 col-md-6 hot">
					<div class="product-item">
						<figure>
							<img src="../assets/img/products/8.jpg" alt="">
							<div class="pi-meta">
								<div class="pi-m-left">
									<img src="../assets/img/icons/eye.png" alt="">
									<p>quick view</p>
								</div>
								<div class="pi-m-right">
									<img src="../assets/img/icons/heart.png" alt="">
									<p>save</p>
								</div>
							</div>
						</figure>
						<div class="product-info">
							<h6>Denim men shirt</h6>
							<p>$32.20 <span>RRP 64.40</span></p>
							<a href="#" class="site-btn btn-line">ADD TO CART</a>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</section>
	<!-- Product section end -->


	<?php
	require("../components/footer.php");
	footer();
	// $_SESSION['cart']=[];
	?>

	<!-- manual script  -->
	<script>
		function addProd(id) {

			// $(id).submit(function(e) {
			// e.preventDefault();
			$.ajax({
				type: 'post',
				url: '../../functions/cart/cart.php',
				data: $("#" + id).serialize(),
				async: true,
				success: function(resp) {
					console.log(resp)
					// console.log(`<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : "0"; ?>`)
					document.getElementById('cart-val').innerHTML = `${resp}`;
				},
				error: function(err) {
					console.log(err)
				}
			});
		}

		// console.log($('form').serialize());
		// var xmlhttp = new XMLHttpRequest();
		// xmlhttp.onreadystatechange = function() {
		// 	if (this.readyState == 4 && this.status == 200) {
		// 		document.getElementById("cart-val").innerHTML = this.responseText;
		// 	}
		// }
		// xmlhttp.open("POST", "../../functions/cart/cart.php", true);
		// xmlhttp.send();
		// console.log(`<?php echo isset($_SESSION['cart']) ? json_encode($_SESSION['cart']) : "Nothing to show"; ?>`)

		// });
	</script>

	<script>
		//Get the button
		var mybutton = document.getElementById("myTopBtn");

		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {
			scrollFunction()
		};

		function scrollFunction() {
			if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				mybutton.style.display = "block";
			} else {
				mybutton.style.display = "none";
			}
		}

		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
		}
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