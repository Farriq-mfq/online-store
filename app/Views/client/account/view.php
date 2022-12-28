<?= $this->extend("Layouts/main_layout") ?>

<?= $this->section("client_style") ?>
<style>
    .__progresss {
        height: 100px;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 1rem;
        margin-bottom: 10px;
    }

    .__progresss .__progress_item {
        height: 10px;
        width: 100%;
        text-align: center;
        position: relative;
        background-color: #e6e6e6;
    }

    .__progresss.cencel .__progress_item {
        background-color: red;
    }

    .__progresss.cencel .__progress_item .__icon_wrapper {
        background-color: red;
    }

    .__progresss .__progress_item .__title_progress {
        position: absolute;
        bottom: -2rem;
        left: 0;
        right: 0;
        font-weight: bold;
        color: #bdbfba;

    }

    .__progresss .__progress_item.active .__title_progress {
        color: #62AB00;
    }

    .__progresss .__progress_item.active {
        background-color: #bbed7e;
    }

    .__progresss .__progress_item .__icon_wrapper {
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto;
        background-color: #62AB00;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        left: -10px;
        height: 15px;
        width: 15px;
        border: 3px solid white;
        color: white;
    }

    .__progresss .__progress_item.current .__icon_wrapper {
        height: 30px;
        width: 30px;
        border: none;
    }

    .__progresss .__progress_item .__icon_wrapper i {
        display: none;
    }

    .__progresss .__progress_item.current .__icon_wrapper i {
        display: block;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section("content") ?>
<section class="order-complete inner-page-sec-padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if ($order->is_cencel) : ?>
                    <div class="order-complete-message text-center">
                        <h3>Your Order Has been Cencel</h3>
                    </div>
                <?php elseif ($payment->transaction_status == "expire") : ?>
                    <div class="order-complete-message text-center">
                        <h3>Payment Expired</h3>
                    </div>
                <?php else : ?>
                    <div class="order-complete-message text-center">
                        <div class="__progresss <?php if ($order->status == "REJECT") : ?>cencel<?php endif ?>">
                            <div class="__progress_item <?php if ($order->status == "WAITING" || $order->status == "PROCESS" || $order->status == "SHIPPED" || $order->status == "DONE") : ?>active<?php endif ?> <?php if ($order->status == "WAITING") : ?>current<?php endif ?>">
                                <div class="__icon_wrapper">
                                    <i class="fa fa-clock"></i>
                                </div>
                                <span class="__title_progress">Waiting</span>
                            </div>
                            <div class="__progress_item <?php if ($order->status == "PROCESS" || $order->status == "SHIPPED" || $order->status == "DONE") : ?>active<?php endif ?> <?php if ($order->status == "PROCESS") : ?>current<?php endif ?>">
                                <div class="__icon_wrapper">
                                    <i class="fa fa-spinner"></i>
                                </div>
                                <span class="__title_progress">Process</span>
                            </div>
                            <div class="__progress_item <?php if ($order->status == "SHIPPED" || $order->status == "DONE") : ?>active<?php endif ?> <?php if ($order->status == "SHIPPED") : ?>current<?php endif ?>">
                                <div class="__icon_wrapper">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <span class="__title_progress">Shipped</span>
                            </div>
                            <div class="__progress_item <?php if ($order->status == "DONE") : ?>active<?php endif ?> <?php if ($order->status == "DONE") : ?>current<?php endif ?>">
                                <div class="__icon_wrapper">
                                    <i class="fa fa-check"></i>
                                </div>
                                <span class="__title_progress">Done</span>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <ul class="order-details-list">
                    <li>Order Number: <strong><?= $order->token ?></strong></li>
                    <li>Date: <strong><?= $order->created_at ?></strong></li>
                    <li>Total: <strong><?= format_rupiah($order->subtotal) ?></strong></li>
                    <li>Payment Method: <strong><?= $order->payment_method ?></strong></li>
                    <li>Order Status: <strong><?= $order->status ?></strong></li>
                    <li>Tracking: <strong><?= $order->shipping_tracking == NULL  ? "-" : $order->shipping_tracking ?></strong></li>
                    <li>Payment Status: <strong><?= $payment->transaction_status ?></strong></li>
                    <?php if (isset($payment->va_numbers)) : ?>
                        <li>BANK : <strong><?= $payment->va_numbers[0]->bank ?></strong></li>
                        <li>VA NUMBER: <strong><?= $payment->va_numbers[0]->va_number ?></strong></li>
                    <?php endif ?>
                    <?php if (isset($payment->permata_va_number)) : ?>
                        <li>BANK : <strong>Permata</strong></li>
                        <li>VA NUMBER: <strong><?= $payment->permata_va_number ?></strong></li>
                    <?php endif ?>
                    <?php if ($payment->payment_type == "echannel") : ?>
                        <li>BANK : <strong>Mandiri</strong></li>
                        <li>Bill Key: <strong><?= $payment->bill_key ?></strong></li>
                        <li>Biller Code: <strong><?= $payment->biller_code ?></strong></li>
                    <?php endif ?>
                    <?php if (isset($emoney)) : ?>
                        <li>
                            <h5>QR CODE PAYMENT</h5>
                            <img src="<?= $emoney->url ?>" alt="QR CODE SCAN PAY">
                        </li>
                    <?php endif ?>
                </ul>
                <p>Pay with cash upon delivery.</p>
                <h3 class="order-table-title">Order Details</h3>
                <div class="table-responsive">
                    <table class="table order-details-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0 ?>
                            <?php foreach ($order_items as $item) : ?>
                                <?php $total += $item->total ?>
                                <tr>
                                    <td><a href="single-product.html"><?= $item->product->title ?></a> <strong>× <?= $item->quantity ?></strong></td>
                                    <td><span><?= format_rupiah($item->total) ?></span></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Subtotal:</th>
                                <td><span><?= format_rupiah($total) ?></span></td>
                            </tr>
                            <tr>
                                <th>Shipping:</th>
                                <td><span><?= format_rupiah($order->shipping_total) ?></span></td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td><span><?= format_rupiah($order->subtotal) ?></span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <?php if (!$order->is_cencel) : ?>
                    <?php if ($payment->transaction_status != "expire" && $payment->transaction_status != "cancel") : ?>
                        <?php if ($order->status == "WAITING") : ?>
                            <div class="d-flex justify-content-center">
                                <form action="<?= base_url('order/cencel/' . $order->order_id) ?>" method="POST" onsubmit="return confirm('Confirm Your action !')">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-outline-danger btn-sm mt-2">Cencel</button>
                                </form>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                <?php endif ?>
                <?php if ($order->status == "SHIPPED") : ?>
                    <div class="d-flex justify-content-center">
                        <form action="<?= base_url('order/done/' . $order->order_id) ?>" method="POST" onsubmit="return confirm('Confirm Your action !')">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-outline-success btn-sm mt-2">Done</button>
                        </form>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section("client_script") ?>
<script>
    console.log("home_view")
</script>
<?= $this->endSection() ?>