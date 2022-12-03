<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $title ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url("/private") ?>">Home</a></li>
              <?php foreach($breadcrumbs as $breadcrumb): ?>
                <?php if($breadcrumb != "/" && $breadcrumb != "index"): ?>
                  <li class="breadcrumb-item active"><?= $breadcrumb ?></li>
                <?php endif ?>
              <?php endforeach ?>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>