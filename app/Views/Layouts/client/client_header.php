<div class="site-header d-none d-lg-block">
	<div class="header-middle pt--10 pb--10">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-3 ">
					<a href="<?= base_url() ?>" class="site-brand">
						<?php if ($website) : ?>
							<img src="<?= $website->logo ?>" alt="">
						<?php endif ?>
					</a>
				</div>
				<div class="col-lg-3">
					<div class="header-phone ">
						<div class="icon">
							<i class="fas fa-headphones-alt"></i>
						</div>
						<div class="text">
							<?= $website ? html_entity_decode($website->support_content) : "" ?>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="main-navigation flex-lg-right">
						<ul class="main-menu menu-right ">
							<?= printMenu($pages) ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="header-bottom pb--10">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-3">
					<nav class="category-nav">
						<div>
							<a href="javascript:void(0)" class="category-trigger"><i class="fa fa-bars"></i>Browse
								categories</a>
							<ul class="category-menu">
								<?php foreach ($categories as $ct) : ?>
									<?php if (!isset($ct['child'])) : ?>
										<li class="cat-item"><a href="<?= base_url("/shop?category_id=" . $ct['category_id']) ?>"><?= $ct['category'] ?></a></li>
									<?php endif ?>
								<?php endforeach ?>
								<?= printcategories($categories) ?>
							</ul>
						</div>
					</nav>
				</div>
				<div class="col-lg-5">
					<div class="header-search-block">
						<form action="<?= base_url('/shop') ?>">
							<input type="text" name="q" placeholder="Search entire store here">
							<button type="submit">Search</button>
						</form>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="main-navigation flex-lg-right">
						<div class="cart-widget">
							<div class="login-block">
								<?php if (auth_user()) : ?>
									<ul class="main-menu">
										<li class="menu-item has-children">
											<a href="javascript:void(0)">My Account <i class="fas fa-chevron-down dropdown-arrow"></i></a>
											<ul class="sub-menu">
												<li><a href="<?= base_url('/account') ?>">My Account</a></li>
												<li><a href="<?= base_url('account?tab=orders') ?>">Transactions</a></li>
												<li><a href="<?= base_url('account?tab=download') ?>">Downloads</a></li>
											</ul>
										</li>
									</ul>
								<?php else : ?>
									<a href="<?= base_url("/auth") ?>" class="font-weight-bold">Login</a> <br>
									<span>or</span><a href="<?= base_url("/auth") ?>">Register</a>
								<?php endif ?>
							</div>
							<?php if (current_url() != site_url("/cart") && current_url() != site_url("/checkout")) : ?>
								<div class="cart-block">
									<div class="cart-total">
										<span class="text-number" id="load__cart__count">0</span>
										<span class="text-item">
											Shopping Cart
										</span>
										<span class="price" id="load__total__price">
											Rp.0
										</span>
									</div>
									<div class="cart-dropdown-block" id="load__cart____">
										<div class="single-cart-block text-center">
											Cart Empty
										</div>
									</div>
								</div>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="site-mobile-menu">
	<header class="mobile-header d-block d-lg-none pt--10 pb-md--10">
		<div class="container">
			<div class="row align-items-sm-end align-items-center">
				<div class="col-md-4 col-7">
					<a href="<?= base_url() ?>" class="site-brand">
						<?php if ($website) : ?>
							<img src="<?= $website->logo ?>" alt="">
						<?php endif ?>
					</a>
				</div>
				<div class="col-md-5 order-3 order-md-2">
					<nav class="category-nav   ">
						<div>
							<a href="javascript:void(0)" class="category-trigger"><i class="fa fa-bars"></i>Browse
								categories</a>
							<ul class="category-menu">
								<?php foreach ($categories as $ct) : ?>
									<?php if (!isset($ct['child'])) : ?>
										<li class="cat-item"><a href="<?= base_url("/shop?category_id=" . $ct['category_id']) ?>"><?= $ct['category'] ?></a></li>
									<?php endif ?>
								<?php endforeach ?>
								<?= printcategories($categories) ?>
							</ul>
						</div>
					</nav>
				</div>
				<div class="col-md-3 col-5  order-md-3 text-right">
					<div class="mobile-header-btns header-top-widget">
						<ul class="header-links">
							<li class="sin-link">
								<a href="<?= base_url("/cart") ?>" class="cart-link link-icon"><i class="ion-bag"></i></a>
								<span class="text-success lead" id="load__cart__count__mobile">0</span>
							</li>
							<li class="sin-link">
								<a href="javascript:" class="link-icon hamburgur-icon off-canvas-btn"><i class="ion-navicon"></i></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!--Off Canvas Navigation Start-->
	<aside class="off-canvas-wrapper">
		<div class="btn-close-off-canvas">
			<i class="ion-android-close"></i>
		</div>
		<div class="off-canvas-inner">
			<!-- search box start -->
			<div class="search-box offcanvas">
				<form>
					<input type="text" placeholder="Search Here">
					<button class="search-btn"><i class="ion-ios-search-strong"></i></button>
				</form>
			</div>
			<!-- search box end -->
			<!-- mobile menu start -->
			<div class="mobile-navigation">
				<!-- mobile menu navigation start -->
				<nav class="off-canvas-nav">
					<ul class="mobile-menu main-mobile-menu">
						<?= printMenu($pages) ?>
					</ul>
				</nav>
				<!-- mobile menu navigation end -->
			</div>
			<!-- mobile menu end -->
			<?php if (auth_user()) : ?>
				<nav class="off-canvas-nav">
					<ul class="mobile-menu menu-block-2">
						<li class="menu-item-has-children">
							<a href="#">My Account <i class="fas fa-angle-down"></i></a>
							<ul class="sub-menu">
								<li><a href="<?= base_url('/account') ?>">My Account</a></li>
								<li><a href="<?= base_url('account?tab=orders') ?>">Transactions</a></li>
								<li><a href="<?= base_url('account?tab=download') ?>">Downloads</a></li>
							</ul>
						</li>
					</ul>
				</nav><?php else : ?>
				<a href="<?= base_url("/auth") ?>" class="font-weight-bold">Login</a> <br>
				<span>or</span><br><a href="<?= base_url("/auth") ?>">Register</a>
			<?php endif ?>
			<div class="off-canvas-bottom">
				<div class="contact-list mb--10">
					<a href="#" class="sin-contact"><i class="fas fa-mobile-alt"></i><?= $website ? $website->company_phone : "" ?></a>
					<a href="#" class="sin-contact"><i class="fas fa-envelope"></i><?= $website ? $website->company_email : "" ?></a>
				</div>
				<div class="off-canvas-social">
					<a href="#" class="single-icon"><i class="fab fa-facebook-f"></i></a>
					<a href="#" class="single-icon"><i class="fab fa-twitter"></i></a>
					<a href="#" class="single-icon"><i class="fas fa-rss"></i></a>
					<a href="#" class="single-icon"><i class="fab fa-youtube"></i></a>
					<a href="#" class="single-icon"><i class="fab fa-google-plus-g"></i></a>
					<a href="#" class="single-icon"><i class="fab fa-instagram"></i></a>
				</div>
			</div>
		</div>
	</aside>
	<!--Off Canvas Navigation End-->
</div>
<div class="sticky-init fixed-header common-sticky">
	<div class="container d-none d-lg-block">
		<div class="row align-items-center">
			<div class="col-lg-4">
				<a href="<?= base_url() ?>" class="site-brand">
					<?php if ($website) : ?>
						<img src="<?= $website->logo ?>" alt="">
					<?php endif ?>
				</a>
			</div>
			<div class="col-lg-8">
				<div class="main-navigation flex-lg-right">
					<ul class="main-menu menu-right ">
						<?= printMenu($pages) ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>