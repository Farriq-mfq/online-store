<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from htmldemo.net/pustok/pustok/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 22 Dec 2022 07:38:08 GMT -->

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Pustok - Book Store HTML Template</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Use Minified Plugins Version For Fast Page Load -->
	<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url("/client/css/plugins.css") ?>" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url("/client/css/main.css") ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url("/client/image/favicon.ico") ?>">
</head>

<body>
	<div class="site-wrapper" id="top">
		<?= $this->include("Layouts/client/client_header") ?>
		<?= $this->include("Layouts/client/client_mobile") ?>

		<div class="sticky-init fixed-header common-sticky">
			<div class="container d-none d-lg-block">
				<div class="row align-items-center">
					<div class="col-lg-4">
						<a href="index-2.html" class="site-brand">
							<img src="image/logo.png" alt="">
						</a>
					</div>
					<div class="col-lg-8">
						<?= $this->include("Layouts/client/client_nav") ?>
					</div>
				</div>
			</div>
		</div>
		<section class="breadcrumb-section">
			<h2 class="sr-only">Site Breadcrumb</h2>
			<div class="container">
				<div class="breadcrumb-contents">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
							<li class="breadcrumb-item active">Cart</li>
						</ol>
					</nav>
				</div>
			</div>
		</section>
		<?= $this->renderSection("content") ?>
	</div>
	<!--=================================
  Brands Slider
===================================== -->
	<section class="section-margin">
		<h2 class="sr-only">Brand Slider</h2>
		<div class="container">
			<div class="brand-slider sb-slick-slider border-top border-bottom" data-slick-setting='{
                                            "autoplay": true,
                                            "autoplaySpeed": 8000,
                                            "slidesToShow": 6
                                            }' data-slick-responsive='[
                {"breakpoint":992, "settings": {"slidesToShow": 4} },
                {"breakpoint":768, "settings": {"slidesToShow": 3} },
                {"breakpoint":575, "settings": {"slidesToShow": 3} },
                {"breakpoint":480, "settings": {"slidesToShow": 2} },
                {"breakpoint":320, "settings": {"slidesToShow": 1} }
            ]'>
				<div class="single-slide">
					<img src="<?= base_url("/client") ?>/image/others/brand-1.jpg" alt="">
				</div>
				<div class="single-slide">
					<img src="<?= base_url("/client") ?>/image/others/brand-2.jpg" alt="">
				</div>
				<div class="single-slide">
					<img src="<?= base_url("/client") ?>/image/others/brand-3.jpg" alt="">
				</div>
				<div class="single-slide">
					<img src="<?= base_url("/client") ?>/image/others/brand-4.jpg" alt="">
				</div>
				<div class="single-slide">
					<img src="<?= base_url("/client") ?>/image/others/brand-5.jpg" alt="">
				</div>
				<div class="single-slide">
					<img src="<?= base_url("/client") ?>/image/others/brand-6.jpg" alt="">
				</div>
				<div class="single-slide">
					<img src="<?= base_url("/client") ?>/image/others/brand-1.jpg" alt="">
				</div>
				<div class="single-slide">
					<img src="<?= base_url("/client") ?>/image/others/brand-2.jpg" alt="">
				</div>
			</div>
		</div>
	</section>
	<!--=================================
    Footer Area
===================================== -->
	<?= $this->include("/Layouts/client/client_footer") ?>
	<!-- Use Minified Plugins Version For Fast Page Load -->
	<script src="<?= base_url("/client/js/plugins.js") ?>"></script>
	<script src="<?= base_url("/client/js/ajax-mail.js") ?>"></script>
	<script src="<?= base_url("/client/js/custom.js") ?>"></script>
</body>


<!-- Mirrored from htmldemo.net/pustok/pustok/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 22 Dec 2022 07:38:08 GMT -->

</html>