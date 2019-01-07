<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Aimerr Solutions" />

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="http://gotcheme.com/Gotche-static/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>style.css" type="text/css" />
	<link rel="stylesheet" href="http://gotcheme.com/Gotche-static/css/dark.css" type="text/css" />
	<link rel="stylesheet" href="http://gotcheme.com/Gotche-static/css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="http://gotcheme.com/Gotche-static/css/animate.css" type="text/css" />
	<link rel="stylesheet" href="http://gotcheme.com/Gotche-static/css/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="http://gotcheme.com/Gotche-static/css/responsive.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
	<title>Stock - Performance Chemicals and Additives for Home & Personal Care, Water Treatment, Oil & Gas and Construction Industries | Gotche</title>
	
	<style>
	@media (max-width: 991px){
body:not(.dark) #header:not(.dark) #header-wrap:not(.dark) #primary-menu ul ul a, body:not(.dark) #header:not(.dark) #header-wrap:not(.dark) #primary-menu > div > ul > li:hover ul a{
	color: white !important;
}

	}
	 .copy-right-c {
        padding-top: 40px;
    }
    .copy-right-p {
        padding-top: 40px;
    }
	
</style>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
		<header id="header" class="sticky-style-2">

			<div class="container clearfix">

				<!-- Logo
				============================================= -->
				<div id="logo">
					<a href="http://gotcheme.com/Gotche-static/index.php" class="standard-logo"><img src="img/logo.png" alt="Gotche Logo"></a>
					<a href="http://gotcheme.com/Gotche-static/index.php" class="retina-logo"><img src="img/logo.png" alt="Gotche Logo"></a>
				</div><!-- #logo end -->

				 <ul class="header-extras">
					<li>
						<i class="i-plain icon-call nomargin"></i>
						<div class="he-text">
							Phone
							<span x-ms-format-detection="none">+971 6 7667128</span>
						</div>
					</li>
					<li>
						<i class="i-plain icon-line2-envelope nomargin"></i>
						<div class="he-text">
							Email Us
							<span x-ms-format-detection="none">info@gotcheme.com</span>
						</div>
					</li>
				</ul>

			</div>

			<div id="header-wrap">

				<!-- Primary Navigation
				============================================= -->
				<nav id="primary-menu" class="with-arrows style-2 center">

					<div class="container clearfix">

						<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

						<ul>
							<li class=""><a href="http://gotcheme.com/Gotche-static/index.php" title="Home"><div>Home</div></a></li>
							<li><a href="http://gotcheme.com/Gotche-static/aboutus.php" title="About us"><div>About us</div></a></li>
							<li><a href="#" title="Products & Services"><div>Products & Services</div></a>
								<ul>
									<li><a href="http://gotcheme.com/Gotche-static/chemical-trading.php"><div>Chemical Trading</div></a></li>
									<li><a href="http://gotcheme.com/Gotche-static/indenting-business.php"><div>Indenting Business</div></a></li>
									<li><a href="http://gotcheme.com/Gotche-static/engineering-services.php"><div>Engineering Services</div></a></li>
								</ul>
							</li>
							
							<li><a href="http://gotcheme.com/Gotche-static/Stock" title="Stock"><div>Stock</div></a></li>
							<li><a href="http://gotcheme.com/Gotche-static/contactus.php" title="Contact us"><div>Contact us</div></a></li>
							<li><a href="http://barrelyene.com/" title="Barrelyene International" target="_blank"><div>Barrelyene International</div></a></li>
						</ul>

					</div>

				</nav><!-- #primary-menu end -->

			</div>

		</header><!-- #header end -->

		<!-- Page Title
		============================================= -->
		<section id="page-title" style="background-image:url(http://gotcheme.com/Gotche-static/img/stock-banner.jpg);">
<div class="container clearfix">
<h1 style="color:white">Stock</h1>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Stock</li>
</ol>
</div>
</section>

<section id="content">
<div class="content-wrap">
<div class="container clearfix">
<div id="shop" class="shop product-3 grid-container clearfix" data-layout="fitRows">
<?php

foreach($data as $value){
	$img_path=img_path_trim($value['file']);
	?>
	



<div class="product clearfix" style="">
	<div class="product-image" align="center">
		<a href="#"><img width="180" src="<?php echo $img_path; ?>" alt="<?php $value['item_name'] ?>"></a>
		<div class="sale-flash"><?php echo $value['quantity']; ?></div>
		<!--<div class="product-overlay">
			<a href="#" class="add-to-cart"><i class="icon-shopping-cart"></i><span> Add to Cart</span></a>
			<a href="include/ajax/shop-item.html" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>
		</div>-->
	</div>
	<div class="product-desc center">
		<div class="product-title"><h3><a href="#"><?php echo $value['item_name']; ?></a></h3></div>
		
	</div>
</div>

<?php } ?>


</div>
</div>
</div>
</section>

		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark" style="background-image:url(http://gotcheme.com/img/footer-banner.jpg); border-top:0px;">

			<div class="container">

				<!-- Footer Widgets
				============================================= -->
				<div class="footer-widgets-wrap clearfix">

					 

							<div class="row">

								<div class="col-lg-4 col-6 bottommargin-sm widget_links">
									<ul>
                                                                            <li><a href="http://localhost/Gotche-static/index.php">Home</a></li>
										<li><a href="http://localhost/Gotche-static/aboutus.php">About Gotche</a></li>
										<li><a href="http://barrelyene.com/" title="Barrelyene International" target="_blank">Barrelyene International</a></li>
									</ul>
								</div>

								<div class="col-lg-4 col-6 bottommargin-sm widget_links">
									<ul>
                                                                            <li class="font-16" style="margin-left:11px;"><strong>Products & Services</strong></li>
                                                                                <li><a href="http://localhost/Gotche-static/chemical-trading.php">Chemical Trading</a></li>
										<li><a href="http://localhost/Gotche-static/indenting-business.php">Indenting Business</a></li>
										<li><a href="http://localhost/Gotche-static/engineering-services.php">Engineering Services</a></li>
									</ul>
								</div>

								<div class="col-lg-4 col-6 bottommargin-sm widget_links">
									<ul style="text-decoration: none !important;">
                                                                            <li><a href="contactus.php" style="padding-left:0px"><strong class="font-16">Contact Us</strong></a></li>
                                                                            <li>Ajman, United Arab Emirates</li>
                                                                            <li x-ms-format-detection="none">Tel: +97167667128</li>
                                                                            <li x-ms-format-detection="none">Mobile: +971568133148</li>
                                                                            <li>Email: info@gotcheme.com</li>
									</ul>
								</div>

							</div>

					 

					 

				</div><!-- .footer-widgets-wrap end -->

			</div>

			<!-- Copyrights
			============================================= -->
			<div id="copyri" style="background-color:black;">

				<div class="container clearfix">

					<div class="row">
						<div class="col-md-8" align="center">
							<div class="col_half copy-right-c">
							&copy;All Rights Reserved by <span id="copy-right-cname"><a href="www.gotcheme.com"><span style="color:white">Gotche Middle East F.Z.E</span></a></span>
							</div>
						</div>

						
						<div class="col-md-4 copy-right-p" align="center">
							<p id="p-text">Powered By - <a href="http://www.aimerr.com" target="_blank"><span id="amr">Aimerr <span id="sls">Solutions</span></span></a></p>  
						</div>
					</div>

				</div>

			</div><!-- #copyrights end -->

		</footer>

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- External JavaScripts
	============================================= -->
	<script src="<?php echo base_url() ?>js/jquery.js"></script>
	<script src="<?php echo base_url() ?>js/plugins.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="<?php echo base_url() ?>js/functions.js"></script>


</body>
</html>