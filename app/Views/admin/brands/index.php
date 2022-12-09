<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-sm btn-primary" data-toggle="modal" type="button" data-target="#modal-brand">
                    <i class="fas fa-plus"></i>
                    Add new
                </button>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Brand</th>
                      <th>On Products</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($brands as $brand): ?>
                  <tr>
                    <td><?= $brand->brand ?></td>
                    <td><?= count($brand->products) ?></td>
                    <td>
                    <button class="btn btn-sm btn-primary" id="btn_show_modal_edit_brand" type="button" data-id="<?= $brand->brand_id ?>">
                        <i class="fas fa-edit"></i>
                    </button>
                      <button class="btn btn-danger btn-sm" confirm  data-slug="<?= $brand->brand ?>" data-action="<?= admin_url("/brands/".esc($brand->brand_id)) ?>"><i class="fas fa-trash"></i></button>
                    </td>
                  </tr>
                  <?php endforeach ?>
                  </tbody>
                </table>
              </div>
        </div>
    </div>
</div>
<div class="modal fade " id="modal-brand">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add new Brand</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= admin_url("/brands") ?>" method="POST" id="brand_form">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="brand" required>Brand</label>
                        <input type="text" class="form-control <?= show_class_error("brand") ?>" name="brand" id="brand">
                        <?= show_error("brand") ?>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<?= $this->endSection() ?>
<?= $this->section("script") ?>
<script>
    $(document).on("click","#btn_show_modal_edit_brand",function(){
        const id = $(this).data("id");
        $.ajax({
           method:"GET",
           data:{id:id},
           url:"<?= admin_url("/brands/get") ?>",
           success:(data)=>{
            const input_method = $(document.createElement("input")).attr("type","hidden").attr("name","_method").attr("id","BRAND_METHOD").attr("value","PUT")
            const input_id = $(document.createElement("input")).attr("type","hidden").attr("name","brand_id").attr("value",id)
              $("#brand_form").append(input_method)
              $("#brand_form").append(input_id)
              $("#brand").val(data.brand)
             $("#modal-brand").modal({show:true})
              $(".modal-title").text("Update Brand")
            }
          })
        })
        // hide
$("#modal-brand").on("hidden.bs.modal",function(){
          $("#BRAND_METHOD").remove()
          $("input[name='brand_id']").remove()
          $("#brand_form")[0].reset()
          $(".modal-title").text("Add new Brand")
  })
</script>
<?php if(session()->getFlashdata("validation")): ?>
<script>
    $("#modal-brand").modal({show:true})
</script>
<?php endif ?>
<?php if(session()->getFlashdata("update_id")): ?>
<script>
   const input_method = $(document.createElement("input")).attr("type","hidden").attr("name","_method").attr("value","PUT")
    const input_id = $(document.createElement("input")).attr("type","hidden").attr("name","brand_id").attr("value","<?= session()->getFlashdata("update_id") ?>")
      $("#brand_form").append(input_method)
      $("#brand_form").append(input_id)
      $(".modal-title").text("Update Brand")
</script>
<?php endif ?>
<?= $this->endSection() ?>