<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Inventories</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product): ?>
                            <tr>
                                <td>
                                    <?= $product->title ?> 
                                    <button class="btn btn-sm btn-primary" id="plus_inventories" type="button" data-id="<?= $product->product_id ?>" data-action="<?= admin_url("/product/inventories/".$product->product_id) ?>"><i class="fas fa-plus"></i></button> 
                                </td>
                                <td>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Size</th>
                                                <th>Color</th>
                                                <th>SKU</th>
                                                <th>Stock</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($product->product_inventories as $inventory): ?>
                                            <tr>
                                                <td><?= $inventory->size ?></td>
                                                <td><?= $inventory->color ?></td>
                                                <td><?= $inventory->sku ?></td>
                                                <td><?= $inventory->stock ?></td>
                                                <td><?= $inventory->price ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button> 
                                <button class="btn btn-danger btn-sm" confirm  data-slug="<?= $inventory->color ?>" data-action="<?= admin_url("/product/inventories/".esc($inventory->inventory_id)) ?>"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-inventories">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Default Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="FORM_INVENTORIES" action="<?= session()->getFlashdata("action_session_inventories")?session()->getFlashdata("action_session_inventories"):"" ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label required>Size</label>
                        <input type="number" class="form-control <?= show_class_error("size") ?>" name="size" value="<?= set_value("size") ?>">    
                        <?= show_error("size") ?>
                    </div>
                    <div class="form-group">
                        <label required>Color</label>
                        <input type="text" class="form-control <?= show_class_error("color") ?>" name="color" value="<?= set_value("color") ?>">    
                        <?= show_error("color") ?>
                    </div>
                    <div class="form-group">
                        <label required>SKU</label>
                        <input type="number" class="form-control <?= show_class_error("sku") ?>" name="sku" value="<?= set_value("sku") ?>">    
                        <?= show_error("sku") ?>
                    </div>
                    <div class="form-group">
                        <label required>Stock</label>
                        <input type="number" class="form-control <?= show_class_error("stock") ?>" name="stock" value="<?= set_value("stock") ?>">    
                        <?= show_error("stock") ?>
                    </div>
                    <div class="form-group">
                        <label required>Price</label>
                        <input type="number" class="form-control <?= show_class_error("price") ?>" name="price" value="<?= set_value("price") ?>">    
                        <?= show_error("price") ?>
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Save</button>
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
    $(document).on("click","#plus_inventories",function(e){
        e.preventDefault();
        $("#modal-inventories").modal({show:true})
        $("#FORM_INVENTORIES").attr("action",$(this).data('action'))
        console.log($(this).data("id"))
    })
    
    $("#modal-inventories").on("hidden.bs.modal",function(){
        $("#FORM_INVENTORIES")[0].reset()
    })
    
    <?php if(session()->getFlashdata("validation")): ?>
        $("#modal-inventories").modal({show:true})
    <?php endif ?>
</script>
<?= $this->endSection() ?> 