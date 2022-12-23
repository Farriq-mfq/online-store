<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-sm btn-primary" id="PLUS_BANNER" type="button"><i class="fas fa-plus"></i> Add Banner</button>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Banner Location</th>
                            <th>Title</th>
                            <th>Paragraph</th>
                            <th>Label</th>
                            <th>Link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($banners as $banner) : ?>
                            <tr>
                                <td>
                                    <?= $banner->banner_location ?>
                                </td>
                                <td>
                                    <img src="<?= $banner->image ?>" alt="" class="img-thumbnail img-responsive" width="100" height="100">
                                </td>
                                <td> <?= $banner->title != null ? $banner->title : "No title" ?></td>
                                <td> <?= $banner->paragraph != null ? $banner->paragraph : "No Paragraph" ?></td>
                                <td> <?= $banner->link_label != null ? $banner->link_label : "No Label" ?></td>
                                <td> <?= $banner->link ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary" id="btn_show_modal_edit_banner" type="button" data-id="<?= $banner->banner_id ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" confirm data-slug="<?= $banner->banner_location ?>" data-action="<?= admin_url("/banner/" . esc($banner->banner_id)) ?>"><i class="fas fa-trash"></i></button>
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
            <form id="FORM_BANNER" action="<?= admin_url("/banner") ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label required>Type</label>
                        <select name="banner_location" id="banner_location" class="form-control <?= show_class_error("banner_location") ?>">
                            <option value="">Select Banner Location</option>
                            <option value="BOTTOM_SLIDER">BOTTOM SLIDER</option>
                            <option value="BOTTOM_OFFER">BOTTOM OFFER</option>
                            <option value="LONG_BANNER">LONG BANNER</option>
                        </select>
                        <?= show_error("banner_location") ?>
                    </div>
                    <div class="form-group">
                        <span class="text-red d-block" id="SHOW_DIMENSION"></span>
                        <label required>Image</label>
                        <input type="file" class="form-control <?= show_class_error("image") ?>" name="image" id="image">
                        <?= show_error("image") ?>
                    </div>
                    <div class="form-group">
                        <img src="#" class="img-thumbnail" alt="No Preview" id="IMAGE_PREVIEW">
                    </div>
                    <div class="form-group">
                        <label for="title">Title (max 50 character)</label>
                        <input type="text" class="form-control <?= show_class_error("title") ?>" id="title" name="title" value="<?= set_value("title") ?>">
                        <?= show_error("title") ?>
                    </div>
                    <div class="form-group">
                        <label for="paragraph">Paragraph (max 150 character)</label>
                        <textarea name="paragraph" id="paragraph" class="form-control <?= show_class_error("paragraph") ?>"><?= set_value("paragraph") ?></textarea>
                        <?= show_error("paragraph") ?>
                    </div>
                    <div class="form-group">
                        <label for="link_label">Link Label (max 20 character)</label>
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
    $("#PLUS_BANNER").on("click", function(e) {
        e.preventDefault();
        $("#modal-images").modal({
            show: true
        })
    })

    // change banner dimension
    $("#banner_location").change(function(e) {
        e.preventDefault();
        switch ($(this).val()) {
            case "BOTTOM_SLIDER":
                $("#SHOW_DIMENSION").text("DIMENSION : 540 x 170")
                break;
            case "BOTTOM_OFFER":
                $("#SHOW_DIMENSION").text("DIMENSION : 370 x 160")
                break;
            case "LONG_BANNER":
                $("#SHOW_DIMENSION").text("DIMENSION : 1170 x 240")
                break;
            default:
                $("#SHOW_DIMENSION").text("")
                break;
        }
    })

    $("#modal-images").on("hidden.bs.modal", function() {
        $("#FORM_BANNER")[0].reset()
        $("#BANNER_METHOD_SPOFF").remove()
        $("#BANNER_id").remove()
        $("#FORM_BANNER").children().find(".invalid-feedback").remove()
        $("#IMAGE_PREVIEW").attr("src", "")
        $("#FORM_BANNER").children().find(".is-invalid").removeClass("is-invalid")
        $("select[name='banner_location']").attr("disabled",false);
    })

    $(document).on("click", "#btn_show_modal_edit_banner", function(e) {
        e.preventDefault();
        const id = $(this).data("id");
        $.ajax({
            method: "GET",
            data: {
                id: id
            },
            url: "<?= admin_url("/banner/edit") ?>",
            success: (data) => {
                const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "BANNER_METHOD_SPOFF").attr("value", "PUT")
                const input_id = $(document.createElement("input")).attr("type", "hidden").attr("name", "banner_id").attr("id", "BANNER_id").attr("value", id)
                $("#FORM_BANNER").append(input_method)
                $("#FORM_BANNER").append(input_id)
                $("#IMAGE_PREVIEW").attr("src", data.image)
                $("select[name='banner_location']").attr("disabled",true);
                $("select[name='banner_location']").val(data.banner_location);
                $("input[name='title']").val(data.title);
                $("textarea[name='paragraph']").val(data.paragraph);
                $("input[name='link_label']").val(data.link_label);
                $("input[name='link']").val(data.link);
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


    <?php if (session()->getFlashdata("validation")) : ?>
        $("#modal-images").modal({
            show: true
        })
    <?php endif ?>
</script>
<?php if (session()->getFlashdata("update_id")) : ?>
    <script <?= csp_script_nonce() ?>>
        const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "BANNER_METHOD_SPOFF").attr("value", "PUT")
        const input_id = $(document.createElement("input")).attr("type", "hidden").attr("name", "banner_id").attr("id", "BANNER_id").attr("value", "<?= session()->getFlashdata("update_id") ?>")
        $("#FORM_BANNER").append(input_method)
        $("#FORM_BANNER").append(input_id)
    </script>
<?php endif ?>
<?= $this->endSection() ?>