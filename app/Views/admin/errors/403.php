<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="error-page">
        <h2 class="headline text-warning"> 403</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! You don't have permission to access this page.</h3>

          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="<?= admin_url("/") ?>">return to dashboard</a> or try using the search form.
          </p>
        </div>
        <!-- /.error-content -->
      </div>
<?= $this->endSection() ?> 