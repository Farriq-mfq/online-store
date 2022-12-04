<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('/admin/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url("/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url("/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css") ?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url("/admin/plugins/jqvmap/jqvmap.min.css") ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url("/admin/dist/css/adminlte.min.css") ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url("/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css") ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url("/admin/plugins/daterangepicker/daterangepicker.css") ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url("/admin/plugins/summernote/summernote-bs4.min.css") ?>">
  <link rel="stylesheet" href="<?= base_url("/admin/plugins/select2/css/select2.min.css") ?>">
  <link rel="stylesheet" href="<?= base_url("/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") ?>">
  <link rel="stylesheet" href="<?= base_url("/admin/plugins/summernote/summernote-bs4.min.css") ?>">
  <link rel="stylesheet" href="<?= base_url("/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css") ?>">
  <?= $this->renderSection("css") ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <!-- LOAFING -->
    <!-- <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60"> -->
  </div>

  <!-- Navbar -->
  <?= $this->include("Layouts/admin/admin_nav") ?>
  <!-- /.navbar -->

  <!-- Main Sidebar er -->
<?= $this->include("Layouts/admin/admin_sidebar") ?>

    <!-- Content Wrapper. Contains page content -->
    <?= $this->include("Layouts/admin/admin_breadcrumb") ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?= $this->renderSection("content") ?>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url("/admin/plugins/jquery/jquery.min.js") ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url("/admin/plugins/jquery-ui/jquery-ui.min.js") ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url("/admin/plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
<!-- ChartJS -->
<script src="<?= base_url("/admin/plugins/chart.js/Chart.min.js") ?>"></script>
<!-- Sparkline -->
<script src="<?= base_url("/admin/plugins/sparklines/sparkline.js") ?>"></script>
<!-- JQVMap -->
<script src="<?= base_url("/admin/plugins/jqvmap/jquery.vmap.min.js") ?>"></script>
<script src="<?= base_url("/admin/plugins/jqvmap/maps/jquery.vmap.usa.js") ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url("/admin/plugins/jquery-knob/jquery.knob.min.js") ?>"></script>
<!-- daterangepicker -->
<script src="<?= base_url("/admin/plugins/moment/moment.min.js") ?>"></script>
<script src="<?= base_url("/admin/plugins/daterangepicker/daterangepicker.js") ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url("/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js") ?>"></script>
<!-- Summernote -->
<script src="<?= base_url("/admin/plugins/summernote/summernote-bs4.min.js") ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url("/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url("/admin/dist/js/adminlte.js") ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url("/admin/dist/js/demo.js") ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url("/admin/plugins/sweetalert2/sweetalert2.min.js") ?>"></script>
<script src="<?= base_url("/admin/dist/js/pages/dashboard.js") ?>"></script>
<script src="<?= base_url("/admin/plugins/select2/js/select2.full.min.js") ?>"></script>
<script src="<?= base_url("/admin/plugins/summernote/summernote-bs4.min.js") ?>"></script>
<script>
  // custom label
  $("label[required]").each((index)=>{
    const label = $("label[required]")[index];
    label.innerHTML = label.innerText +" <span class='text-danger'>*</span>"
  })
  $('.select2').select2()
  $("#summernote").summernote();
  $(document).on("click",".submit_btn",function(){
    $(this).html("Processing...");
    $(this).prop("disabled",true)
  })
</script>
<?php if(session()->getFlashdata("alert")!=null): ?>
  <?php if(session()->getFlashdata("alert")['type']!=null): ?>
      <script>
        swal.fire({
          icon:"<?= session()->getFlashdata("alert")['type'] ?>",
          title: 'Alert',
          text:"<?= session()->getFlashdata("alert")["message"]!= null ? session()->getFlashdata("alert")["message"]:"" ?>",
        })
        </script>
      <?php else: ?>
      <script>
        swal.fire({
          title: 'Alert',
          text:"<?= session()->getFlashdata("alert")["message"]!= null ? session()->getFlashdata("alert")["message"]:"" ?>",
        })
        </script>
  <?php endif ?>
<?php endif ?>
<?= $this->renderSection("script") ?>
</body>
</html>
