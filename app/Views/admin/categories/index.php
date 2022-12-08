<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-sm btn-primary" data-toggle="modal" type="button" data-target="#modal-category">
                    <i class="fas fa-plus"></i>
                    Add new
                </button>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Category</th>
                      <th>Child Category</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($categories as $category): ?>
                    <tr>
                      <td><?= $category->category ?></td>
                      <td>
                        <?php if (count($category->categories)): ?>
                          <table class="table">
                            <tbody>
                              <?php foreach($category->categories as $c): ?>
                                <tr>
                                  <td>
                                    <span class="badge badge-info">
                                      <?= $c->category ?>
                                    </span>
                                  </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                          </table>
                          <?php else: ?>
                          No Categories Yet
                        <?php endif ?>
                      </td>
                      <td>
                      <button class="btn btn-sm btn-primary" id="btn_show_modal_edit_category" type="button" data-id="<?= $category->category_id ?>">
                          <i class="fas fa-edit"></i>
                      </button>
                        <button class="btn btn-danger btn-sm" confirm  data-slug="<?= $category->category ?>" data-action="<?= admin_url("/categories/".esc($category->category_id)) ?>"><i class="fas fa-trash"></i></button>
                    </td>
                    </tr>
                  <?php endforeach ?>
                  </tbody>
                </table>
              </div>
        </div>
    </div>
</div>
<div class="modal fade " id="modal-category">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add new category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= admin_url("/categories") ?>" method="POST" id="category_form">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category" required>Parent Category</label>
                        <select class="form-control select2" style="width: 100%;" name="parent_category" id="parent_category">
                          <option value="" selected>Select Parent</option>
                          <?php foreach($categories as $category): ?>
                            <option value="<?= $category->category_id ?>"><?= $category->category ?></option>
                          <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category" required>Category</label>
                        <input type="text" class="form-control <?= show_class_error("category") ?>" name="category" id="category">
                        <?= show_error("category") ?>
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
    $(document).on("click","#btn_show_modal_edit_category",function(){
        const id = $(this).data("id");
        $.ajax({
           method:"GET",
           data:{id:id},
           url:"<?= admin_url("/categories/get") ?>",
           beforeSend:()=>{
            $(this).attr("disabled",true)
          },
          complete:()=>{
            $(this).attr("disabled",false)
           },
           success:(data)=>{
            const input_method = $(document.createElement("input")).attr("type","hidden").attr("name","_method").attr("id","ID_METHOD").attr("value","PUT")
            const input_id = $(document.createElement("input")).attr("type","hidden").attr("name","category_id").attr("value",data.category_id)
              $("#category_form").append(input_method)
              $("#category_form").append(input_id)
              $("#parent_category").val(data.parent_category).change()
              $("#category").val(data.category)
             $("#modal-category").modal({show:true})
              $(".modal-title").text("Update category")
            }
          })
      })
        // hide
$("#modal-category").on("hidden.bs.modal",function(){
        $("#ID_METHOD").remove()
      $("input[name='category_id']").remove()
      $("#category").val("")
      $("#parent_category").val("").change()
      $(".modal-title").text("Add new Category")
  })
</script>
<?php if(session()->getFlashdata("validation")): ?>
<script>
    $("#modal-category").modal({show:true})
</script>
<?php endif ?>
<?php if(session()->getFlashdata("update_id")): ?>
<script>
   const input_method = $(document.createElement("input")).attr("type","hidden").attr("name","_method").attr("value","PUT")
    const input_id = $(document.createElement("input")).attr("type","hidden").attr("name","category_id").attr("value","<?= session()->getFlashdata("update_id") ?>")
    $("#category_form").append(input_id)
    $("#category_form").append(input_method)
      $(".modal-title").text("Update Category")
</script>
<?php endif ?>
<?= $this->endSection() ?>