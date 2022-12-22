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
                            <th>TAGS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td>
                                    <?= $product->title ?> (<?= count($product->product_tags) ?>)
                                    <button class="btn btn-sm btn-primary" id="PLUS_TAGS" type="button" data-id="<?= $product->product_id ?>" data-action="<?= admin_url("/product/tags/" . $product->product_id) ?>"><i class="fas fa-plus"></i></button>
                                </td>
                                <td>
                                    <?php if (count($product->product_tags)) : ?>
                                        <?php foreach ($product->product_tags as $tag) : ?>
                                            <ul class="list-group">
                                                <?php foreach ($tags as $tg) : ?>
                                                    <?php if ($tg->tag_id == $tag->tag_id) : ?>
                                                        <li class="list-group-item">
                                                            <p>
                                                                <?= $tg->tag ?>
                                                            </p>
                                                            <button class="btn btn-sm btn-primary" type="button" data-id="<?= $tag->products_tags_id ?>" data-action="<?= admin_url("/product/tags/" . $tag->products_tags_id) ?>" id="BTN_EDIT_TAGS"><i class="fas fa-edit"></i></button>
                                                            <button class="btn btn-danger btn-sm" confirm data-slug="<?= $tg->tag ?>" data-action="<?= admin_url("/product/tags/" . esc($tag->products_tags_id)) ?>"><i class="fas fa-trash"></i></button>
                                                        </li>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        No Tags
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
<div class="modal fade" id="modal-TAGS">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="FORM_TAGS" action="<?= session()->getFlashdata("action_session_TAGS") ? session()->getFlashdata("action_session_TAGS") : "" ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label required>Tag</label>
                        <select name="tag" id="tag" class="form-control select2 <?= show_class_error("tag") ?>">
                            <option value="">Select Tags</option>
                            <?php foreach ($tags as $tag) : ?>
                                <option value="<?= $tag->tag_id ?>"><?= $tag->tag ?></option>
                            <?php endforeach ?>
                        </select>
                        <?= show_error("tag") ?>
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
    $(document).on("click", "#PLUS_TAGS", function(e) {
        e.preventDefault();
        $("#modal-TAGS").modal({
            show: true
        })
        $("#FORM_TAGS").attr("action", $(this).data('action'))
    })

    $("#modal-TAGS").on("hidden.bs.modal", function() {
        $("#FORM_TAGS")[0].reset()
        $("#TAGS_METHOD_SPOFF").remove()
        $("#FORM_TAGS").children().find(".invalid-feedback").remove()
        $("#FORM_TAGS").children().find(".is-invalid").removeClass("is-invalid")
        $("select[name='tag']").val("")
        $("select[name='tag']").trigger("change")
    })

    $(document).on("click", "#BTN_EDIT_TAGS", function(e) {
        e.preventDefault();
        const id = $(this).data("id");
        const action = $(this).data("action");
        $.ajax({
            method: "GET",
            data: {
                id: id
            },
            url: "<?= admin_url("/product/tags/edit") ?>",
            success: (data) => {
                const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "TAGS_METHOD_SPOFF").attr("value", "PUT")
                $("#FORM_TAGS").append(input_method)
                $("#FORM_TAGS").attr("action", action)
                $("#modal-TAGS").modal({
                    show: true
                })
                $("select[name='tag']").val(data.tag_id)
                $("select[name='tag']").trigger("change")
            }
        })
    })
    <?php if (session()->getFlashdata("METHOD_UPDATE_SESSION")) : ?>
        const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "TAGS_METHOD_SPOFF").attr("value", "PUT")
        $("#FORM_TAGS").append(input_method)
    <?php endif ?>

    <?php if (session()->getFlashdata("validation")) : ?>
        $("#modal-TAGS").modal({
            show: true
        })
    <?php endif ?>
</script>
<?= $this->endSection() ?>