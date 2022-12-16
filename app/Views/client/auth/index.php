<?= $this->extend("Layouts/main_layout") ?>

<?= $this->section("content") ?>
  	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Log in to enter</h3>
                        <?php if(session()->getFlashdata('error_login')): ?>
                            <p class="text-danger"><?= session()->getFlashdata('error_login') ?></p>
                        <?php endif ?>
						<form class="row login_form" action="<?= base_url("/auth/login") ?>" method="post" id="contactForm" novalidate="novalidate">
                        <?= csrf_field() ?>
							<div class="col-md-12 form-group">
								<input type="email" class="form-control <?= show_class_error("email") ?>" id="name" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" autofocus>
                                <?= show_error("email") ?>
							</div>
							<div class="col-md-12 form-group">
                                <input type="text" class="form-control <?= show_class_error("password") ?>" id="name" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                                <?= show_error("password") ?>
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="selector">
									<label for="f-option2">Keep me logged in</label>
								</div>
							</div>
							<div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="primary-btn">Log In</button>
								<a href="#">Forgot Password?</a>
							</div>
                            <div class="col-md-12 form-group">
                                <a class="primary-btn text-white" href="registration.html">Create an Account</a>
                            </div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->
<?= $this->endSection() ?>
<?= $this->section("client_script") ?>
<script>
    console.log("home_view")
</script>
<?= $this->endSection() ?>