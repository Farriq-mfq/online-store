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
                            <th>Price Old</th>
                            <th>Discount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td>
                                    <?= $product->title ?>
                                    <button class="btn btn-sm btn-primary" id="PLUS_discount" type="button" data-id="<?= $product->product_id ?>" data-action="<?= admin_url("/product/discount/" . $product->product_id) ?>"><i class="fas fa-plus"></i></button>
                                </td>
                                <td>
                                    <?= $product->price ?>
                                </td>
                                <td>
                                    <?php if (count($product->product_discount)) : ?>
                                        <?php foreach ($product->product_discount as $discount) : ?>
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <h6>TYPE</h6>
                                                    <?= $discount->discount_type ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <h6>DISCOUNT</h6>
                                                    <?= $discount->discount_value ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <h6>Formula</h6>
                                                    <?php if ($discount->discount_type == "PERCENTAGE") : ?>
                                                        <p>
                                                            <?= $product->price ?> - (<?= $product->price ?> * <?= $discount->discount_value ?> / 100)
                                                        </p>
                                                        <?= format_rupiah(get_discount($product->price, $discount->discount_value))  ?>
                                                    <?php elseif ($discount->discount_type == "VALUE") : ?>
                                                        <p>
                                                            <?= $product->price ?> - <?= $discount->discount_value ?>
                                                        </p>
                                                        <?= format_rupiah(get_less_price($product->price, $discount->discount_value)) ?>
                                                    <?php else : ?>
                                                        No TYPE
                                                    <?php endif ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <button class="btn btn-sm btn-primary" id="btn_show_modal_edit_discount" type="button" data-action="<?= admin_url("/product/discount/" . $discount->discount_id) ?>" data-id="<?= $discount->discount_id ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" confirm data-slug="<?= $discount->discount_type ?>" data-action="<?= admin_url("/product/discount/" . esc($discount->discount_id)) ?>"><i class="fas fa-trash"></i></button>
                                                </li>
                                            </ul>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        No Discount
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
<div class="modal fade" id="modal-discount">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="FORM_discount" action="<?= session()->getFlashdata("action_session_discount") ? session()->getFlashdata("action_session_discount") : "" ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label required>Discount Type</label>
                        <select name="discount_type" id="discount_type" class="form-control <?= show_class_error("discount_type") ?>">
                            <option value="">Select Discount Type</option>
                            <option value="PERCENTAGE">Percentage</option>
                            <option value="VALUE">Value</option>
                        </select>
                        <?= show_error("tag") ?>
                    </div>
                    <div class="form-group">
                        <label required>Discount</label>
                        <input type="number" name="discount_value" id="discount_value" min="0" class="form-control <?= show_class_error("discount_value") ?>">
                        <?= show_error("discount_value") ?>
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
    $(document).on("click", "#PLUS_discount", function(e) {
        e.preventDefault();
        $("#modal-discount").modal({
            show: true
        })
        $("#FORM_discount").attr("action", $(this).data('action'))
    })

    $("#modal-discount").on("hidden.bs.modal", function() {
        $("#FORM_discount")[0].reset()
        $("#discount_METHOD_SPOFF").remove()
        $("#discount_id").remove()
        $("#FORM_discount").children().find(".invalid-feedback").remove()
        $("#FORM_discount").children().find(".is-invalid").removeClass("is-invalid")
    })

    $(document).on("click", "#btn_show_modal_edit_discount", function() {
        const id = $(this).data("id");
        const action = $(this).data("action");
        $.ajax({
            method: "GET",
            data: {
                id: id
            },
            url: "<?= admin_url("/product/discount/edit") ?>",
            beforeSend: () => {
                $(this).attr("disabled", true)
            },
            complete: () => {
                $(this).attr("disabled", false)
            },
            success: (data) => {
                console.log(data);
                const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "discount_METHOD_SPOFF").attr("value", "PUT")
                const input_id = $(document.createElement("input")).attr("type", "hidden").attr("name", "discount_id").attr("id", "discount_id").attr("value", data.discount_id)
                $("#FORM_discount").attr("action", action)
                $("#FORM_discount").append(input_method)
                $("#FORM_discount").append(input_id)
                $("#discount_type").val(data.discount_type)
                $("#discount_value").val(data.discount_value)
                $("#modal-discount").modal({
                    show: true
                })
                $(".modal-title").text("Update Discount")
            }
        })
    })
    <?php if (session()->getFlashdata("METHOD_UPDATE_SESSION")) : ?>
        const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "discount_METHOD_SPOFF").attr("value", "PUT")
        $("#FORM_discount").append(input_method)
    <?php endif ?>

    <?php if (session()->getFlashdata("validation")) : ?>
        $("#modal-discount").modal({
            show: true
        })
    <?php endif ?>
</script>
<?= $this->endSection() ?>