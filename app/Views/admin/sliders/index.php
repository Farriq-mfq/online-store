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
                            <th>Image</th>
                            <th>Subtitle</th>
                            <th>Subtitle Color</th>
                            <th>Short Description</th>
                            <th>Link Label</th>
                            <th>Link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sliders as $slider) : ?>
                            <tr>
                                <td>
                                    <?= $slider->title ?>
                                </td>
                                <td>
                                    <img src="<?= $slider->image ?>" alt="" class="img-thumbnail img-responsive" width="100" height="100">
                                </td>
                                <td> <?= $slider->subtitle ?></td>
                                <td>
                                    <div style="background-color: <?= $slider->subtitle_color ?>; height: 50px;width: 50px;">

                                    </div>
                                </td>
                                <td> <?= $slider->short_description ?></td>
                                <td> <?= $slider->link_label ?></td>
                                <td> <?= $slider->link ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary" id="btn_show_modal_edit_slider" type="button" data-id="<?= $slider->slider_id ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" confirm data-slug="<?= $slider->title ?>" data-action="<?= admin_url("/slider/" . esc($slider->slider_id)) ?>"><i class="fas fa-trash"></i></button>
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
        $("#FORM_SLIDER")[0].reset()
        $("#SLIDER_METHOD_SPOFF").remove()
        $("#slider_id").remove()
        $("#FORM_SLIDER").children().find(".invalid-feedback").remove()
        $("#IMAGE_PREVIEW").attr("src", "")
        $("#FORM_SLIDER").children().find(".is-invalid").removeClass("is-invalid")
    })

    $(document).on("click", "#btn_show_modal_edit_slider", function(e) {
        e.preventDefault();
        const id = $(this).data("id");
        $.ajax({
            method: "GET",
            data: {
                id: id
            },
            url: "<?= admin_url("/slider/edit") ?>",
            success: (data) => {
                const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "SLIDER_METHOD_SPOFF").attr("value", "PUT")
                const input_id = $(document.createElement("input")).attr("type", "hidden").attr("name", "slider_id").attr("id","slider_id").attr("value", id)
                $("#FORM_SLIDER").append(input_method)
                $("#FORM_SLIDER").append(input_id)
                $("#IMAGE_PREVIEW").attr("src", data.image)
                $("input[name='title']").val(data.title);
                $("input[name='subtitle']").val(data.subtitle);
                $("input[name='subtitlecolor']").val(data.subtitle_color);
                $("textarea[name='short_description']").val(data.short_description);
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
    const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "SLIDER_METHOD_SPOFF").attr("value", "PUT")
    const input_id = $(document.createElement("input")).attr("type", "hidden").attr("name", "slider_id").attr("id","slider_id").attr("value", "<?= session()->getFlashdata("update_id") ?>")
    $("#FORM_SLIDER").append(input_method)
    $("#FORM_SLIDER").append(input_id)
  </script>
<?php endif ?>
<?= $this->endSection() ?>