<?= $this->extend("Layouts/main_layout") ?>
<?= $this->section("client_style") ?>
<?= $this->endSection() ?>
<?= $this->section("content") ?>
<main id="content" class="page-section inner-page-sec-padding-bottom space-db--20">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Checkout Form s-->
                <form action="<?= base_url("/checkout") ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="checkout-form">
                        <div class="row row-40">
                            <div class="col-12">
                                <h1 class="quick-title">Checkout</h1>
                                <!-- Slide Down Trigger  -->
                                <div class="checkout-quick-box">
                                    <p><i class="far fa-sticky-note"></i>Have a coupon? <a href="javascript:" class="slide-trigger" data-target="#quick-cupon">
                                            Click here to enter your code</a></p>
                                </div>
                                <!-- Slide Down Blox ==> Cupon Box -->
                                <div class="checkout-slidedown-box" id="quick-cupon">
                                    <div class="checkout_coupon">
                                        <input type="text" class="mb-0" placeholder="Coupon Code">
                                        <a href="#" class="btn btn-outlined">Apply coupon</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 mb--20">
                                <?php if (count($addresses)) : ?>
                                    <?php foreach ($addresses as $address) : ?>
                                        <?php if ($address->primary) : ?>
                                            <input type="hidden" name="address_id" value="<?= $address->user_address_id ?>">
                                            <div class="myaccount-content mt-2 parent_checked">
                                                <h3>Address</h3>
                                                <address>
                                                    <p><strong><?= $address->firstname ?> <?= $address->lastname ?></strong>
                                                    </p>
                                                    <p><?= $address->address1 ?>, <br>
                                                        <?= getCity($address->city)->city_name ?>, <?= getProvince($address->province)->province ?> <?= $address->postcode_zip ?></p>
                                                    <p>Phone: <?= $address->phone ?></p>
                                                </address>
                                                <div class="d-grid gap-2">
                                                    <a href="#" class="btn btn--primary col-md-6" id="__change__address__modal"><i class="fa fa-edit"></i>Change
                                                        Address</a>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <!-- Shipping Address -->
                                    <div class="mb--40 mt-3">
                                        <h4 class="checkout-title">Shipping Address</h4>
                                        <div class="checkout-quick-box">
                                            <p><i class="far fa-map"></i>Hide address ? <a href="javascript:" class="slide-trigger" data-target="#quick-address">
                                                    Click here to Hide address</a></p>
                                        </div>
                                        <div class="row" id="quick-address">
                                            <div class="col-md-6 col-12 mb--20">
                                                <label>First Name*</label>
                                                <input type="text" placeholder="First Name" class="form-control <?= show_class_error("firstname") ?>" name="firstname" value="<?= set_value('firstname') ?>">
                                                <?= show_error('firstname') ?>
                                            </div>
                                            <div class="col-md-6 col-12 mb--20">
                                                <label>Last Name*</label>
                                                <input type="text" placeholder="Last Name" class="form-control <?= show_class_error('lastname') ?>" name="lastname" value="<?= set_value('lastname') ?>">
                                                <?= show_error('lastname') ?>
                                            </div>
                                            <div class="col-md-12 col-12 mb--20">
                                                <label>Phone no*</label>
                                                <input type="text" placeholder="Phone number" class="form-control <?= show_class_error('phone') ?>" name="phone" value="<?= set_value('phone') ?>">
                                                <?= show_error('phone') ?>
                                            </div>
                                            <div class="col-12 mb--20">
                                                <label>Address*</label>
                                                <input type="text" placeholder="Address line 1" class="form-control <?= show_class_error('address1') ?>" name="address1" value="<?= set_value('address1') ?>">
                                                <?= show_error('address1') ?>
                                                <input type="text" placeholder="Address line 2" class="form-control" name="address2">
                                            </div>
                                            <div class="col-md-6 col-12 mb--20">
                                                <label>Province*</label>
                                                <select id="__load__province__" class="form-control <?= show_class_error('province') ?>" name="province">
                                                </select>
                                                <?= show_error('province') ?>
                                            </div>
                                            <div class="col-md-6 col-12 mb--20">
                                                <label>Town/City*</label>
                                                <select id="__load__city__" class="form-control <?= show_class_error('city') ?>" name="city">
                                                </select>
                                                <?= show_error('city') ?>
                                            </div>
                                            <div class="col-md-12 col-12 mb--20">
                                                <label>Zip Code*</label>
                                                <input type="text" placeholder="Zip Code" class="form-control <?= show_class_error('postcode_zip') ?>" name="postcode_zip" value="<?= set_value('postcode_zip') ?>">
                                                <?= show_error('postcode_zip') ?>
                                            </div>
                                            <div class="col-md-12 col-12 mb--20">
                                                <label for="order-note">Address notes</label>
                                                <textarea id="order-note" cols="30" rows="10" class="form-control" name="address_notes" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <div class="row mt--30">
                                    <div class="col-md-6 col-12 mb--20">
                                        <label>Devlivery Service*</label>
                                        <select id="__load__delivery__" class="form-control <?= show_class_error('courier') ?>" name="courier">
                                        </select>
                                        <?= show_error('courier') ?>
                                    </div>
                                    <div class="col-md-6 col-12 mb--20">
                                        <label>Shipping Option*</label>
                                        <select id="__load__shipping____option" class="form-control <?= show_class_error('service') ?>" name="service">
                                        </select>
                                        <?= show_error('service') ?>
                                    </div>
                                </div>
                                <div class="row mt--30">
                                    <div class="col-md-12 col-12 mb--20">
                                        <label>Payment method*</label>
                                        <select class="form-control <?= show_class_error('payment_method') ?> <?= show_class_error('payment_method') ?>" name="payment_method">
                                            <option value="">Select Payment</option>
                                            <option value="<?= randomhash("bank_transfer|bank_bri") ?>">Bank BRI</option>
                                            <option value="<?= randomhash("bank_transfer|bank_bca") ?>">Bank BCA</option>
                                            <option value="<?= randomhash("bank_transfer|bank_bni") ?>">Bank BNI</option>
                                            <option value="<?= randomhash("bank_transfer|bank_mandiri") ?>">Bank MANDIRI</option>
                                            <option value="<?= randomhash("bank_transfer|bank_permata") ?>">Bank PERMATA</option>
                                            <option value="<?= randomhash("e_money|qris") ?>">Qris</option>
                                        </select>
                                        <?= show_error('payment_method') ?>
                                    </div>
                                </div>
                                <div class="order-note-block mt--30">
                                    <label for="order-note">Order notes</label>
                                    <textarea id="order-note" cols="30" rows="10" name="order-note" class="order-note border" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="row">
                                    <!-- Cart Total -->
                                    <div class="col-12">
                                        <div class="checkout-cart-total">
                                            <h2 class="checkout-title">YOUR ORDER</h2>
                                            <h4>Product <span>Total</span></h4>
                                            <ul>
                                                <?php foreach ($carts as $cart) : ?>
                                                    <li><span class="left"><?= $cart->product->title ?> X <?= $cart->quantity ?></span> <span class="right"><?= format_rupiah($cart->total) ?></span></li>
                                                <?php endforeach ?>
                                            </ul>
                                            <p>Sub Total <span><?= format_rupiah($total_cart->total_cart) ?></span></p>
                                            <p>Shipping Fee <span id="__load__shipping__price">-</span></p>
                                            <h4>Grand Total <span id="__load__shipping__grand__total">-</span></h4>
                                            <div class="method-notice mt--25">
                                                <article>
                                                    <h3 class="d-none sr-only">blog-article</h3>
                                                    This is the last process, please check in detail
                                                </article>
                                            </div>
                                            <div class="term-block">
                                                <input type="checkbox" class="<?= show_class_error('term_conditions') ?>" id="accept_terms2" name="term_conditions">
                                                <label for="accept_terms2">I’ve read and accept the terms &
                                                    conditions</label>
                                                <?= show_error('term_conditions') ?>
                                            </div>
                                            <button type="submit" class="place-order w-100" id="__btn__place">Place order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<!-- Modal -->
<?php if (count($addresses)) : ?>
    <div class="modal fade modal-quick-view" id="__show__address_modal__change" tabindex="-1" role="dialog" aria-labelledby="__show__address_modal__change" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <?php foreach ($addresses as $address) : ?>
                    <?php if ($address->primary == 0) : ?>

                        <form action="<?= base_url("checkout/changeaddress/" . $address->user_address_id) ?>" method="POST">
                            <?= csrf_field() ?>
                            <div class="myaccount-content mt-2 parent_checked">
                                <h3>Address</h3>
                                <address>
                                    <p><strong><?= $address->firstname ?> <?= $address->lastname ?></strong>
                                    </p>
                                    <p><?= $address->address1 ?>, <br>
                                        <?= getCity($address->city)->city_name ?>, <?= getProvince($address->province)->province ?> <?= $address->postcode_zip ?></p>
                                    <p>Phone: <?= $address->phone ?></p>
                                </address>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn--primary col-md-6"><i class="fa fa-edit"></i>Select Address</button>
                                </div>
                            </div>
                        </form>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php endif ?>
<?= $this->endSection() ?>
<?= $this->section("client_script") ?>
<script>
    $("#__btn__place").on("click", function(e) {
        $(this).text("Processing...");
        $(this).attr("disabled", true)
    })

    $(document).on("change", ".radio-shipping-address", function(e) {
        e.preventDefault();
        if ($(this).is(":checked")) {
            $(this).parent().parent().addClass("border-success")
        } else {
            $(this).parent().parent().removeClass("border-success")
        }

    })

    // load province
    $("#__load__province__").load("<?= base_url("/api/shipping/province") ?>")
    $("#__load__province__").change(function(e) {
        e.preventDefault();
        $("#__load__city__").children().remove()
        $("#__load__city__").load("<?= base_url("/api/shipping/city") ?>", `province_id=${$(this).val()}`)
    })

    <?php if (count($addresses)) : ?>
        const $courier = [{
                text: "Select Delivery Service",
                value: ""
            }, {
                text: "JNE",
                value: "jne"
            },
            {
                text: "TIKI",
                value: "tiki"
            },
            {
                text: "POS",
                value: "pos"
            },
        ];

        $.each($courier, (v, k) => {
            $("#__load__delivery__").append($("<option>", {
                value: k.value,
                text: k.text
            }))
        })
        <?php foreach ($addresses as $address) : ?>
            <?php if ($address->primary) : ?>
                $("#__load__delivery__").change(function() {
                    $("#__load__shipping____option").children().remove()
                    $("#__load__shipping____option").load("<?= base_url("/api/shipping/cost") ?>", `destination=<?= $address->city ?>&weight=<?= $total_weight ?>&courier=${$(this).val()}`)
                })
                $("#__load__shipping____option").change(function(e) {
                    const original = $("#__btn__place").html();
                    $("#__btn__place").text("Calculating...");
                    $("#__btn__place").attr("disabled", true)

                    $("#__load__shipping__price").text("Calculating...")
                    $("#__load__shipping__price").load("<?= base_url("api/shipping/get_price") ?>", `service=${$(this).val()}&destination=<?= $address->city ?>&weight=<?= $total_weight ?>&courier=${$("#__load__delivery__").val()}`, function(data, status) {
                        if (status == 'error') {
                            $("#__load__shipping__price").text("-")
                        }
                    })
                    $("#__load__shipping__grand__total").text("Calculating...")
                    $("#__load__shipping__grand__total").load("<?= base_url("api/shipping/get_grand_price") ?>", `service=${$(this).val()}&destination=<?= $address->city ?>&weight=<?= $total_weight ?>&courier=${$("#__load__delivery__").val()}`, function(data, status) {
                        if (status == 'error') {
                            $("#__load__shipping__grand__total").text("-")
                        }
                        $("#__btn__place").text(original);
                        $("#__btn__place").attr("disabled", false)
                    })
                })
            <?php endif ?>
        <?php endforeach ?>

        $("#__change__address__modal").on("click", function(e) {
            e.preventDefault();
            $("#__show__address_modal__change").modal("show")
        })
    <?php else : ?>
        $("#__load__city__").change(function(e) {
            $("#__load__delivery__").children().remove()
            $("#__load__shipping____option").children().remove()
            const $courier = [{
                    text: "Select Delivery Service",
                    value: ""
                }, {
                    text: "JNE",
                    value: "jne"
                },
                {
                    text: "TIKI",
                    value: "tiki"
                },
                {
                    text: "POS",
                    value: "pos"
                },
            ];

            $.each($courier, (v, k) => {
                $("#__load__delivery__").append($("<option>", {
                    value: k.value,
                    text: k.text
                }))
            })
        })

        $("#__load__delivery__").change(function() {
            $("#__load__shipping____option").children().remove()
            $("#__load__shipping____option").load("<?= base_url("/api/shipping/cost") ?>", `destination=${$("#__load__city__").val()}&weight=<?= $total_weight ?>&courier=${$(this).val()}`)
        })

        $("#__load__shipping____option").change(function(e) {
            const original = $("#__btn__place").html();
            $("#__btn__place").text("Calculating...");
            $("#__btn__place").attr("disabled", true)
            $("#__load__shipping__price").text("Calculating...")
            $("#__load__shipping__price").load("<?= base_url("api/shipping/get_price") ?>", `service=${$(this).val()}&destination=${$("#__load__city__").val()}&weight=<?= $total_weight ?>&courier=${$("#__load__delivery__").val()}`, function(data, status) {
                if (status == 'error') {
                    $("#__load__shipping__price").text("-")
                }
            })
            $("#__load__shipping__grand__total").text("Calculating...")
            $("#__load__shipping__grand__total").load("<?= base_url("api/shipping/get_grand_price") ?>", `service=${$(this).val()}&destination=${$("#__load__city__").val()}&weight=<?= $total_weight ?>&courier=${$("#__load__delivery__").val()}`, function(data, status) {
                if (status == 'error') {
                    $("#__load__shipping__grand__total").text("-")
                }
                $("#__btn__place").text(original);
                $("#__btn__place").attr("disabled", false)
            })
        })
    <?php endif ?>
</script>
<?= $this->endSection() ?>