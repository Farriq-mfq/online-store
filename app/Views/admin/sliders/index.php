<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-sm btn-primary" id="PLUS_IMAGES" type="button"><i class="fas fa-plus"></i> Add Slider</button>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Images</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td>
                                    <?= $product->title ?>
                                </td>
                                <td>
                                    <div class="row">
                                        <?php foreach ($product->product_images as $image) : ?>
                                            <div class="col-md-4">
                                                <div class="card <?php if ($image->is_primary) : ?>border border-primary<?php endif ?>">
                                                    <div class="card-body">
                                                        <img src="<?= $image->image ?>" alt="" class="img-thumbnail img-responsive">
                                                    </div>
                                                    <div class="card-footer">
                                                        <button class="btn btn-sm btn-primary" type="button" data-id="<?= $image->image_id ?>" data-action="<?= admin_url("/product/images/" . $image->image_id) ?>" id="BTN_EDIT_IMAGES"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-danger btn-sm" confirm data-slug="<?= $image->mime ?>" data-action="<?= admin_url("/product/images/" . esc($image->image_id)) ?>"><i class="fas fa-trash"></i></button>
                                                        <?php if (!$image->is_primary) : ?>
                                                            <form method="POST" class="d-inline" action="<?= admin_url("/product/images/" . $image->image_id . "/primary") ?>">
                                                                <?php csrf_field() ?>
                                                                <button class="btn btn-warning btn-sm" type="submit"><i class="fas fa-star"></i></button>
                                                            </form>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-images">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="FORM_SLIDER" action="<?= admin_url("/slider") ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title" required>Title (max 50 character)</label>
                        <input type="text" class="form-control <?= show_class_error("title") ?>" id="title" name="title" value="<?= set_value("title") ?>">
                        <?= show_error("title") ?>
                    </div>
                    <div class="form-group">
                        <label for="subtitle" required>Subtitle (max 50 character)</label>
                        <input type="text" class="form-control <?= show_class_error("subtitle") ?>" id="subtitle" name="subtitle" value="<?= set_value("subtitle") ?>">
                        <?= show_error("subtitle") ?>
                    </div>
                    <div class="form-group">
                        <label for="subtitlecolor" required>Subtitle Color (max 50 character)</label>
                        <input type="color" class="form-control <?= show_class_error("subtitlecolor") ?>" id="subtitlecolor" name="subtitlecolor" value="<?= set_value("subtitlecolor") ?>">
                        <?= show_error("subtitlecolor") ?>
                    </div>
                    <div class="form-group">
                        <label required>Image (width : 770 & height : 494)</label>
                        <input type="file" class="form-control <?= show_class_error("image") ?>" name="image" id="image">
                        <?= show_error("image") ?>
                    </div>
                    <div class="form-group">
                        <img src="#" class="img-thumbnail" alt="No Preview" id="IMAGE_PREVIEW">
                    </div>
                    <div class="form-group">
                        <label for="short_description" required>Short description</label>
                        <textarea name="short_description" id="short_description" class="form-control <?= show_class_error("short_description") ?>"><?= set_value("short_description") ?></textarea>
                        <?= show_error("short_description") ?>
                    </div>
                    <div class="form-group">
                        <label for="link_label" required>Link Label (max 20 character)</label>
                        <input type="text" class="form-control <?= show_class_error("link_label") ?>" id="link_label" name="link_label" value="<?= set_value("link_label") ?>">
                        <?= show_error("link_label") ?>
                    </div>
                    <div class="form-group">
                        <label for="link" required>Link (max 150 character)</label>
                        <input type="text" class="form-control <?= show_class_error("link") ?>" id="link" name="link" value="<?= set_value("link") ?>">
                        <?= show_error("link") ?>
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
<script <?= csp_script_nonce() ?>>
    $("#PLUS_IMAGES").on("click", function(e) {
        e.preventDefault();
        $("#modal-images").modal({
            show: true
        })
    })

    $("#modal-images").on("hidden.bs.modal", function() {
        $("#FORM_images")[0].reset()
        $("#IMAGE_METHOD_SPOFF").remove()
        $("#FORM_images").children().find(".invalid-feedback").remove()
        $("#IMAGE_PREVIEW").attr("src", "")
        $("#FORM_images").children().find(".is-invalid").removeClass("is-invalid")
    })

    $(document).on("click", "#BTN_EDIT_IMAGES", function(e) {
        e.preventDefault();
        const id = $(this).data("id");
        const action = $(this).data("action");
        $.ajax({
            method: "GET",
            data: {
                id: id
            },
            url: "<?= admin_url("/product/images/edit") ?>",
            success: (data) => {
                const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "IMAGE_METHOD_SPOFF").attr("value", "PUT")
                $("#FORM_images").append(input_method)
                $("#FORM_images").attr("action", action)
                $("#IMAGE_PREVIEW").attr("src", data.image)
                $("#modal-images").modal({
                    show: true
                })
            }
        })
    })
    $("#image").on("change", function(e) {
        const reader = new FileReader();
        const file = this.files[0];
        if (file.type.match(/image\/.*/)) {
            reader.onload = function() {
                var $img = $("#IMAGE_PREVIEW").attr({
                    src: reader.result
                });
            }

            reader.readAsDataURL(file);
        }

    })

    <?php if (session()->getFlashdata("METHOD_UPDATE_SESSION")) : ?>
        const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "IMAGES_METHOD_SPOFF").attr("value", "PUT")
        $("#FORM_images").append(input_method)
    <?php endif ?>

    <?php if (session()->getFlashdata("validation")) : ?>
        $("#modal-images").modal({
            show: true
        })
    <?php endif ?>
</script>
<?= $this->endSection() ?>