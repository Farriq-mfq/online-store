<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Karma Shop</title>

	<!--
            CSS
            ============================================= -->
	<link rel="stylesheet" href="<?= base_url("client/css/linearicons.css") ?>">
	<link rel="stylesheet" href="<?= base_url("client/css/font-awesome.min.css") ?>">
	<link rel="stylesheet" href="<?= base_url("client/css/themify-icons.css") ?>">
	<link rel="stylesheet" href="<?= base_url("client/css/bootstrap.css") ?>">
	<link rel="stylesheet" href="<?= base_url("client/css/owl.carousel.css") ?>">
	<link rel="stylesheet" href="<?= base_url("client/css/nice-select.css") ?>">
	<link rel="stylesheet" href="<?= base_url("client/css/nouislider.min.css") ?>">
	<link rel="stylesheet" href="<?= base_url("client/css/ion.rangeSlider.css") ?>" />
	<link rel="stylesheet" href="<?= base_url("client/css/ion.rangeSlider.skinFlat.css") ?>" />
	<link rel="stylesheet" href="<?= base_url("client/css/magnific-popup.css") ?>">
	<link rel="stylesheet" href="<?= base_url("client/css/main.css") ?>">
</head>

<body>

	<!-- Start Header Area -->
	<?= $this->include("Layouts/client/client_header") ?>
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<?= $this->include("Layouts/client/client_banner") ?>
	<!-- End Banner Area -->
	<div class="container">
		<?= $this->renderSection("content") ?>
	</div>


	<!-- Start related-product Area -->
	<?= $this->renderSection("related_product") ?>
	<!-- End related-product Area -->

	<!-- start footer Area -->
	<?= $this->include("Layouts/client/client_footer") ?>
	<!-- End footer Area -->

	<!-- Modal Quick Product View -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="container relative">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="product-quick-view">
					<div class="row align-items-center">
						<div class="col-lg-6">
							<div class="quick-view-carousel">
								<div class="item" style="background: url(img/organic-food/q1.jpg);">

								</div>
								<div class="item" style="background: url(img/organic-food/q1.jpg);">

								</div>
								<div class="item" style="background: url(img/organic-food/q1.jpg);">

								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="quick-view-content">
								<div class="top">
									<h3 class="head">Mill Oil 1000W Heater, White</h3>
									<div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span> <span class="ml-10">$149.99</span></div>
									<div class="category">Category: <span>Household</span></div>
									<div class="available">Availibility: <span>In Stock</span></div>
								</div>
								<div class="middle">
									<p class="content">Mill Oil is an innovative oil filled radiator with the most modern technology. If you are
										looking for something that can make your interior look awesome, and at the same time give you the pleasant
										warm feeling during the winter.</p>
									<a href="#" class="view-full">View full Details <span class="lnr lnr-arrow-right"></span></a>
								</div>
								<div class="bottom">
									<div class="color-picker d-flex align-items-center">Color:
										<span class="single-pick"></span>
										<span class="single-pick"></span>
										<span class="single-pick"></span>
										<span class="single-pick"></span>
										<span class="single-pick"></span>
									</div>
									<div class="quantity-container d-flex align-items-center mt-15">
										Quantity:
										<input type="text" class="quantity-amount ml-15" value="1" />
										<div class="arrow-btn d-inline-flex flex-column">
											<button class="increase arrow" type="button" title="Increase Quantity"><span class="lnr lnr-chevron-up"></span></button>
											<button class="decrease arrow" type="button" title="Decrease Quantity"><span class="lnr lnr-chevron-down"></span></button>
										</div>

									</div>
									<div class="d-flex mt-20">
										<a href="#" class="view-btn color-2"><span>Add to Cart</span></a>
										<a href="#" class="like-btn"><span class="lnr lnr-layers"></span></a>
										<a href="#" class="like-btn"><span class="lnr lnr-heart"></span></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	<script src="<?= base_url("/client/js/vendor/jquery-2.2.4.min.js") ?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="<?= base_url("/client/js/vendor/bootstrap.min.js") ?>"></script>
	<script src="<?= base_url("/client/js/jquery.ajaxchimp.min.js") ?>"></script>
	<script src="<?= base_url("/client/js/jquery.nice-select.min.js") ?>"></script>
	<script src="<?= base_url("/client/js/jquery.sticky.js") ?>"></script>
	<script src="<?= base_url("/client/js/nouislider.min.js") ?>"></script>
	<script src="<?= base_url("/client/js/countdown.js") ?>"></script>
	<script src="<?= base_url("/client/js/jquery.magnific-popup.min.js") ?>"></script>
	<script src="<?= base_url("/client/js/owl.carousel.min.js") ?>"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="<?= base_url("/client/js/gmaps.min.js") ?>"></script>
	<script src="<?= base_url("/client/js/main.js") ?>"></script>
	<?= $this->renderSection("client_script") ?>
</body>

</html>