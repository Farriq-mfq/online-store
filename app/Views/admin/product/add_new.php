<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<form action="#" method="POST">
    <div class="row">
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title" required>Title Product</label>
                            <input type="text" class="form-control" id="title">
                        </div>
                        <div class="form-group">
                            <label for="short_description">Short description</label>
                            <textarea name="short_description" id="short_description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description" required>Description <span class="text-danger">*</span></label>
                            <textarea name="description" rows="10" id="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label required>Category</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="category">
                                <option selected="selected" value="">Select Category</option>
                                <option>Alaska</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label required>Product Content</label>
                            <textarea id="summernote">
                                Place <em>some</em> <u>content</u> <strong>here</strong>
                            </textarea>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <label required>Inventories</label>
                        </div>
                        <div class="card-body">
                           <table class="table" id="table_inventories_add">
                            <tr>
                                <td>
                                    <button class="btn btn-primary mt-4" type="button" id="inventory_btn_plus">Add New <i class="fa fa-plus"></i></button>
                                </td>
                            </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="inventories_size" required>Size</label>
                                            <input type="number" min="0" class="form-control" name="inventories_size[]" id="inventories_size">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="inventories_color" required>Color</label>
                                            <input type="text" class="form-control" name="inventories_color[]" id="inventories_color">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="inventories_sku" required>Sku</label>
                                            <input type="number" min="0" class="form-control" name="inventories_sku[]" id="inventories_sku">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="inventories_price" required>Price</label>
                                            <input type="number" min="0" class="form-control" name="inventories_price[]" id="inventories_price">
                                        </div>
                                    </td>
                                </tr>
                           </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="price" required>Price</label>
                                <input type="number" min="0" class="form-control" name="price" id="price">
                            </div>
                            <div class="form-group">
                                <label for="weight" required>Weight</label>
                                <input type="number" min="0" class="form-control" name="weight" id="weight">
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="featured" id="featured">
                                    <label class="custom-control-label" required for="featured">
                                        Featured
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="new_label" id="new_label">
                                    <label class="custom-control-label" required for="new_label">
                                        New label
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="status" id="status">
                                    <label class="custom-control-label" required for="status">
                                        Status
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label required>Product Brand</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="brand">
                                    <option selected="selected" value="">Select Brand</option>
                                    <option>Alaska</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>



<?= $this->endSection() ?>
<?= $this->section("script") ?>
<script>
    $("#inventory_btn_plus").bind("click",function(e){
        console.log($(this))
    })
    $("#inventory_btn_plus").on("click",function(e){
        e.preventDefault();
         $("#table_inventories_add").append(`<tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="inventories_size" required>Size</label>
                                            <input type="number" min="0" class="form-control" name="inventories_size[]" id="inventories_size">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="inventories_color" required>Color</label>
                                            <input type="text" class="form-control" name="inventories_color[]" id="inventories_color">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="inventories_sku" required>Sku</label>
                                            <input type="number" min="0" class="form-control" name="inventories_sku[]" id="inventories_sku">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="inventories_price" required>Price</label>
                                            <input type="number" min="0" class="form-control" name="inventories_price[]" id="inventories_price">
                                        </div>
                                    </td>
                                </tr>`);
    })
</script>
<?= $this->endSection() ?> 