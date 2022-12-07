<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-sm btn-primary" data-toggle="modal" type="button" data-target="#modal-add-brand">
                    <i class="fas fa-plus"></i>
                    Add new
                </button>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Brand</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($brands as $brand): ?>
                  <tr>
                    <td><?= $brand->brand ?></td>
                    <td>
                      <a href="<?= admin_url("/brand/".esc($brand->brand_id)."/edit") ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
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
<div class="modal fade " id="modal-add-brand">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add new Brand</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= admin_url("/brands") ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form">
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
<?php if(session()->getFlashdata("validation")): ?>
<script>
    $("#modal-add-brand").modal({show:true})
</script>
<?php endif ?>
<?= $this->endSection() ?>