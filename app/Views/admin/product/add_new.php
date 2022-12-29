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
                            <label for="title" required>Title Product (max 150 character)</label>
                            <input type="text" class="form-control <?= show_class_error("title") ?>" id="title" name="title" value="<?= set_value("title") ?>">
                            <?= show_error("title") ?>
                        </div>
                        <div class="form-group">
                            <label for="short_description">Short description</label>
                            <textarea name="short_description" id="short_description" class="form-control"><?= set_value("short_description") ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description" required>Description</label>
                            <textarea name="description" rows="10" id="description" class="form-control <?= show_class_error("description") ?>"><?= set_value("description") ?></textarea>
                            <?= show_error("description") ?>
                        </div>
                        <div class="form-group">
                            <label required>Category</label>
                            <select class="form-control select2 <?= show_class_error("category") ?> select2bs4" style="width: 100%;" name="category">
                                <option <?php if (!set_value("category")) : ?>selected="selected" <?php endif ?> value="">Select Category</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option <?php if (set_value("category") == $category->category_id) : ?> selected="selected" <?php endif ?> value="<?= $category->category_id ?>"><?= $category->category ?></option>
                                <?php endforeach ?>
                            </select>
                            <?= show_error("category") ?>
                        </div>
                        <div class="form-group">
                            <label required>Product Content</label>
                            <textarea id="summernote" name="content">
                                <?= set_value("content") ? set_value("content") : "Place <em>some</em> <u>content</u> <strong>here</strong>" ?>
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
                            <label for="price" required>Stock</label>
                            <input type="number" min="0" class="form-control <?= show_class_error("stock") ?>" name="stock" id="stock" value="<?= set_value("stock") ?>">
                            <?= show_error("stock") ?>
                        </div>
                        <div class="form-group">
                            <label for="sku" required>SKU</label>
                            <input type="text" class="form-control <?= show_class_error("sku") ?>" name="sku" id="sku" value="<?= set_value("sku") ?>">
                            <?= show_error("sku") ?>
                        </div>
                        <div class="form-group">
                            <label for="price" required>Price</label>
                            <input type="number" min="0" class="form-control <?= show_class_error("price") ?>" name="price" id="price" value="<?= set_value("price") ?>">
                            <?= show_error("price") ?>
                        </div>
                        <div class="form-group">
                            <label for="weight" required>Weight (gram)</label>
                            <input type="number" min="0" class="form-control <?= show_class_error("weight") ?>" name="weight" id="weight" value="<?= set_value("weight") ?>">
                            <?= show_error("weight") ?>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="featured" id="featured" <?= set_value("featured") ? "checked" : "" ?>>
                                <label class="custom-control-label" for="featured">
                                    Featured
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="new_label" id="new_label" <?= set_value("new_label") ? "checked" : "" ?>>
                                <label class="custom-control-label" for="new_label">
                                    New label
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="status" id="status" <?= set_value("status") ? "checked" : "" ?>>
                                <label class="custom-control-label" for="status">
                                    Status
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label required>Product Brand<?php echo set_value("brand") ?></label>
                            <select class="form-control select2 <?= show_class_error("brand") ?>" style="width: 100%;" name="brand">
                                <option <?php if (!set_value("brand")) : ?>selected="selected" <?php endif ?> value="">Select Brand</option>
                                <?php foreach ($brands as $brand) : ?>
                                    <option <?php if (set_value("brand") == $brand->brand_id) : ?> selected="selected" <?php endif ?> value="<?= $brand->brand_id ?>"><?= $brand->brand ?></option>
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
                            <div class="mt-2">
                                <img src="#" class="img-thumbnail" alt="No Preview" id="IMAGE_PREVIEW_PRODUCT">
                            </div>
                            <div class="text-danger">
                                <?= isset(session()->getFlashdata("validation")["product_image"]) ? session()->getFlashdata("validation")["product_image"] : ""  ?>
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
                            <label required>Tags</label>
                            <select class="form-control select2 <?= show_class_error("tags") ?> select2bs4" style="width: 100%;" multiple="multiple" name="tags[]">
                                <?php foreach ($tags as $tag) : ?>
                                    <option <?php if (set_value("category") == $tag->tag_id) : ?> selected="selected" <?php endif ?> value="<?= $tag->tag_id ?>"><?= $tag->tag ?></option>
                                <?php endforeach ?>
                            </select>
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

    $("#product_image").on("change", function(e) {
        const reader = new FileReader();
        reader.onload = () => {
            $("#IMAGE_PREVIEW_PRODUCT").attr("src", reader.result)
        }

        reader.readAsDataURL(e.target.files[0])
    })
</script>

<?= $this->endSection() ?>