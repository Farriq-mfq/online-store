<?= $this->extend("Layouts/admin_layout") ?>
<?= $this->section("css") ?>
<!-- css -->
<?= $this->endSection() ?>
<?= $this->section("content") ?>
<?= form_open(base_url("/private/product/new")) ?>
<?= csrf_field() ?>
    <div class="row">
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title" required>Title Product</label>
                            <input type="text" class="form-control <?= show_class_error("title") ?>" id="title" name="title" value="<?= set_value("title") ?>">
                            <?= show_error("title") ?>
                        </div>
                        <div class="form-group">
                            <label for="short_description">Short description</label>
                            <textarea name="short_description" id="short_description" class="form-control"><?= set_value("short_description") ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description" required>Description <span class="text-danger">*</span></label>
                            <textarea name="description" rows="10" id="description" class="form-control <?= show_class_error("description") ?>"><?= set_value("description") ?></textarea>
                            <?= show_error("description") ?>
                        </div>
                        <div class="form-group">
                            <label required>Category</label>
                            <select class="form-control <?= show_class_error("category") ?> select2bs4" style="width: 100%;" name="category">
                                <option selected="selected" value="<?= set_value("category") ?>"><?= set_value("category") ? set_value("category"):"Select Category" ?></option>
                                <option>Alaska</option>
                            </select>
                            <?= show_error("category") ?>
                        </div>
                        <div class="form-group">
                            <label required>Product Content</label>
                            <textarea id="summernote" name="content">
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
                            <?php if(session()->getFlashdata("validation")): ?>
                                <?= show_array_errors(show_array_contains(session()->getFlashdata("validation"),"inventories_size"),"Size"); ?>
                                <?= show_array_errors(show_array_contains(session()->getFlashdata("validation"),"inventories_color"),"COlor"); ?>
                                <?= show_array_errors(show_array_contains(session()->getFlashdata("validation"),"inventories_stock"),"Stock"); ?>
                                <?= show_array_errors(show_array_contains(session()->getFlashdata("validation"),"inventories_sku"),"SKU"); ?>
                                <?= show_array_errors(show_array_contains(session()->getFlashdata("validation"),"inventories_price"),"Price"); ?>
                            <?php endif ?>
                           <table class="table" id="table_inventories_add">
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
                                            <label for="inventories_stock" required>Stock</label>
                                            <input type="number" class="form-control" name="inventories_stock[]" id="inventories_color">
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
                                    <td>
                                        <button class="btn btn-primary btn-sm mt-4" type="button" id="inventory_btn_plus"><i class="fa fa-plus"></i></button>
                                        <button type="button" class="btn btn-sm btn-secondary mt-4" id="btn_remove_inventories_add"><i class="fa fa-minus"></i></button>
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
                                <input type="number" min="0" class="form-control <?= show_class_error("price") ?>" name="price" id="price" value="<?= set_value("price") ?>">
                                <?= show_error("price") ?>
                            </div>
                            <div class="form-group">
                                <label for="weight" required>Weight</label>
                                <input type="number" min="0" class="form-control <?= show_class_error("weight") ?>" name="weight" id="weight" value="<?= set_value("weight") ?>">
                                <?= show_error("weight") ?>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="featured" id="featured">
                                    <label class="custom-control-label" for="featured">
                                        Featured
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="new_label" id="new_label">
                                    <label class="custom-control-label" for="new_label">
                                        New label
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="status" id="status">
                                    <label class="custom-control-label" for="status">
                                        Status
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label required>Product Brand</label>
                                <select class="form-control select2bs4 <?= show_class_error("weight") ?>" style="width: 100%;" name="brand">
                                    <option selected="selected" value="">Select Brand</option>
                                    <option value="alaska">Alaska</option>
                                </select>
                                <?= show_error("brand") ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <label>
                                Product Meta & SEO
                            </label>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="meta_title">Meta title</label>
                                <input type="text" class="form-control" id="meta_title">                                
                            </div>
                            <div class="form-group">
                                <label>Meta description</label>
                                <textarea class="form-control" name="meta_description">
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <label>
                                Product Tags
                            </label>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tags">Tags ex : #product1,#product2</label>
                                <input type="text" class="form-control <?= show_class_error("tags") ?>" id="tags" name="tags">                                
                                <?= show_error("tags") ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <button class="btn bg-gradient-primary" type="submit">Publish</button>
            </div>
        </div>
    </div>
<?= form_close() ?>
</form>



<?= $this->endSection() ?>
<?= $this->section("script") ?>
<script>

    $(document).on("click","#inventory_btn_plus",function(e){
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
                                            <label for="inventories_stock" required>Stock</label>
                                            <input type="number" class="form-control" name="inventories_stock[]" id="inventories_color">
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
                                    <td>
                                        <button class="btn btn-primary btn-sm mt-4" type="button" id="inventory_btn_plus"><i class="fa fa-plus"></i></button>
                                        <button type="button" class="btn btn-sm btn-secondary mt-4" id="btn_remove_inventories_add"><i class="fa fa-minus"></i></button>
                                    </td>
                                </tr>`);
    })
    $(document).on("click","#btn_remove_inventories_add",function(e){
        e.preventDefault();
        if($(this).parent().parent().parent().children().length!=1){
            $(this).parent().parent().remove()
        }
    })
    
</script>

<?= $this->endSection() ?> 