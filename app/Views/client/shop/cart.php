<?= $this->extend("Layouts/main_layout") ?>

<?= $this->section("content") ?>
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <form action="<?= base_url("/cart/checkout") ?>" method="POST">
                <div class="table-responsive" style="position: relative;">
                    <div class="overley_cart"></div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $subTotal = 0 ?>
                            <?php if (count($carts)) : ?>
                                <?php foreach ($carts as $cart) : ?>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img src="<?= $cart->product_img ?>" alt="" height="200" width="200" style="object-fit: cover;">
                                                </div>
                                                <div class="media-body">
                                                    <p><?= $cart->product->title ?></p>
                                                    <?php if ($cart->product_inventory) : ?>
                                                        <p><?= $cart->product_inventory->color ?></p>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h5>Rp.<?= number_format($cart->price, 0, ",", ".") ?></h5>
                                        </td>
                                        <td>
                                            <div class="product_count">
                                                <input type="text" name="qty[]" id="sst" maxlength="12" value="<?= $cart->quantity ?>" title="Quantity:" class="input-text qty">
                                                <button class="increase items-count" id="plus_qty_update" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                                <button id="min_qty_update" class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                            </div>
                                        </td>
                                        <td>
                                            <h5>Rp.<?= number_format($cart->total, 0, ",", ".") ?></h5>
                                        </td>
                                        <td class="d-grid place-items-center" style="gap: 10px;">
                                            <label class="d-inline-block btn border">
                                                <div class="primary-checkbox">
                                                    <input type="checkbox" name="check_shopping_cart[]" id="<?= "default-checkbox" . $cart->session_cart_id ?>" value="<?= $cart->session_cart_id ?>">
                                                    <label for="<?= "default-checkbox" . $cart->session_cart_id ?>"></label>
                                                </div>
                                            </label>
                                        </td>
                                    </tr>
                                    <input type="hidden" name="session_cart_id[]" value="<?= $cart->session_cart_id ?>">
                                    <?php $subTotal += $cart->total ?>
                                <?php endforeach ?>
                            <?php else : ?>
                                <tr>
                                    <td>
                                        <h4>YOUR CART IS EMPTY</h4>
                                    </td>
                                </tr>
                            <?php endif ?>
                            <tr class="bottom_button">
                                <td>
                                    <?php if (count($carts)) : ?>
                                        <button class="gray_btn" type="button" style="cursor: pointer;" id="update_cart">Update Cart</button>
                                    <?php endif ?>
                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <?php if (count($carts)) : ?>

                                        <button class="btn btn-sm btn-danger" id="DELETE_SHOPPING_ALL" type="button"><span class="ti-trash"></span> Delete <span id="CHECKED_ID_SHOPPING">0</span></button>

                                    <?php endif ?>
                                </td>
                            </tr>

                            <tr>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5 id="SUBTOTAL">Rp.<?= number_format($subTotal, 0, ".", ".")  ?></h5>
                                </td>
                            </tr>
                            <tr class="out_button_area">
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center justify-content-end">
                                        <?php if (count($carts)) : ?>
                                            <button class="primary-btn btn" type="submit">Proceed to checkout</button>
                                        <?php endif ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section("client_script") ?>
<script <?= csp_script_nonce() ?>>
    $("#update_cart").on("click", function(e) {
        const input = $("input[name='qty[]']")
        const input_id_session = $("input[name='session_cart_id[]']")
        let data = [];
        input.each(function($key) {
            const session_cart_id = input_id_session[$key].value
            data.push({
                qty: $(this).val(),
                session_cart_id: session_cart_id
            })
        })
        $.post({
            url: "<?= base_url("/cart/update") ?>",
            data: {
                input: data
            },
            beforeSend: () => {
                $(".overley_cart").css("display", "block")
            },
            success: () => {
                window.location.reload();
            }
        })
    })

    $(document).on("click", "#plus_qty_update", function(e) {
        e.preventDefault();
        const sst = $(this).siblings("#sst");
        if (!isNaN(sst.val())) {
            let sst_val = parseInt(sst.val());
            sst.val(sst_val += 1)
        }
    })
    $(document).on("click", "#min_qty_update", function(e) {
        e.preventDefault();
        const sst = $(this).siblings("#sst");
        if (!isNaN(sst.val())) {
            let sst_val = parseInt(sst.val());
            if (sst.val() > 1) {
                sst.val(sst_val -= 1)
            }
        }
    })

    $("input[name='check_shopping_cart[]']").change(function(e) {
        e.preventDefault()
        const checked = $("input[name='check_shopping_cart[]']:checked");
        $("#CHECKED_ID_SHOPPING").text(checked.length)
    })

    $("#DELETE_SHOPPING_ALL").on("click", function(e) {
        e.preventDefault()
        const checks = $("input[name='check_shopping_cart[]']:checked");
        let data = [];
        checks.each(function() {
            data.push({
                session_cart_id: $(this).val()
            })
        })
        if (data.length) {
            if (window.confirm("Confirm Your action")) {
                $.post({
                    url: "<?= base_url("/cart/delete/all") ?>",
                    data: {
                        input: data
                    },
                    beforeSend: () => {
                        $(this).attr("disabled", true);
                        $(this).text("Deleting...");
                        $(".overley_cart").css("display", "block")

                    },
                    success: function(data) {
                        window.location.reload()
                    }
                })
            }
        }

    })
    <?php if (session()->getFlashdata("alert_cart")) : ?>
        $.toast({
            heading: 'Alert',
            position: 'top-right',
            text: "<?= session()->getFlashdata("alert_cart") ?>",
        })
    <?php endif ?>
</script>
<?= $this->endSection() ?>