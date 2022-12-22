<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Meta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td>
                                    <?= $product->title ?> (<?= count($product->product_meta) ?>)
                                    <button class="btn btn-sm btn-primary" id="PLUS_META" type="button" data-id="<?= $product->product_id ?>" data-action="<?= admin_url("/product/meta/" . $product->product_id) ?>"><i class="fas fa-plus"></i></button>
                                </td>
                                <td>
                                    <?php if (count($product->product_meta)) : ?>
                                        <?php foreach ($product->product_meta as $meta) : ?>
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <p><b><?= $meta->key ?></b></p>
                                                    <hr>
                                                    <p><?= html_entity_decode($meta->content) ?></p>
                                                    <hr>
                                                    <p><button class="btn btn-sm btn-primary" type="button" data-id="<?= $meta->meta_id ?>" data-action="<?= admin_url("/product/meta/" . $meta->meta_id) ?>" id="BTN_EDIT_META"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-danger btn-sm" confirm data-slug="<?= $meta->key ?>" data-action="<?= admin_url("/product/meta/" . esc($meta->meta_id)) ?>"><i class="fas fa-trash"></i></button>
                                                    </p>
                                                </li>
                                            </ul>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        No Meta
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-META">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="FORM_META" action="<?= session()->getFlashdata("action_session_META") ? session()->getFlashdata("action_session_META") : "" ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label required>Key</label>
                        <input type="text" class="form-control <?= show_class_error("key") ?>" id="key" name="key" value="<?= set_value("key") ?>">
                        <?= show_error("key") ?>
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
<script>
    $(document).on("click", "#PLUS_META", function(e) {
        e.preventDefault();
        $("#modal-META").modal({
            show: true
        })
        $("#FORM_META").attr("action", $(this).data('action'))
    })

    $("#modal-META").on("hidden.bs.modal", function() {
        $("#FORM_META")[0].reset()
        $("#META_METHOD_SPOFF").remove()
        $("#FORM_META").children().find(".invalid-feedback").remove()
        $("#FORM_META").children().find(".is-invalid").removeClass("is-invalid")
        $("textarea[name='content']").summernote("code", "Place <em>some</em> <u>content</u> <strong>here</strong>")
    })

    $(document).on("click", "#BTN_EDIT_META", function(e) {
        e.preventDefault();
        const id = $(this).data("id");
        const action = $(this).data("action");
        $.ajax({
            method: "GET",
            data: {
                id: id
            },
            url: "<?= admin_url("/product/meta/edit") ?>",
            success: (data) => {
                const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "META_METHOD_SPOFF").attr("value", "PUT")
                $("#FORM_META").append(input_method)
                $("#FORM_META").attr("action", action)
                $("#modal-META").modal({
                    show: true
                })
                $("input[name='key']").val(data.key)
                $("textarea[name='content']").summernote("code", $("textarea[name='content']").html(data.content).val())
            }
        })
    })
    <?php if (session()->getFlashdata("METHOD_UPDATE_SESSION")) : ?>
        const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "META_METHOD_SPOFF").attr("value", "PUT")
        $("#FORM_META").append(input_method)
    <?php endif ?>

    <?php if (session()->getFlashdata("validation")) : ?>
        $("#modal-META").modal({
            show: true
        })
    <?php endif ?>
</script>
<?= $this->endSection() ?>