<?= $this->extend("Layouts/admin_layout") ?>
<?= $this->section("css") ?>
<!-- css -->
<?= $this->endSection() ?>
<?= $this->section("content") ?>
<?= form_open_multipart(admin_url("/product/new")) ?>
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
                                <option <?php if(!set_value("category")): ?>selected="selected" <?php endif ?> value="">Select Category</option>
                                <?php foreach($categories as $category): ?>
                                        <option <?php if(set_value("category") == $category->category_id): ?> selected="selected" <?php endif ?> value="<?= $category->category_id ?>"><?= $category->category ?></option>
                                    <?php endforeach ?>
                            </select>
                            <?= show_error("category") ?>
                        </div>
                        <div class="form-group">
                            <label required>Product Content</label>
                            <textarea id="summernote" name="content">
                                <?= set_value("content") ?set_value("content"): "Place <em>some</em> <u>content</u> <strong>here</strong>" ?>
                            </textarea>
                            <?= show_error("content") ?>
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
                            <input type="hidden" name="send_input_inventories" value="<?=  session()->getFlashdata("input_inventories") ? session()->getFlashdata("input_inventories") : 1?>">
                            <?php if(session()->getFlashdata("input_inventories")): ?>
                            <?php for ($i=0; $i < session()->getFlashdata("input_inventories") ; $i++): ?>
                           <table class="table" id="table_inventories_add">
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="inventories_size" required>Size</label>
                                            <input type="number" min="0" class="form-control <?= show_class_error("inventories_size.".$i) ?>" name="inventories_size[]" id="inventories_size" value="<?= set_value("inventories_size.".$i) ?>">
                                            <?= show_error("inventories_size.".$i) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="inventories_color" required>Color</label>
                                            <input type="text" class="form-control <?= show_class_error("inventories_color.".$i) ?>" name="inventories_color[]" id="inventories_color" value="<?= set_value("inventories_color.".$i) ?>">
                                            <?= show_error("inventories_color.".$i) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="inventories_stock" required>Stock</label>
                                            <input type="number" class="form-control <?= show_class_error("inventories_stock.".$i) ?>" name="inventories_stock[]" id="inventories_stock" value="<?= set_value("inventories_stock.".$i) ?>">
                                            <?= show_error("inventories_stock.".$i) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="inventories_sku" required>Sku</label>
                                            <input type="number" min="0" class="form-control <?= show_class_error("inventories_sku.".$i) ?>" name="inventories_sku[]" id="inventories_sku" value="<?= set_value("inventories_sku.".$i) ?>">
                                            <?= show_error("inventories_sku.".$i) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="inventories_price" required>Price</label>
                                            <input type="number" min="0" class="form-control <?= show_class_error("inventories_price.".$i) ?>" name="inventories_price[]" id="inventories_price" value="<?= set_value("inventories_price.".$i) ?>">
                                            <?= show_error("inventories_price.".$i) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm mt-4" type="button" id="inventory_btn_plus"><i class="fa fa-plus"></i></button>
                                        <button type="button" class="btn btn-sm btn-secondary mt-4" id="btn_remove_inventories_add"><i class="fa fa-minus"></i></button>
                                    </td>
                                </tr>
                           </table>
                           <?php endfor ?>
                           <?php else: ?>
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
                            <?php endif ?>
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
                                    <input type="checkbox" class="custom-control-input" name="featured" id="featured" <?= set_value("featured") ? "checked":"" ?>>
                                    <label class="custom-control-label" for="featured">
                                        Featured
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="new_label" id="new_label" <?= set_value("new_label") ? "checked":"" ?>>
                                    <label class="custom-control-label" for="new_label">
                                        New label
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="status" id="status" <?= set_value("status") ? "checked":"" ?>>
                                    <label class="custom-control-label" for="status">
                                        Status
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label required>Product Brand<?php echo set_value("brand") ?></label>
                                <select class="form-control select2bs4 <?= show_class_error("brand") ?>" style="width: 100%;" name="brand">
                                    <option <?php if(!set_value("brand")): ?>selected="selected" <?php endif ?> value="">Select Brand</option>
                                    <?php foreach($brands as $brand): ?>
                                        <option <?php if(set_value("brand") == $brand->brand_id): ?> selected="selected" <?php endif ?> value="<?= $brand->brand_id ?>"><?= $brand->brand ?></option>
                                    <?php endforeach ?>
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
                            <label required>
                                Product Images
                            </label>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="product_image">Place Images here</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input <?= show_class_error("product_image") ?>" name="product_image" id="product_image">
                                        <label class="custom-file-label" for="product_images">Choose file</label>
                                    </div>
                                </div>
                                <div class="text-danger">
                                    <?= isset(session()->getFlashdata("validation")["product_image"]) ? session()->getFlashdata("validation")["product_image"]:""  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <label required>
                                Product Tags
                            </label>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tags">Tags ex : #product1,#product2</label>
                                <input type="text" class="form-control <?= show_class_error("tags") ?>" id="tags" name="tags" value="<?= set_value("tags") ?>">                                
                                <?= show_error("tags") ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <button class="btn bg-gradient-primary submit_btn" type="submit">Publish</button>
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
                $("input[name='send_input_inventories']").val(
                    $("input[name='send_input_inventories']").val() > 1 ? parseInt($("input[name='send_input_inventories']").val()) +  1:
                    $(this).parent().parent().parent().children().length
                )
            })
            $(document).on("click","#btn_remove_inventories_add",function(e){
                e.preventDefault();
                if($(this).parent().parent().parent().children().length!=1){
                    $(this).parent().parent().remove()
                    console.log($(this).parent().parent().parent().children().length)
                    $("input[name='send_input_inventories']").val($(this).parent().parent().parent().children().length)
                }
    })
    
</script>

<?= $this->endSection() ?> 