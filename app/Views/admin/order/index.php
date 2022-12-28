<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-sm btn-primary" data-toggle="modal" type="button" data-target="#modal-tags">
                    <i class="fas fa-plus"></i>
                    Add new
                </button>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Status</th>
                            <th>Shipping Total</th>
                            <th>Payment Status</th>
                            <th>Subtotal</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>dfs</td>
                            <td>dfs</td>
                            <td>dfs</td>
                            <td>dfs</td>
                            <td>dfs</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade " id="modal-tags">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add new Tags</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= admin_url("/tags") ?>" method="POST" id="tags_form">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tag" required>Tags</label>
                        <input type="text" class="form-control <?= show_class_error("tag") ?>" name="tag" id="tag">
                        <?= show_error("tag") ?>
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
    $(document).on("click", "#btn_show_modal_edit_tags", function() {
        const id = $(this).data("id");
        $.ajax({
            method: "GET",
            data: {
                id: id
            },
            url: "<?= admin_url("/tags/get") ?>",
            beforeSend: () => {
                $(this).attr("disabled", true)
            },
            complete: () => {
                $(this).attr("disabled", false)
            },
            success: (data) => {
                console.log(data);
                const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "ID_METHOD").attr("value", "PUT")
                const input_id = $(document.createElement("input")).attr("type", "hidden").attr("name", "tag_id").attr("value", data.tag_id)
                $("#tags_form").append(input_method)
                $("#tags_form").append(input_id)
                $("#tag").val(data.tag)
                $("#modal-tags").modal({
                    show: true
                })
                $(".modal-title").text("Update tags")
            }
        })
    })
    // hide
    $("#modal-tags").on("hidden.bs.modal", function() {
        $("#ID_METHOD").remove()
        $("input[name='tag_id']").remove()
        $("#tags_form")[0].reset()
        $(".modal-title").text("Add new tags")
        $("#tags_form").children().find(".invalid-feedback").remove()
        $("#tags_form").children().find(".is-invalid").removeClass("is-invalid")
    })
</script>
<?php if (session()->getFlashdata("validation")) : ?>
    <script>
        $("#modal-tags").modal({
            show: true
        })
    </script>
<?php endif ?>
<?php if (session()->getFlashdata("update_id")) : ?>
    <script>
        const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "ID_METHOD").attr("value", "PUT")
        const input_id = $(document.createElement("input")).attr("type", "hidden").attr("name", "tags_id").attr("value", "<?= session()->getFlashdata("update_id") ?>")
        $("#tags_form").append(input_id)
        $("#tags_form").append(input_method)
        $(".modal-title").text("Update tags")
    </script>
<?php endif ?>
<?= $this->endSection() ?>