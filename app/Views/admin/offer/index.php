<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-sm btn-primary" data-toggle="modal" type="button" data-target="#modal-offer">
                    <i class="fas fa-plus"></i>
                    Add new
                </button>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Offer start</th>
                            <th>Offer end</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($offers as $offer) : ?>
                            <tr>
                                <td><?= $offer->product->title ?></td>
                                <td><?= ($offer->offer_start <= date("Y-m-d H:i:s")) ? "<span class='badge badge-success'>".$offer->offer_start." (start)</span>" : $offer->offer_start ?></td>
                                <td><?= (date("Y-m-d H:i:s") >= $offer->offer_end) ? "<span class='badge badge-danger'>".$offer->offer_end." (expired)</span>":$offer->offer_end ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary" id="btn_show_modal_edit_offer" type="button" data-id="<?= $offer->offer_id ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" confirm data-slug="<?= $offer->product->title ?>" data-action="<?= admin_url("/offer/" . esc($offer->offer_id)) ?>"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade " id="modal-offer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add new Offer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= admin_url("/offer") ?>" method="POST" id="offer_form">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="offer" required>Product</label>
                        <select name="product_id" id="product_id" class="form-control select2 <?= show_class_error("product_id") ?>">
                            <option value="">Select Product</option>
                            <?php foreach ($products as $product) : ?>
                                <option value="<?= $product->product_id ?>"><?= $product->title ?></option>
                            <?php endforeach ?>
                        </select>
                        <?= show_error("product_id") ?>
                    </div>
                    <div class="form-group">
                        <label>Date and time range:</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control float-right <?= show_class_error("offer_start_end") ?>" id="reservationtime" name="offer_start_end" value="<?= set_value("offer_start_end") ?>">
                            <?= show_error("offer_start_end") ?>
                        </div>
                        <!-- /.input group -->
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
    $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'YYYY/MM/DD HH:mm::ss',
        },

    })
</script>
<script <?= csp_script_nonce() ?>>
    $(document).on("click", "#btn_show_modal_edit_offer", function() {
        const id = $(this).data("id");
        $.ajax({
            method: "GET",
            data: {
                id: id
            },
            url: "<?= admin_url("/offer/edit") ?>",
            success: (data) => {
                const input_method = $(document.createElement("input")).attr("type", "hidden").attr("name", "_method").attr("id", "OFFER_METHOD").attr("value", "PUT")
                const input_id = $(document.createElement("input")).attr("type", "hidden").attr("name", "offer_id").attr("value", id)
                $("#offer_form").append(input_method)
                $("#offer_form").append(input_id)
                $("#product_id").val(data.product_id).change()
                $("#product_id").attr("disabled",true);
                $("input[name='offer_start_end']").val(`${data.offer_start}-${data.offer_end}`)
                $("#modal-offer").modal({
                    show: true
                })
                $(".modal-title").text("Update Brand")
            }
        })
    })
    // hide
    $("#modal-offer").on("hidden.bs.modal", function() {
        $("#OFFER_METHOD").remove()
        $("input[name='offer_id']").remove()
        $("#offer_form")[0].reset()
        $("#product_id").attr("disabled",false);
        $(".modal-title").text("Add new Offer")
        $("#product_id").val("").change()
        $("#offer_form").children().find(".invalid-feedback").remove()
        $("#offer_form").children().find(".is-invalid").removeClass("is-invalid")
    })
</script>
<?php if (session()->getFlashdata("validation")) : ?>
    <script>
        $("#modal-offer").modal({
            show: true
        })
    </script>
<?php endif ?>
<?php if (session()->getFlashdata("update_id")) : ?>
    <script>
        const input_method = $(document.createElement("input")).attr("type", "hidden").attr("id", "OFFER_METHOD").attr("name", "_method").attr("value", "PUT")
        const input_id = $(document.createElement("input")).attr("type", "hidden").attr("name", "offer_id").attr("value", "<?= session()->getFlashdata("update_id") ?>")
        $("#offer_form").append(input_method)
        $("#offer_form").append(input_id)
        $(".modal-title").text("Update Offer")
    </script>
<?php endif ?>
<?= $this->endSection() ?>