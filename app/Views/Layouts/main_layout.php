<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from htmldemo.net/pustok/pustok/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 22 Dec 2022 07:38:08 GMT -->

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<?= view_cell("\App\Libraries\Client::renderTitle", ['title' => $title]) ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url("/client/css/plugins.css") ?>" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url("/client/css/main.css") ?>" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url("/client/css/jquery.toast.css") ?>" />
	<?= view_cell("\App\Libraries\Client::renderFavicon") ?>
	<?= $this->renderSection("client_style") ?>

</head>

<body>
	<div class="site-wrapper" id="top">
		<?= view_cell("\App\Libraries\Client::renderHeader") ?>
		<?= $this->include("Layouts/client/client_breadcrumb") ?>
		<?= $this->renderSection("content") ?>
		<?= $this->include("Layouts/client/client_detail_modal") ?>
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
	<?= view_cell("\App\Libraries\Client::renderFooter") ?>
	<!-- Use Minified Plugins Version For Fast Page Load -->
	<script src="<?= base_url("/client/js/plugins.js") ?>"></script>
	<script src="<?= base_url("/client/js/ajax-mail.js") ?>"></script>
	<script src="<?= base_url("/client/js/jquery.toast.js") ?>"></script>
	<script src="<?= base_url("/client/js/custom.js") ?>"></script>
	<script src="<?= base_url("/client/js/client.js") ?>"></script>
	<?php if (auth_user()) : ?>
		<script src="<?= base_url("/client/js/cart.js") ?>"></script>
		<script <?= csp_script_nonce() ?>>
			loadCart("<?= base_url("/api/cart") ?>", "<?= base_url("/api/cart/count") ?>", "<?= base_url("/api/cart/total_price") ?>");
			addToCart("<?= base_url("/api/cart/add") ?>", "<?= base_url("/api/cart") ?>", "<?= base_url("/api/cart/count") ?>", "<?= base_url("/api/cart/total_price") ?>")
			removeCart("<?= base_url("/api/cart/remove") ?>", "<?= base_url("/api/cart") ?>", "<?= base_url("/api/cart/count") ?>", "<?= base_url("/api/cart/total_price") ?>")
		</script>
	<?php endif ?>
	<script <?= csp_script_nonce() ?>>
		clickModal("<?= base_url("/api/data/product") ?>", "<?= base_url("/api/data/load/product") ?>");
	</script>
	<?php if (session()->getFlashdata("alert_success")) : ?>
		<script <?= csp_script_nonce() ?>>
			$.toast({
				heading: "Information",
				text: "<?= session()->getFlashdata("alert_success") ?>",
				bgColor: "#62AB00",
				textColor: "white",
				icon: "info",
				showHideTransition: "slide",
				position: "bottom-left",
			});
		</script>
	<?php endif ?>
	<?php if (session()->getFlashdata("alert_error")) : ?>
		<script <?= csp_script_nonce() ?>>
			$.toast({
				heading: "Information",
				text: "<?= session()->getFlashdata("alert_error") ?>",
				bgColor: "#BD0018",
				textColor: "white",
				icon: "warning",
				showHideTransition: "slide",
				position: "bottom-left",
			});
		</script>
	<?php endif ?>
	<?= $this->renderSection("client_script") ?>
</body>


<!-- Mirrored from htmldemo.net/pustok/pustok/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 22 Dec 2022 07:38:08 GMT -->

</html>