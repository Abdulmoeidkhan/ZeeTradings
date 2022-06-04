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

	<?php require("../components/navBar.php"); ?>


	<!-- Page Info -->
	<div class="page-info-section page-info">
		<div class="container">
			<div class="site-breadcrumb">
				<a href="">Home</a> /
				<span>Contact</span>
			</div>
			<img src="../assets/img/page-info-art.png" alt="" class="page-info-art">
		</div>
	</div>
	<!-- Page Info end -->


	<!-- Page -->
	<div class="page-area contact-page">
		<div class="container spad">
			<div class="text-center">
				<h4 class="contact-title">Get in Touch</h4>
			</div>
			<form class="contact-form" method="POST" action="../../functions/contact/contact.php">
				<div class="row">
					<div class="col-md-6">
						<input type="text" placeholder="First Name *" name="firstName">
					</div>
					<div class="col-md-6">
						<input type="text" placeholder="Last Name *" name="lastName">
					</div>
					<div class="col-md-6">
						<input type="email" placeholder="Email" name="ctcEmail">
					</div>
					<div class="col-md-6">
						<input type="text" placeholder="Contact Number" name="ctcNumber">
					</div>
					<div class="col-md-12">
						<textarea placeholder="Message" name="ctcMessage"></textarea>
						<div class="text-center">
							<input type="submit" name="formSubmit" class="site-btn">Send Message</a>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="container contact-info-warp">
			<div class="contact-card">
				<div class="contact-info">
					<h4>Shipping & Returnes</h4>
					<p>Phone: +53 345 7953 32453</p>
					<p>Email: yourmail@gmail.com</p>
				</div>
				<div class="contact-info">
					<h4>Informations</h4>
					<p>Phone: +53 345 7953 32453</p>
					<p>Email: yourmail@gmail.com</p>
				</div>
			</div>
		</div>
		<div class="map-area">
			<div class="map" id="map-canvas"></div>
		</div>
	</div>
	<!-- Page end -->

	<?php
	require("../components/footer.php")
	?>

	<!--====== Javascripts & Jquery ======-->
	<script src="../assets/js/jquery-3.2.1.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/owl.carousel.min.js"></script>
	<script src="../assets/js/mixitup.min.js"></script>
	<script src="../assets/js/sly.min.js"></script>
	<script src="../assets/js/jquery.nicescroll.min.js"></script>
	<script src="../assets/js/main.js"></script>

	<!-- Map js -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWTIlluowDL-X4HbYQt3aDw_oi2JP0Krc&sensor=false"></script>
	<script src="../assets/js/map.js"></script>

</body>

</html>