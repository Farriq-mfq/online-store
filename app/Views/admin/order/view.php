<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Note:</h5>
                    This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                </div>


                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> Pustok, Inc.
                                <small class="float-right">Date: <?= date("d/m/Y", strtotime($order->created_at)) ?></small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info mb-2">
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong><?= $address->firstname ?> <?= $address->lastname ?></strong><br>
                                <?= $address->address1 ?>, <?= getCity($address->city)->city_name ?> <?= getProvince($address->province)->province ?><br>
                                <?php if (!empty($address->address2)) : ?>
                                    <?= $address->address2 ?>, <?= getCity($address->city)->city_name ?> <?= getProvince($address->province)->province ?><br>
                                <?php endif ?>
                                Phone: <?= $address->phone ?><br>
                                Email: <?= $address->user->email ?>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice #INVOICE_<?= $order->token ?></b><br>
                            <br>
                            <b>Order ID:</b> <?= $order->token  ?><br>
                            <b>Order Status:</b> <?= $order->status  ?><br>
                            <b>Payment Status:</b> <?= $payment->transaction_status  ?><br>
                            <?php if ($payment->transaction_status === "settlement") : ?>
                                <b>Payment success time:</b> <?= $payment->settlement_time  ?><br>
                            <?php endif ?>
                            <b>Shipping Tracking:</b> <?= $order->shipping_tracking == null ? '-' : $order->shipping_tracking ?><br>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Product</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0 ?>
                                    <?php foreach ($order_items as $item) : ?>
                                        <?php $total += $item->total ?>
                                        <tr>
                                            <td><?= $item->quantity ?></td>
                                            <td><?= $item->product->title ?></td>
                                            <td><?= format_rupiah($item->total) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-6">
                            <p class="lead">Payment Methods:</p>
                            <?php if (isset($payment->va_numbers)) : ?>
                                <p>BANK : <strong><?= $payment->va_numbers[0]->bank ?></strong></p>
                                <p>VA NUMBER: <strong><?= $payment->va_numbers[0]->va_number ?></strong></p>
                            <?php endif ?>
                            <?php if (isset($payment->permata_va_number)) : ?>
                                <p>BANK : <strong>Permata</strong></p>
                                <p>VA NUMBER: <strong><?= $payment->permata_va_number ?></strong></p>
                            <?php endif ?>
                            <?php if ($payment->payment_type == "echannel") : ?>
                                <p>BANK : <strong>Mandiri</strong></p>
                                <p>Bill Key: <strong><?= $payment->bill_key ?></strong></p>
                                <p>Biller Code: <strong><?= $payment->biller_code ?></strong></p>
                            <?php endif ?>
                            <?php if (isset($emoney)) : ?>
                                <p>
                                <h5>QR CODE PAYMENT</h5>
                                <img height="200px" width="200px" src="<?= $emoney->url ?>" alt="QR CODE SCAN PAY">
                                </p>
                            <?php endif ?>
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <p class="lead">Amount Due 2/22/2014</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td><?= format_rupiah($total) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Shipping:</th>
                                        <td><?= format_rupiah($order->shipping_total) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td><?= format_rupiah($order->subtotal) ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                            <button id="__print" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
                            <form action="<?= admin_url('/order/pdf/' . $order->order_id) ?>" method="POST">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<?= $this->endSection() ?>
<?= $this->section("script") ?>
<script>
    $("#__print").on("click", function(e) {
        e.preventDefault()
        window.print()
    })
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