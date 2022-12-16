<?= $this->extend("Layouts/admin/auth_admin") ?>
<?= $this->section("content") ?>
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <?php if(session()->getFlashdata('error_login')): ?>
        <p class="text-danger login-box-msg"><?= session()->getFlashdata('error_login') ?></p>
      <?php endif ?>

      <form action="<?= admin_url("/auth/login") ?>" method="post">
      <?= csrf_field() ?>
        <div class="input-group mb-3">
          <input type="email" class="form-control <?= show_class_error("email") ?>" placeholder="Email" name="email" value="<?= set_value("email") ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <?= show_error("email") ?>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control <?= show_class_error("password") ?>" placeholder="Password" name="password" value="<?= set_value("password") ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <?= show_error("password") ?>
        </div>
          <!-- /.col -->
          <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<?= $this->endSection() ?> 