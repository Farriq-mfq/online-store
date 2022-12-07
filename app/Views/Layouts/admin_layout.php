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
  <link rel="stylesheet" href="<?= base_url("/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") ?>">
  <link rel="stylesheet" href="<?= base_url("/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") ?>">
  <link rel="stylesheet" href="<?= base_url("/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css") ?>">
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
      <!-- modal global -->
      <div class="modal fade" id="global_confirm">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Confirm Your Action</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="form_modal_global" method="POST">
              <?= csrf_field() ?>
              <input type="hidden" name="_method" value="DELETE" />
              <div class="modal-body">
                <p>Please type <b id="bold_slug_global"></b> to confirm</p>
                <div class="form-group">
                  <input type="hidden" name="confirm_field">
                  <input type="text" class="form-control" name="confirm_input">
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" id="btn_global_confirm" disabled>Delete</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
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
<script src="<?= base_url("/admin/plugins/datatables/jquery.dataTables.min.js") ?>"></script>
<script src="<?= base_url("/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") ?>"></script>
<script src="<?= base_url("/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js") ?>"></script>
<script src="<?= base_url("/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") ?>"></script>
<script src="<?= base_url("/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js") ?>"></script>
<script src="<?= base_url("/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js") ?>"></script>
<script src="<?= base_url("/admin/plugins/jquery-validation/jquery.validate.min.js") ?>"></script>
<script src="<?= base_url("/admin/plugins/jquery-validation/additional-methods.min.js") ?>"></script>
<script>
  // custom label
  $("label[required]").each((index)=>{
    const label = $("label[required]")[index];
    label.innerHTML = label.innerText +" <span class='text-danger'>*</span>"
  })
  $('.select2').select2()
  $("#summernote").summernote();
  $('#example1').DataTable();
  $(document).on("click","button[confirm]",function(e){
    $slug = $(this).data("slug");
    $action = $(this).data("action");
    $("#form_modal_global").attr("action",$action);
    $("#bold_slug_global").text($(this).data("slug"));
    $("input[name='confirm_field']").val($(this).data("slug"));
    $("#global_confirm").modal({show:true})
  })
  $("#global_confirm").on("hidden.bs.modal",function(){
    $("input[name='confirm_input']").val("");
    $("input[name='confirm_input']").removeClass("is-invalid");
    $("input[name='confirm_input']").removeAttr("aria-describedby");
    $("#confirm_input-error").remove();
    $("#btn_global_confirm").attr("disabled",true);
  })

  // validate
  $.validator.addMethod("checkLabel",function(value,element){
    if(value ==  $("input[name='confirm_field']").val()){
      return true;
    }
    return false;
  },"Confirm invalid")

  $("#form_modal_global").validate({
    rules:{
      confirm_input:{
        required:true,
        checkLabel:true
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    },
    success: function() {
      $("#btn_global_confirm").attr("disabled",false);
    }
  })
</script>
<?php if(session()->getFlashdata("alert")!=null): ?>
  <?php if(session()->getFlashdata("alert")['type']!=null): ?>
      <script>
        swal.fire({
          icon:"<?= session()->getFlashdata("alert")['type'] ?>",
          title: 'Info',
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
