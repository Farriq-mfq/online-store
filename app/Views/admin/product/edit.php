<?= $this->extend("Layouts/admin_layout") ?>
<?= $this->section("css") ?>
<!-- css -->
<?= $this->endSection() ?>
<?= $this->section("content") ?>
<?= form_open_multipart(admin_url("/product/".$product->product_id)) ?>
<?= csrf_field() ?>
<input type="hidden" name="_method" value="PUT">
    <div class="row">
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title" required>Title Product</label>
                            <input type="text" class="form-control <?= show_class_error("title") ?>" id="title" name="title" value="<?= set_value("title") ? set_value("title"):$product->title ?> ">
                            <?= show_error("title") ?>
                        </div>
                        <div class="form-group">
                            <label for="short_description">Short description</label>
                            <textarea name="short_description" id="short_description" class="form-control"><?= set_value("description") ? set_value("short_description"):$product->short_description ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description" required>Description</label>
                            <textarea name="description" rows="10" id="description" class="form-control <?= show_class_error("description") ?>"><?= set_value("description") ? set_value("description"):$product->description ?></textarea>
                            <?= show_error("description") ?>
                        </div>
                        <div class="form-group">
                            <label required>Category</label>
                            <select class="form-control select2 <?= show_class_error("category") ?> select2bs4" style="width: 100%;" name="category">
                            <?php foreach($categories as $category): ?>
                                <?php if($category->category_id == $product->category_id): ?>
                                    <option selected="selected" value="<?= $category->category_id ?>"><?= $category->category ?></option>
                                    <?php else: ?>
                                        <option <?php if(set_value("category") == $category->category_id): ?> selected="selected" <?php endif ?> value="<?= $category->category_id ?>"><?= $category->category ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                            <?= show_error("category") ?>
                        </div>
                        <div class="form-group">
                            <label required>Product Content</label>
                            <textarea id="summernote" name="content">
                                <?= set_value("content") ?set_value("content"): $product->content ?>
                            </textarea>
                            <?= show_error("content") ?>
                        </div>
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
                                <input type="number" min="0" class="form-control <?= show_class_error("price") ?>" name="price" id="price" value="<?= set_value("price") ? set_value("price") : $product->price?>">
                                <?= show_error("price") ?>
                            </div>
                            <div class="form-group">
                                <label for="weight" required>Weight</label>
                                <input type="number" min="0" class="form-control <?= show_class_error("weight") ?>" name="weight" id="weight" value="<?= set_value("weight")? set_value("weight") : $product->weight ?>">
                                <?= show_error("weight") ?>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="featured" id="featured" <?= set_value("featured") || $product->featured ? "checked":"" ?>>
                                    <label class="custom-control-label" for="featured">
                                        Featured
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="new_label" id="new_label" <?= set_value("new_label")|| $product->new_label ? "checked":"" ?>>
                                    <label class="custom-control-label" for="new_label">
                                        New label
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="status" id="status" <?= set_value("status") || $product->status ? "checked":"" ?>>
                                    <label class="custom-control-label" for="status">
                                        Status
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label required>Product Brand<?php echo set_value("brand") ?></label>
                                <select class="form-control select2 <?= show_class_error("brand") ?>" style="width: 100%;" name="brand">
                                    <?php foreach($brands as $brand): ?>
                                        <?php if($brand->brand_id == $product->brand_id): ?>
                                            <option selected="selected" value="<?= $brand->brand_id ?>"><?= $brand->brand ?></option>
                                            <?php else: ?>
                                                <option <?php if(set_value("brand") == $brand->brand_id): ?> selected="selected" <?php endif ?> value="<?= $brand->brand_id ?>"><?= $brand->brand ?></option>
                                            <?php endif ?>
                                    <?php endforeach ?>
                                </select>
                                <?= show_error("brand") ?>
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