<footer class="site-footer">
	<div class="container">
		<div class="row justify-content-between  section-padding">
			<div class=" col-xl-3 col-lg-4 col-sm-6">
				<div class="single-footer pb--40">
					<div class="brand-footer footer-title">
						<img src="image/logo--footer.png" alt="">
					</div>
					<div class="footer-contact">
						<p><span class="label">Address:</span><span class="text"><?= $website ? $website->company_address : "" ?></span></p>
						<p><span class="label">Phone:</span><span class="text"><?= $website ? $website->company_phone : "" ?></span></p>
						<p><span class="label">Email:</span><span class="text"><?= $website ? $website->company_email : "" ?></span></p>
					</div>
				</div>
			</div>
			<div class=" col-xl-3 col-lg-2 col-sm-6">
				<div class="single-footer pb--40">
					<div class="footer-title">
						<h3>Information</h3>
					</div>
					<?= $website ? html_entity_decode($website->information_content) : "" ?>
				</div>
			</div>
			<div class=" col-xl-3 col-lg-2 col-sm-6">
				<div class="single-footer pb--40">
					<div class="footer-title">
						<h3>Extras</h3>
					</div>
					<?= $website ? html_entity_decode($website->extras_content) : "" ?>
				</div>
			</div>
			<div class=" col-xl-3 col-lg-4 col-sm-6">
				<div class="footer-title">
					<h3>Newsletter Subscribe</h3>
				</div>
				<div class="newsletter-form mb--30">
					<form action="https://htmldemo.net/pustok/pustok/php/mail.php">
						<input type="email" class="form-control" placeholder="Enter Your Email Address Here...">
						<button class="btn btn--primary w-100">Subscribe</button>
					</form>
				</div>
				<div class="social-block">
					<h3 class="title">STAY CONNECTED</h3>
					<ul class="social-list list-inline">
						<li class="single-social facebook"><a href="#"><i class="ion ion-social-facebook"></i></a>
						</li>
						<li class="single-social twitter"><a href="#"><i class="ion ion-social-twitter"></i></a></li>
						<li class="single-social google"><a href="#"><i class="ion ion-social-googleplus-outline"></i></a></li>
						<li class="single-social youtube"><a href="#"><i class="ion ion-social-youtube"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<?= $website ? html_entity_decode($website->footer_content) : "" ?>
		</div>
	</div>
</footer>