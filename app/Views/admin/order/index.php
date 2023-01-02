<?= $this->extend("Layouts/admin_layout") ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Status</th>
                            <th>Payment Status</th>
                            <th>Subtotal</th>
                            <th>Order datetime</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order) : ?>
                            <tr>
                                <td><a href="<?= admin_url('/order/view/' . $order->token) ?>"><?= $order->token ?></a></td>
                                <td><?= $order->status ?></td>
                                <td><?= findPayment($order->midtrans_id)->transaction_status ?></td>
                                <td><?= format_rupiah($order->subtotal) ?></td>
                                <td><?= $order->created_at ?></td>
                                <td>
                                    <?php if ($order->status != "DONE") : ?>
                                        <?php if (findPayment($order->midtrans_id)->transaction_status == "settlement") : ?>
                                            <?php if ($order->status == "WAITING") : ?>
                                                <form action="<?= admin_url('/order/accept/' . $order->order_id) ?>" method="POST" class="d-inline" onsubmit="return confirm('Confirm your action !')">
                                                    <?= csrf_field() ?>
                                                    <button class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                                                </form>
                                            <?php endif ?>
                                            <button id="__add__tracking__number" data-id="<?= $order->order_id ?>" class="btn btn-sm btn-primary"><i class="fas fa-shipping-fast"></i></button>
                                        <?php else : ?>
                                            No action
                                        <?php endif ?>
                                        <?php if (findPayment($order->midtrans_id)->transaction_status != "cancel") : ?>
                                            <?php if ($order->status == "WAITING") : ?>
                                                <form action="<?= admin_url('/order/reject/' . $order->order_id) ?>" method="POST" class="d-inline" onsubmit="return confirm('Confirm your action !')">
                                                    <?= csrf_field() ?>
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                                </form>
                                            <?php endif ?>
                                        <?php endif ?>
                                    <?php else : ?>
                                        No action
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
<div class="modal fade " id="modal-order">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add or update tracking number</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= admin_url("/order/traking") ?>" method="POST" id="order_form" onsubmit="return confirm('Confirm your action!')">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tracking" required>Tracking number</label>
                        <input type="text" class="form-control <?= show_class_error("tracking") ?>" name="tracking" id="tracking">
                        <?= show_error("tracking") ?>
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
    $(document).on("click", "#__add__tracking__number", function() {
        const id = $(this).data("id");
        $("#order_form").attr('action', "<?= admin_url("/order/tracking/") ?>" + `/${id}`)
        $("#modal-order").modal({
            show: true
        })
    })
    // hide
    $("#modal-order").on("hidden.bs.modal", function() {
        $("#order_form")[0].reset()
        $("#order_form").attr('action', "");
        $("#order_form").children().find(".invalid-feedback").remove()
        $("#order_form").children().find(".is-invalid").removeClass("is-invalid")
    })
</script>
<?php if (session()->getFlashdata("validation")) : ?>
    <script>
        $("#modal-order").modal({
            show: true
        })
    </script>
<?php endif ?>
<?= $this->endSection() ?>