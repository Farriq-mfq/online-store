<?= $this->extend("Layouts/main_layout") ?>

<?= $this->section("content") ?>
<section class="order-complete inner-page-sec-padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="order-complete-message text-center">
                    <h1>Thank you !</h1>
                    <p>Your order has been received.</p>
                </div>
                <ul class="order-details-list">
                    <li>Order Number: <strong><?= $order->token ?></strong></li>
                    <li>Date: <strong><?= $order->created_at ?></strong></li>
                    <li>Total: <strong><?= format_rupiah($order->subtotal) ?></strong></li>
                    <li>Payment Method: <strong><?= $order->payment_method ?></strong></li>
                    <li>Payment Status: <strong><?= $payment->transaction_status ?></strong></li>
                    <?php if (isset($payment->va_numbers)) : ?>
                        <li>BANK : <strong><?= $payment->va_numbers[0]->bank ?></strong></li>
                        <li>VA NUMBER: <strong><?= $payment->va_numbers[0]->va_number ?></strong></li>
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