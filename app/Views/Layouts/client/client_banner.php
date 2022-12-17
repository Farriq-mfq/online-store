<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1><?= $title ?></h1>
					<nav class="d-flex align-items-center">
						<a href="<?= base_url("/") ?>">Home<span class="lnr lnr-arrow-right"></span></a>
					<?php foreach($breadcrumbs as $breadcrumb): ?>
						<?php if($breadcrumb != "/" && $breadcrumb != "index"): ?>
							<a href="#"><?= $breadcrumb ?>
							<?php if(end($breadcrumbs) != $breadcrumb && end($breadcrumbs)!="index"): ?>
							<span class="lnr lnr-arrow-right"></span>
							<?php endif ?>
							</a>
						<?php endif ?>
					<?php endforeach ?>
					</nav>
				</div>
			</div>
		</div>
	</section>

	