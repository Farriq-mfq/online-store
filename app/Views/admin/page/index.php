<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-sm btn-primary" data-toggle="modal" type="button" data-target="#modal-page">
                    <i class="fas fa-plus"></i>
                    Add new
                </button>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Page Title</th>
                            <th>Path</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pages as $page) : ?>
                            <tr>
                                <td><?= $page->page_title ?></td>
                                <td><?= $page->path ?></td>
                                <td><?= $page->status ? '<div class="badge badge-success">Active</div>' : '<div class="badge badge-danger">InActive</div>' ?></td>
                                <td> <button class="btn btn-sm btn-primary" id="btn_show_modal_edit_page" type="button" data-id="<?= $page->page_id ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" confirm data-slug="<?= $page->path ?>" data-action="<?= admin_url("/page/" . esc($page->page_id)) ?>"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade " id="modal-page">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add new page</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= admin_url("/page") ?>" method="POST" id="page_form">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="path" required>Path</label>
                        <input type="text" class="form-control <?= show_class_error("path") ?>" name="path" id="path" value="<?= set_value("path") ?>">
                        <?= show_error("path") ?>
                    </div>
                    <div class="form-group">
                        <label for="page_title" required>Page Title</label>
                        <input type="text" class="form-control <?= show_class_error("page_title") ?>" name="page_title" id="page_title" value="<?= set_value("page_title") ?>">
                        <?= show_error("page_title") ?>
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
                        <label required>Content</label>
                        <textarea id="summernote" name="content">
                                <?= set_value("content") ? set_value("content") : "Place <em>some</em> <u>content</u> <strong>here</strong>" ?>
                            </textarea>
                        <?= show_error("content") ?>
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
    $(document).on("click", "#btn_show_modal_edit_page", function() {
        const id = $(this).data("id");
        $.ajax({
            method: "GET",
            data: {
                id: id
            },
            url: "<?= admin_url("/page/get") ?>",
            beforeSend: () => {
                $(this).attr("disabled", true)
            },
            complete: () => {
                $(this).attr("disabled", false)
            },
            success: (data) => {
                console.log(data);
                const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "ID_METHOD").attr("value", "PUT")
                const input_id = $(document.createElement("input")).attr("type", "hidden").attr("name", "page_id").attr("value", data.page_id)
                $("#page_form").append(input_method)
                $("#page_form").append(input_id)
                $("#page_title").val(data.page_title)
                $("#path").val(data.path)
                if (data.status == "1") {
                    $("#status").attr("checked", true)
                }
                $("textarea[name='content']").summernote("code", $("textarea[name='content']").html(data.content).val())
                $("#modal-page").modal({
                    show: true
                })
                $(".modal-title").text("Update page")
            }
        })
    })
    // hide
    $("#modal-page").on("hidden.bs.modal", function() {
        $("#ID_METHOD").remove()
        $("input[name='page_id']").remove()
        $("#page_form")[0].reset()
        $("#status").attr("checked", false)
        $(".modal-title").text("Add new page")
        $("#page_form").children().find(".invalid-feedback").remove()
        $("#page_form").children().find(".is-invalid").removeClass("is-invalid")
        $("textarea[name='content']").summernote("code", "Place <em>some</em> <u>content</u> <strong>here</strong>")

    })
</script>
<?php if (session()->getFlashdata("validation")) : ?>
    <script>
        $("#modal-page").modal({
            show: true
        })
    </script>
<?php endif ?>
<?php if (session()->getFlashdata("update_id")) : ?>
    <script>
        const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "ID_METHOD").attr("value", "PUT")
        const input_id = $(document.createElement("input")).attr("type", "hidden").attr("name", "page_id").attr("value", "<?= session()->getFlashdata("update_id") ?>")
        $("#page_form").append(input_id)
        $("#page_form").append(input_method)
        $(".modal-title").text("Update page")
    </script>
<?php endif ?>
<?= $this->endSection() ?>