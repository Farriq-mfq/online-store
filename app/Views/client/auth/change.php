<?= $this->extend("Layouts/main_layout") ?>

<?= $this->section("content") ?>
<main class="page-section inner-page-sec-padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                <form action="<?= base_url('/auth/password/change/' . $code) ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="login-form">
                        <h4 class="login-title">Change Your Password</h4>
                        <?php if (session()->getFlashdata("error_login")) : ?>
                            <p><span class="font-weight-bold text-danger"><?= session()->getFlashdata("error_login") ?></span></p>
                        <?php endif ?>
                        <div class="row">
                            <div class="col-md-12 col-12 mb--15">
                                <label for="email">Enter your password here...</label>
                                <input class="mb-0 form-control <?= show_class_error("password") ?>" type="password" name="password" id="password1" placeholder="Enter you password here...">
                                <?= show_error("password") ?>
                            </div>
                            <div class="col-md-12 col-12 mb--15">
                                <label for="email">Enter your confirm password here...</label>
                                <input class="mb-0 form-control <?= show_class_error("confirm_password") ?>" type="confirm_password" name="confirm_password" id="confirm_password1" placeholder="Enter you Confirm password here...">
                                <?= show_error("confirm_password") ?>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-outlined">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>
<?= $this->section("client_script") ?>
<script>
    console.log("home_view")
</script>
<?= $this->endSection() ?>